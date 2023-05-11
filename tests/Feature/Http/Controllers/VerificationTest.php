<?php

use App\Http\Controllers\VerificationController;
use Tests\TestCase;
use App\Models\User;

it('Test verify - given invalid recipient request - returns invalid_recipient result', function () {
    // arrange - act - assert

    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the request data
    $requestData = [
        'data' => [
            'recipient' => [
                'name' => 'John Doe',
            ],
            'issuer' => [
                'name' => 'Accredify',
                'identityProof' => [
                    'location' => 'example.com',
                    'key' => 'abc123',
                ],
            ],
        ],
        'signature' => [
            'targetHash' => 'abc123',
        ],
    ];

    // Mock the expected response
    $expectedResponse = [
        'data' => [
            'result' => VerificationController::INVALID_RECIPIENT,
        ],
    ];

    // Call the verify method
    $response = $this->postJson('/api/verify', $requestData);

    // Assert the response
    $response->assertStatus(200)
        ->assertJson($expectedResponse);
});

it('Test verify - given invalid issuer request - returns invalid_issuer result', function () {
    // arrange - act - assert

    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the request data
    $requestData = [
        'data' => [
            'recipient' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
            'issuer' => [
                'name' => 'Accredify',
                'identityProof' => [
                    'location' => 'example.com',
                    'key' => 'abc123',
                ],
            ],
        ],
        'signature' => [
            'targetHash' => 'abc123',
        ],
    ];

    // Mock the expected response
    $expectedResponse = [
        'data' => [
            'result' => VerificationController::INVALID_ISSUER,
        ],
    ];

    // Call the verify method
    $response = $this->postJson('/api/verify', $requestData);

    // Assert the response
    $response->assertStatus(200)
        ->assertJson($expectedResponse);
});

it('Test verify - given invalid signature request - returns invalid_signature result', function () {
    // arrange - act - assert

    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the request data
    $requestData = [
        'data' => [
            'recipient' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
            'issuer' => [
                'name' => 'Accredify',
                'identityProof' => [
                    'type' => 'DNS-DID',
                    'location' => 'ropstore.accredify.io',
                    'key' => 'did:ethr:0x05b642ff12a4ae545357d82ba4f786f3aed84214#controller',
                ],
            ],
        ],
        'signature' => [
            'targetHash' => 'abc123',
        ],
    ];

    // Mock the expected response
    $expectedResponse = [
        'data' => [
            'result' => VerificationController::INVALID_SIGNATURE,
        ],
    ];

    // Call the verify method
    $response = $this->postJson('/api/verify', $requestData);

    // Assert the response
    $response->assertStatus(200)
        ->assertJson($expectedResponse);
});

it('Test verify - given valid request - returns verified result', function () {
    // arrange - act - assert

    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the request data
    $requestData = [
        'data' => [
            'id' => '63c79bd9303530645d1cca00',
            'name' => 'Certificate of Completion',
            'recipient' => [
                'name' => 'Marty McFly',
                'email' => 'marty.mcfly@gmail.com',
            ],
            'issuer' => [
                'name' => 'Accredify',
                'identityProof' => [
                    'type' => 'DNS-DID',
                    'location' => 'ropstore.accredify.io',
                    'key' => 'did:ethr:0x05b642ff12a4ae545357d82ba4f786f3aed84214#controller',
                ],
            ],
            'issued' => '2022-12-23T00:00:00+08:00',
        ],
        'signature' => [
            'type' => 'SHA3MerkleProof',
            'targetHash' => '288f94aadadf486cfdad84b9f4305f7d51eac62db18376d48180cc1dd2047a0e',
        ],
    ];

    // Mock the expected response
    $expectedResponse = [
        'data' => [
            'issuer' => 'Accredify',
            'result' => VerificationController::VERIFIED,
        ],
    ];

    // Call the verify method
    $response = $this->postJson('/api/verify', $requestData);

    // Assert the response
    $response->assertStatus(200)
        ->assertJson($expectedResponse);
});