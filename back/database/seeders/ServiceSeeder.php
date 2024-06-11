<?php

namespace Database\Seeders;

use App\Models\Service\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Service::count()) {
            Service::factory()
                ->count(30)
                ->create();
        }
    }
}
