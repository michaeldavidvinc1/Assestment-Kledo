<?php

namespace App\Repositories;

use App\Models\approval_stages;
use App\Models\approvals;
use App\Models\expenses;
use App\Models\statuses;


class ExpenseRepository
{
    public function create(array $data)
    {
        $status = statuses::create();
        return expenses::create([
            "amount" => $data["amount"],
            "status_id" => $status->id
        ]);
    }

    public function update($id, array $data)
    {
        $check = expenses::check($id);
        if (is_null($check)) throw new \Exception('Expense Id is not found');

        $checkApprover = approval_stages::where('approver_id', $data['approver_id'])->first();
        if (is_null($checkApprover)) throw new \Exception('Approver Id is not found');

        $totalApprovalStages = approval_stages::count();

        $approvedApprovalStages = approvals::where('expense_id', $check->id)->count();

        $status = statuses::find($check->status_id);
        $approvals = approvals::where('expense_id', $id)->where('approver_id', $data['approver_id'])->count();
        if($approvals != 0){
            throw new \Exception('Approver cannot approve twice');
        }
        if ($approvedApprovalStages == $totalApprovalStages) {
            $status->name = "disetujui";
            $status->save();

            return approvals::create([
                'expense_id' => $check->id,
                'approver_id' => $data['approver_id'],
                'status_id' => $status->id
            ]);
        }

        return approvals::create([
            'expense_id' => $check->id,
            'approver_id' => $data['approver_id'],
            'status_id' => $status->id
        ]);
    }

    public function findById($id)
    {
        $check = expenses::check($id);
        if (is_null($check)) throw new \Exception('Expense Id is not found');
        $expense = expenses::with(['status'])->findOrFail($id);

        $approvals = approvals::where('expense_id', $expense->id)
            ->with(["expense", "status", "approver"])
            ->get();

        $formattedExpense = [
            'id' => $expense->id,
            'amount' => $expense->amount,
            'status' => [
                'id' => $expense->status->id,
                'name' => $expense->status->name,
            ],
            'approvals' => $approvals->map(function ($approval) {
                return [
                    'id' => $approval->id,
                    'approver' => $approval->approver ? [
                        'id' => $approval->approver->id,
                        'name' => $approval->approver->name,
                    ] : null,
                    'status' => [
                        'id' => $approval->status->id,
                        'name' => $approval->status->name,
                    ]
                ];
            })
        ];

        return $formattedExpense;
    }
}
