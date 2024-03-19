<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approvers extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function check($id)
    {
        return self::find($id);
    }

    public function approvalStages()
    {
        return $this->hasMany(approval_stages::class);
    }

    public function approvals()
    {
        return $this->hasMany(approvals::class);
    }
}
