<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\ApprovalStageRequest;
use App\Models\approval_stages;
use App\Models\approvers;
use App\Repositories\ApprovalStageRepository;
use Illuminate\Http\Request;

class ApprovalStagesController extends Controller
{


    protected $approvalStageRepository;

    public function __construct(ApprovalStageRepository $approvalStageRepository)
    {
        $this->approvalStageRepository = $approvalStageRepository;
    }

    /**
     * Create Approvers Stage
     * @OA\Post (
     *     path="/api/approval-stages",
     *     tags={"Approval Stage"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      property="approver_id",
     *                      type="integer"
     *                 ),
     *                 example={"approver_id": "example approver_id"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="approver_id", type="integer", example="approver_id"),
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

    public function store(ApprovalStageRequest $request)
    {
        try {
            $result = $this->approvalStageRepository->create($request->validated());
            return ResponseFormatter::success($result, 'Approval created');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Approval failed', 404);
        }
    }

    /**
     * Update Approval Stage
     * @OA\Put (
     *     path="/api/approval-stages/{id}",
     *     tags={"Approval Stage"},
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

    public function edit(ApprovalStageRequest $request, $id)
    {
        try {
            $result = $this->approvalStageRepository->update($id, $request->validated());
            return ResponseFormatter::success($result, 'Approval updated');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 404);
        }
    }
}
