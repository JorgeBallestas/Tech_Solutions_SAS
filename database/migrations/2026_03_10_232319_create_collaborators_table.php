<?php
// database/migrations/2025_XX_XX_XXXXXX_create_collaborators_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('document_type', ['CC', 'CE', 'PPT']); // Según PRD
            $table->string('document_number')->unique(); // Importante para el test
            $table->date('birth_date');
            $table->string('email')->unique(); // Importante para el test
            $table->string('phone_number');
            $table->text('address');
            $table->timestamps();
            $table->softDeletes(); // <-- PARA EL SOFT DELETE
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }
};