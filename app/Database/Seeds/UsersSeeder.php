<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $adminData = [
            'username' => 'admin',
            'email' => 'admin@organicstation.com',
            'password' => password_hash('1234567', PASSWORD_DEFAULT),
            'role' => 'admin',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $this->db->table('users')->insert($adminData);

        $guestData = [
            'username' => 'guest',
            'email' => 'guest@organicstation.com',
            'password' => password_hash('1234567', PASSWORD_DEFAULT),
            'role' => 'guest',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $this->db->table('users')->insert($guestData);

        for ($i = 0; $i < 8; $i++) {
            $data = [
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->email,
                'password' => password_hash('1234567', PASSWORD_DEFAULT),
                'role' => $faker->randomElement(['admin', 'guest']),
                'email_verified_at' => $faker->optional(0.7)->dateTime?->format('Y-m-d H:i:s'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            // Mencoba insert dengan handling error untuk duplikasi
            try {
                $this->db->table('users')->insert($data);
            } catch (\Exception $e) {
                // Jika ada error duplikasi, skip dan lanjut
                echo "Skipping duplicate entry for: " . $data['username'] . "\n";
            }
        }
    }
}
