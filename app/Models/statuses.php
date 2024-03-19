<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statuses extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function expenses()
    {
        return $this->hasMany(expenses::class);
    }

    public function approvals()
    {
        return $this->hasMany(approvals::class);
    }
}
