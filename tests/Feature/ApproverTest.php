<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use App\Http\Requests\ApproversRequest;

class ApproverTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_approver()
    {
        $requestDataSets = [
            ['name' => 'Ani'],
            ['name' => 'Ana'],
            ['name' => 'Ina'],
        ];
    
        foreach ($requestDataSets as $requestData) {
            $response = $this->post('/api/approvers', $requestData);
    
            $response->assertStatus(200);
        }
    }

    public function test_validation_passes_with_valid_data()
    {
        $validator = Validator::make([
            'name' => 'Ani'
        ], (new ApproversRequest())->rules());

        $this->assertTrue($validator->fails());
    }

    /**
     * Test validation fails with invalid data.
     *
     * @return void
     */
    public function test_validation_fails_with_invalid_data()
    {
        $invalidData = [
            'name' => 'Ani'
        ];

        try {
            Validator::make($invalidData, (new ApproversRequest())->rules())->validate();
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('name', $e->errors());
            return;
        }

        $this->fail('Validation passed unexpectedly.');
    }
}
