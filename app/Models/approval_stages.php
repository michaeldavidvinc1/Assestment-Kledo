<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approval_stages extends Model
{
    use HasFactory;

    protected $fillable = ['approver_id'];

    public static function check($id)
    {
        return self::find($id);
    }

    public function approver()
    {
        return $this->belongsTo(approvers::class);
    }
}
