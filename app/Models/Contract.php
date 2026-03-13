<?php
// app/Models/Contract.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'collaborator_id',
        'contract_type',
        'start_date',
        'end_date',
        'position',
        'salary',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'salary' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contract) {
            self::validateContract($contract);
        });

        static::updating(function ($contract) {
            self::validateContract($contract);
        });
    }

    protected static function validateContract($contract)
    {
        // Validar que el salario sea positivo
        if ($contract->salary <= 0) {
            throw new InvalidArgumentException('El salario debe ser un valor positivo.');
        }

        // Validar que la fecha de inicio no sea mayor que la fecha de fin (si existe)
        if ($contract->end_date && $contract->start_date > $contract->end_date) {
            throw new InvalidArgumentException('La fecha de inicio no puede ser mayor que la fecha de fin.');
        }

        // Validar que el colaborador existe
        if (!Collaborator::where('id', $contract->collaborator_id)->exists()) {
            throw new InvalidArgumentException('El colaborador especificado no existe.');
        }

        return true;
    }

    // Relación con Collaborator
    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }
}