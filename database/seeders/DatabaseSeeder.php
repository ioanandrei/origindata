<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $this->createTokens();
        $this->assignEmployeesToProjects();
    }

    private function assignEmployeesToProjects()
    {
        $companies = Company::all();

        $companies->each(function(Company $c) {
            $employees = $c->employees;

            $c->projects->each(function(Project $p) use ($employees) {
                $employees->slice(0, fake()->numberBetween(1, ($employees->count() - 1)))
                          ->each(function(Employee $e) use ($p) {
                              $e->projects()->attach($p->id);
                          })
                ;
            });
        });
    }

    private function createTokens() : void
    {
        $employees = Employee::all();
        $employees->each(function(Employee $e) {
            // generate the token
            $token = $e->createToken($e->authorizationTokenName);

            // save it to the test table
            DB::table('test_tokens')->insert([
                'token' => $token->plainTextToken,
            ]);
        });
    }
}
