<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApproverStageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_approver_stage()
    {
        $requestDataSets = [
            ['approver_id' => 1],
            ['approver_id' => 2],
            ['approver_id' => 3],
        ];
    
        foreach ($requestDataSets as $requestData) {
            $response = $this->post('/api/approval-stages', $requestData);
    
            $response->assertStatus(200);
        }
    }
}
