<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id', 'question', 'type', 'options'
    ];
}
