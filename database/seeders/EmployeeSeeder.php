<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        /** @var Company $company */
        $company = Company::factory()
                          ->has(Employee::factory()->count(1))
                          ->has(Project::factory()->count(1))
                          ->create()
        ;

        /** @var Employee $employee */
        $employee = $company->employees->first();
        $employee->createToken($employee->authorizationTokenName);
    }
}
