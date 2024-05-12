<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $usersArea = [
            [
                'username' => 'user_area1',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'area',
                'area'     => 'Area A',
            ],
            [
                'username' => 'user_area2',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'area',
                'area'     => 'Area B',
            ],
            // Tambahkan data untuk role "area" lainnya jika diperlukan
        ];

        // Seed data untuk role "kepala area"
        $usersKepalaArea = [
            [
                'username' => 'kepala_area1',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'kepala area',
                'area'     => 'Area A',
            ],
            [
                'username' => 'kepala_area2',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'kepala area',
                'area'     => 'Area B',
            ],
            // Tambahkan data untuk role "kepala area" lainnya jika diperlukan
        ];

        // Seed data untuk role "monitoring"
        $usersMonitoring = [
            [
                'username' => 'monitoring1',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'monitoring',
                'area'     => null, // Monitoring tidak terkait dengan area tertentu
            ],
            // Tambahkan data untuk role "monitoring" lainnya jika diperlukan
        ];

        // Gabungkan semua data user menjadi satu array
        $users = array_merge($usersArea, $usersKepalaArea, $usersMonitoring);

        // Insert data ke dalam tabel users
        $this->db->table('users')->insertBatch($users);
    }
}
