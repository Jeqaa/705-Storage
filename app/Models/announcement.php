<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement'; // Specify the table name

    protected $fillable = [
        'title',
        'content',
        'show',
    ];
}
