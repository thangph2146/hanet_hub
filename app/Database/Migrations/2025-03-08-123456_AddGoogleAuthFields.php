<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGoogleAuthFields extends Migration
{
    public function up()
    {
        // Kiểm tra xem bảng auth_identities đã tồn tại chưa
        if ($this->db->tableExists('auth_identities')) {
            // Thêm cột oauth_provider vào bảng auth_identities nếu chưa tồn tại
            if (!$this->db->fieldExists('oauth_provider', 'auth_identities')) {
                $this->forge->addColumn('auth_identities', [
                    'oauth_provider' => [
                        'type'       => 'VARCHAR',
                        'constraint' => 255,
                        'null'       => true,
                        'after'      => 'secret',
                    ],
                ]);
            }
        }
    }

    public function down()
    {
        // Kiểm tra xem bảng auth_identities đã tồn tại chưa
        if ($this->db->tableExists('auth_identities')) {
            // Xóa cột oauth_provider nếu tồn tại
            if ($this->db->fieldExists('oauth_provider', 'auth_identities')) {
                $this->forge->dropColumn('auth_identities', 'oauth_provider');
            }
        }
    }
} 