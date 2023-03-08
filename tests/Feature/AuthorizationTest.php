<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

test("a request without the auth token can't access the API", function() {
    $response = getJson('api/companies');
    $data     = $response->json();

    $response->assertStatus(Response::HTTP_FORBIDDEN);
    $this->assertEquals('Unauthenticated.', $data['message']);
});

test("a request with a wrong auth token can't access the API", function() {
    $response = getJson('api/companies', [
        'Authorization' => 'Bearer 1|pNGNz3S5Xw3N6X4q1xLXVAGABOGciVfPPBOBGBui',
    ]);
    $data     = $response->json();

    $response->assertStatus(Response::HTTP_FORBIDDEN);
    $this->assertEquals('Unauthenticated.', $data['message']);
});
