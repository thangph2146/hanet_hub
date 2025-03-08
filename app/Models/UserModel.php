<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        // Sử dụng lớp User tùy chỉnh thay vì lớp mặc định của Shield
        $this->returnType = \App\Entities\User::class;
    }
} 