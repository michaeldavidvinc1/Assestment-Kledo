<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'status_id'];

    public function status()
    {
        return $this->belongsTo(statuses::class);
    }

    public function approvals()
    {
        return $this->hasMany(approvals::class, 'id'); 
    }

    public static function check($id)
    {
        return self::find($id);
    }
}
