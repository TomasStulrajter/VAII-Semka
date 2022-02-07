<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizOtazka extends Model
{
    use HasFactory;

    protected $table = 'quiz_otazky';
    public $timestamps = false;

    protected $fillable = [
        'otazka', 'odpoved_1', 'odpoved_2', 'odpoved_3', 'spravne'
    ];
}
