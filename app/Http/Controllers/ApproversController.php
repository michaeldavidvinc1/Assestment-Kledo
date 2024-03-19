<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\ApproversRequest;
use App\Models\approvers;
use App\Repositories\ApproversRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApproversController extends Controller
{
    /**
     * @OA\Info(
     *     title="My First API",
     *     version="0.1"
     * )
     */
    protected $approversRepository;

    public function __construct(ApproversRepository $approversRepository)
    {
        $this->approversRepository = $approversRepository;
    }

    /**
     * Create Approvers
     * @OA\Post (
     *     path="/api/approvers",
     *     tags={"Approvers"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      property="name",
     *                      type="string"
     *                 ),
     *                 example={"name": "example name"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="name"),
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

    public function create(ApproversRequest $request)
    {
        try {
            $result = $this->approversRepository->create($request->validated());
            return ResponseFormatter::success($result, 'Approvers created');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Approvers failed', 404);
        }
    }
}
