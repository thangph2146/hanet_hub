<?php

namespace App\Entities;

use CodeIgniter\Shield\Entities\User as ShieldUser;

class User extends ShieldUser
{
    /**
     * Lưu thông tin người dùng từ Google
     *
     * @param object $googleUser Thông tin người dùng từ Google
     * @return void
     */
    public function setIdentity(object $googleUser): void
    {
        // Lưu thông tin người dùng từ Google vào metadata
        $this->syncMeta([
            'username' => $googleUser->name,
        ]);
    }
} 