<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 15; $i++) {
            $user = User::create([
                'name' => "name {$i}",
                'email' => "email-{$i}@gmail.com",
                'phone' => "phone surname {$i}",
                'surname' => "surname {$i}",
                'level' => 2,
                'walletId' => uniqid('0X'),
                'trustedScore' => rand(0, 5),
                'popularScore' => rand(0, 5),
            ]);
            for ($j = 0; $j < 8; $j++) {
                $user->Services()
                    ->create([
                        'service_id' =>rand(1,20),
                        'blockchain_id' => uniqid('0X-BCL'),
                        'score' => rand(0, 5),
                        'price' => rand(100, 1000),
                        'trustedScore' => rand(0, 5),
                        'popularScore' => rand(0, 5),
                    ]);
            }
            $user->updateScores();
        }
    }
}
