<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\ExpenseRequest;
use App\Models\approvers;
use App\Models\expenses;
use App\Repositories\ExpenseRepository;
use Error;
use Exception;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{

    protected $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Create Expense 
     * @OA\Post (
     *     path="/api/expense",
     *     tags={"Expense"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      property="amount",
     *                      type="integer"
     *                 ),
     *                 example={"amount": "example amount"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="amount", type="integer", example="amount"),
     *             @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *             @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="fail")
     *         )
     *     )
     * )
     */

    public function store(ExpenseRequest $request)
    {
        $result = $this->expenseRepository->create($request->validated());
        return ResponseFormatter::success($result, 'Expense created');
    }

    /**
     * Get Expense Detail
     * @OA\Get (
     *     path="/api/expense/{id}",
     *     tags={"Expense"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        try {
            $result = $this->expenseRepository->findById($id);
            return ResponseFormatter::success($result, 'Get data success');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 404);
        }
    }


    /**
     * Update Expense
     * @OA\Patch (
     *     path="/api/expense/{id}/approve",
     *     tags={"Expense"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="approver_id",
     *                          type="integer"
     *                      ),
     *                 ),
     *                 example={
     *                     "approver_id":"example approver_id",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="approver_id", type="integer", example="approver_id"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     */

    public function update(Request $request, $id)
    {
        try {
            $result = $this->expenseRepository->update($id, $request->all());
            return ResponseFormatter::success($result, 'Approval updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 404);
        }
    }
}
