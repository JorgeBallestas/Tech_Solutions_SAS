<?php
// app/Models/Collaborator.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collaborator extends Model
{
    use HasFactory, SoftDeletes; // <-- AÑADIMOS SoftDeletes

    protected $fillable = [
        'first_name',
        'last_name',
        'document_type',
        'document_number',
        'birth_date',
        'email',
        'phone_number',
        'address',
    ];

    // Opcional: Casts para asegurar el tipo de datos
    protected $casts = [
        'birth_date' => 'date',
        'deleted_at' => 'datetime',
    ];
}