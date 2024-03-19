<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    
    public function test_store_expense()
    {
        $requestDataSets = [
            ['amount' => 100],
            ['amount' => 200],
            ['amount' => 300],
            ['amount' => 400],
        ];
    
        foreach ($requestDataSets as $requestData) {
            $response = $this->post('/api/expense', $requestData);
    
            $response->assertStatus(200);
        }
    }
}
