<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\UserModel;
use App\Entities\User;

class GoogleAuthController extends Controller
{
    public function login(): ResponseInterface
    {
        try {
            $client = $this->getGoogleClient();
            
            // Generate authentication URL with proper prompt and approval
            $authUrl = $client->createAuthUrl();
            
            // Redirect to Google login page
            return redirect()->to($authUrl);
        } catch (\Exception $e) {
            log_message('error', 'Google login error: ' . $e->getMessage());
            return redirect()->to('/login')->with('error', 'Error initiating Google login: ' . $e->getMessage());
        }
    }
    
    public function callback(): ResponseInterface
    {
        try {
            $client = $this->getGoogleClient();
            
            // Get authorization code from the URL
            $code = $this->request->getVar('code');
            
            // No code? Redirect back with error
            if (!$code) {
                return redirect()->to('/login')->with('error', 'Authorization code not received from Google.');
            }
            
            // Exchange auth code for access token
            $token = $client->fetchAccessTokenWithAuthCode($code);
            
            // Check for token errors
            if (isset($token['error'])) {
                log_message('error', 'Google token error: ' . json_encode($token));
                return redirect()->to('/login')
                    ->with('error', 'Error exchanging code for token: ' . ($token['error_description'] ?? $token['error']));
            }
            
            // Set the access token
            $client->setAccessToken($token);
            
            // Get user profile info
            $oauthService = new Google_Service_Oauth2($client);
            $googleUser = $oauthService->userinfo->get();
            
            // Process the user
            return $this->authenticateGoogleUser($googleUser);
            
        } catch (\Exception $e) {
            log_message('error', 'Google callback error: ' . $e->getMessage());
            return redirect()->to('/login')->with('error', 'Error during Google authentication: ' . $e->getMessage());
        }
    }
    
    private function getGoogleClient(): Google_Client
    {
        // Create new Google client
        $client = new Google_Client();
        
        // Configure the client
        $client->setApplicationName('CodeIgniter Application');
        $client->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
        
        // Use absolute URL for the redirect URI
        $callbackUrl = getenv('GOOGLE_REDIRECT_URI') ?: base_url('google-callback');
        $client->setRedirectUri($callbackUrl);
        
        // Add required scopes
        $client->addScope('email');
        $client->addScope('profile');
        
        // Set access type to offline to get refresh token
        $client->setAccessType('offline');
        
        // Force approval prompt to ensure refresh token is always provided
        $client->setApprovalPrompt('force');
        $client->setIncludeGrantedScopes(true);
        
        // Luôn hiển thị màn hình chọn tài khoản Google
        $client->setPrompt('select_account');
        
        // For debugging - in ra URI chuyển hướng để kiểm tra
        log_message('debug', 'Google redirect URI: ' . $callbackUrl);
        
        return $client;
    }
    
    private function authenticateGoogleUser($googleUser): ResponseInterface
    {
        // Tìm kiếm người dùng theo email trong bảng auth_identities
        $identityModel = model('CodeIgniter\Shield\Models\UserIdentityModel');
        $identity = $identityModel->where('secret', $googleUser->email)
                                 ->where('type', 'email_password')
                                 ->first();
        
        if ($identity) {
            // Người dùng đã tồn tại, đăng nhập
            $auth = service('auth');
            $auth->loginById($identity->user_id);
            
            return redirect()->to($auth->getIntendedUrl() ?? '/');
        }
        
        // Người dùng không tồn tại, tạo mới
        return $this->createUserFromGoogle($googleUser);
    }
    
    private function createUserFromGoogle($googleUser): ResponseInterface
    {
        // Sử dụng dịch vụ auth của Shield
        $auth = service('auth');
        $users = model(UserModel::class);
        
        // Tạo tên người dùng từ tên Google
        $username = $this->generateUsername($googleUser->name);
        
        // Tạo mật khẩu ngẫu nhiên
        $password = bin2hex(random_bytes(16));  // Mật khẩu ngẫu nhiên 32 ký tự
        
        // Tạo người dùng mới thông qua Shield
        $user = $auth->createUser([
            'username' => $username,
            'email'    => $googleUser->email,
            'password' => $password,
        ]);
        
        // Kiểm tra lỗi
        if (! $user instanceof \CodeIgniter\Shield\Entities\User) {
            // Xử lý lỗi
            $errors = $users->errors();
            return redirect()->to('/login')
                ->with('error', implode(', ', $errors));
        }
        
        // Thêm vào nhóm mặc định
        $user->addGroup('user');
        
        // Lưu thông tin Google vào metadata
        if (method_exists($user, 'setIdentity')) {
            $user->setIdentity($googleUser);
        }
        
        // Đánh dấu email đã được xác minh (vì đã xác minh qua Google)
        $user->activate();
        
        // Đăng nhập người dùng
        $auth->logInUser($user);
        
        return redirect()->to($auth->getIntendedUrl() ?? '/')
            ->with('message', 'Tài khoản đã được tạo và đăng nhập thành công.');
    }
    
    private function generateUsername(string $name): string
    {
        // Create a URL-friendly username
        $username = strtolower(str_replace(' ', '.', $name));
        
        // Check if the username already exists
        $users = model(UserModel::class);
        $existingUser = $users->where('username', $username)->first();
        
        if (!$existingUser) {
            return $username;
        }
        
        // Username exists, append a random number
        return $username . rand(100, 999);
    }
}
