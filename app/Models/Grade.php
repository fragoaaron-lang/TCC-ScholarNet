<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Grade extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'grade',
        'semester',
        'school_year',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
