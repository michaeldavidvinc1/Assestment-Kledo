<?php

namespace Tests\Feature;

use App\Models\expenses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApprovalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_approval()
    {
        //! case 1
        $data = [
            ["approver_id" => 1],
            ["approver_id" => 2],
            ["approver_id" => 3],
        ];

        foreach ($data as $requestData) {
            $response = $this->patch('/api/expense/1/approve', $requestData);
    
            $response->assertStatus(200);
        }

        //! case 2
        $data = [
            ["approver_id" => 1],
            ["approver_id" => 2],
        ];

        foreach ($data as $requestData) {
            $response = $this->patch('/api/expense/2/approve', $requestData);
    
            $response->assertStatus(200);
        }

        //! case 3
        $data = [
            ["approver_id" => 1],
        ];

        foreach ($data as $requestData) {
            $response = $this->patch('/api/expense/3/approve', $requestData);
    
            $response->assertStatus(200);
        }
    }
}
