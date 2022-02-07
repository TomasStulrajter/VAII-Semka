<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vysledok extends Model
{
    use HasFactory;

    protected $table = 'quiz_vysledky';
    public $timestamps = false;
    protected $fillable = [
        'uzivatel_id', 'spravne_odpovede', 'vsetky_odpovede'
    ];
}
