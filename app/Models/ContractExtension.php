<?php
// app/Models/ContractExtension.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'extension_type',
        'new_end_date',
        'additional_value',
        'description'
    ];

    protected $casts = [
        'new_end_date' => 'date',
        'additional_value' => 'decimal:2'
    ];

    // Relación con Contract
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}