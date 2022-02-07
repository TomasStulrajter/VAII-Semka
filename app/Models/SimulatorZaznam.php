<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulatorZaznam extends Model
{
    use HasFactory;


    protected $table = 'simulator_zaznamy';
    protected $fillable = [
        'datum', 'pocet_nakazenych', 'uzivatel_id'
    ];

    public $timestamps = false;
}
