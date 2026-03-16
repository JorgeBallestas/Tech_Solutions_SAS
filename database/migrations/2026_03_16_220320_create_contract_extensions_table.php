<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_contract_extensions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->onDelete('cascade');
            $table->enum('extension_type', ['Tiempo', 'Valor']);
            $table->date('new_end_date')->nullable(); // Para prórrogas de tiempo
            $table->decimal('additional_value', 10, 2)->nullable(); // Para adiciones de valor
            $table->text('description')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index('contract_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_extensions');
    }
};