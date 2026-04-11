<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'course',
        'year_level',
        'status',
        'admin_id',
        'scholarship_name',
        'sponsor',
        'gpa',
        'plan',
        'scholastic_record'
    ];

    // Link application to student
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
