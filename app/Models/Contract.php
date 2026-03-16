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

    // Método para añadir prórroga
    public function addExtension($type, $data)
    {
        // Verificar que el contrato puede tener prórrogas
        if ($this->status !== 'Activo') {
            throw new InvalidArgumentException('No se pueden añadir prórrogas a un contrato que no está activo.');
        }

        if (!in_array($this->contract_type, ['Fijo', 'Prestación de Servicios'])) {
            throw new InvalidArgumentException('Solo los contratos de tipo Fijo o Prestación de Servicios pueden tener prórrogas.');
        }

        // Crear la prórroga
        $extension = $this->extensions()->create([
            'extension_type' => $type,
            'new_end_date' => $data['new_end_date'] ?? null,
            'additional_value' => $data['additional_value'] ?? null,
            'description' => $data['description'] ?? null
        ]);

        // Si es prórroga de tiempo, actualizar la fecha de fin del contrato
        if ($type === 'Tiempo' && isset($data['new_end_date'])) {
            $this->update(['end_date' => $data['new_end_date']]);
        }

        // Si es prórroga de valor, actualizar el salario
        if ($type === 'Valor' && isset($data['additional_value'])) {
            $this->update(['salary' => $this->salary + $data['additional_value']]);
        }

        return $extension;
    }

    // Relación con Extensiones
    public function extensions()
    {
        return $this->hasMany(ContractExtension::class);
    }

    // Relación con Collaborator
    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }
}