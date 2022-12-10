<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Investment;
use App\Models\Investor;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

         Purchase::factory()
             ->has(Investor::factory()->count(2))
             ->has(Supplier::factory())
             ->count(20)
             ->create();
         Investment::factory()
             ->has(Investor::factory())
             ->count(20)
             ->create();
         Investor::factory()
             ->count(20)
             ->create();
         Supplier::factory()
             ->count(20)
             ->create();
    }
}
