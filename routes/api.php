<?php

use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\ApprovalStagesController;
use App\Http\Controllers\ApproversController;
use App\Http\Controllers\ExpensesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/approvers", [ApproversController::class, 'create']);
Route::post("/approval-stages", [ApprovalStagesController::class, 'store']);
Route::put("/approval-stages/{id}", [ApprovalStagesController::class, 'edit']);
Route::post("/expense", [ExpensesController::class, 'store']);
Route::patch("/expense/{id}/approve", [ExpensesController::class, 'update']);
Route::get("/expense/{id}", [ExpensesController::class, 'show']);
