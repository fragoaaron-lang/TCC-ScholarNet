<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'scholastic_record',
    'scholarship_name',
    'sponsor',
    'year_level',
    'gpa',
    'plan',
    'status',
    'rejection_reason',
    'screening_at',
];

    protected $casts = [
        'screening_at' => 'datetime',
    ];
    /**
     * Each requirement belongs to a student (User)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status); // e.g., Pending, Approved, Rejected
    }
}
