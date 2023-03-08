<?php

use App\Models\Employee;
use Database\Seeders\EmployeeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

test("an employee can acess the company details", function() {
    $this->seed(EmployeeSeeder::class);
    Sanctum::actingAs(Employee::query()->find(1), ['*']);

    $response = getJson('api/companies')->assertStatus(Response::HTTP_OK);
    $data     = $response->json();

    $this->assertCount(1, $data['data']['employees']);
    $this->assertCount(1, $data['data']['projects']);
});

test("an employee can't access other company details", function() {
    // create 2 employees with 2 different companies
    $this->seed(EmployeeSeeder::class);
    $this->seed(EmployeeSeeder::class);

    // act ast the first employee
    Sanctum::actingAs(Employee::query()->find(1), ['*']);

    // try to access the second company
    getJson('api/companies/2')->assertStatus(Response::HTTP_FORBIDDEN);
});

test("an employee can't update other company details", function() {
    // create 2 employees with 2 different companies
    $this->seed(EmployeeSeeder::class);
    $this->seed(EmployeeSeeder::class);

    // act ast the first employee
    Sanctum::actingAs(Employee::query()->find(1), ['*']);

    // try to access the second company
    putJson('api/companies/2', [
        'name' => fake()->company,
    ])->assertStatus(Response::HTTP_FORBIDDEN);
});

test("an employee can update his company details", function() {
    // create 1 employee
    $this->seed(EmployeeSeeder::class);

    // act ast the first employee
    Sanctum::actingAs(Employee::query()->find(1), ['*']);

    // try to update the company
    $name     = fake()->company;
    $response = putJson('api/companies/1', [
        'name' => $name,
    ])->assertStatus(Response::HTTP_OK);
    $data     = $response->json();

    $this->assertEquals($name, $data['data']['name']);
    $this->assertCount(1, $data['data']['employees']);
    $this->assertCount(1, $data['data']['projects']);
});

test("an employee can delete his company", function() {
    // create 1 employee
    $this->seed(EmployeeSeeder::class);

    // act ast the first employee
    Sanctum::actingAs(Employee::query()->find(1), ['*']);

    // try to delete the company
    $response = deleteJson('api/companies/1')->assertStatus(Response::HTTP_OK);
    $data     = $response->json();

    $this->assertEquals('Success', $data['message']);
});

test("an employee can't delete other company", function() {
    // create 2 employees with 2 different companies
    $this->seed(EmployeeSeeder::class);
    $this->seed(EmployeeSeeder::class);

    // act ast the first employee
    Sanctum::actingAs(Employee::query()->find(1), ['*']);

    // try to delete the company
    deleteJson('api/companies/2')->assertStatus(Response::HTTP_FORBIDDEN);
});
