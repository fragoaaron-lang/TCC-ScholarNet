<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Only use fillable, do NOT declare $title or $content as protected properties
    protected $fillable = [
        'title',
        'content',
    ];
}
