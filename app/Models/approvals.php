<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approvals extends Model
{
    use HasFactory;

    protected $fillable = ['expense_id', 'approver_id', 'status_id'];

    public function expense()
    {
        return $this->belongsTo(expenses::class);
    }

    public function approver()
    {
        return $this->belongsTo(approvers::class);
    }

    public function status()
    {
        return $this->belongsTo(statuses::class);
    }
}
