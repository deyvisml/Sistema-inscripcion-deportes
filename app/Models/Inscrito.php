<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo",
        "name",
        "ap_paterno",
        "ap_materno",
        "user_id",
        "escuela_id",
        "deporte_id",
        "estado_id",
        "deleted_at",
        "created_at",
        "updated_at",
    ];
}
