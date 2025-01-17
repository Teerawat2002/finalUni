<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'project_title',
        'project_description',
        'project_img',
        'project_year',
        'student_id',
        'advisor_id',
    ];
}
