<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $table = 'course_details';

    protected $fillable = [
        'course_id',
        'step_number',
        'title',
        'description',
    ];

    public $timestamps = true;
}
