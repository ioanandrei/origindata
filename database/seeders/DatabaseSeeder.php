<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        Company::factory()
               ->count(10)
               ->has(Employee::factory()->count(fake()->numberBetween(1, 10)))
               ->has(Project::factory()->count(fake()->numberBetween(1, 5)))
               ->create()
        ;

        $employees = Employee::all();
        $employees->each(function(Employee $e) {
            $token = $e->createToken($e->authorizationTokenName);

            dump("Token generated with success: {$token->plainTextToken}");
        });
    }
}
