<?php
// app/Models/ContractTermination.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractTermination extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'termination_date',
        'reason'
    ];

    protected $casts = [
        'termination_date' => 'date'
    ];

    // Relación con Contract (uno a uno)
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}