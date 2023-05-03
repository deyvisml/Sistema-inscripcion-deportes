<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "num_max_players",
        "fecha_limite",
        "fecha_limite",
    ];
}
