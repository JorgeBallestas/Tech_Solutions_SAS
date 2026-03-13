<?php
// tests/Unit/Contract/ContractModelTest.php

namespace Tests\Unit\Contract;

use Tests\TestCase;
use App\Models\Contract;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ContractModelTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear el rol y usuario (igual que en colaboradores)
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Gestor RRHH']);
        
        $this->user = User::factory()->create();
        $this->user->assignRole('Gestor RRHH');
    }

    #[Test]
    public function prueba_verificar_que_se_puede_crear_un_contrato_y_asociarlo_a_un_colaborador_existente()
    {
        $this->actingAs($this->user);

        // Crear un colaborador primero
        $collaborator = Collaborator::factory()->create();

        $contractData = [
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'position' => 'Desarrollador Senior',
            'salary' => 5000000,
            'status' => 'Activo'
        ];

        $contract = Contract::create($contractData);

        $this->assertDatabaseHas('contracts', [
            'id' => $contract->id,
            'collaborator_id' => $collaborator->id,
            'position' => 'Desarrollador Senior',
            'salary' => 5000000
        ]);

        // Verificar la relación
        $this->assertInstanceOf(Collaborator::class, $contract->collaborator);
        $this->assertEquals($collaborator->id, $contract->collaborator->id);
    }

    #[Test]
    public function prueba_verificar_que_no_se_puede_crear_un_contrato_para_un_colaborador_inexistente()
    {
        $this->actingAs($this->user);

        $contractData = [
            'collaborator_id' => 99999, // ID que no existe
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'position' => 'Desarrollador Senior',
            'salary' => 5000000,
            'status' => 'Activo'
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('El colaborador especificado no existe.');
        
        Contract::create($contractData);
    }

    #[Test]
    public function prueba_verificar_que_los_campos_de_fecha_y_salario_son_validados_correctamente()
    {
        $this->actingAs($this->user);

        $collaborator = Collaborator::factory()->create();

        // Caso 1: Fecha de inicio mayor que fecha de fin
        $invalidDateData = [
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'start_date' => '2024-12-31', // Mayor que end_date
            'end_date' => '2024-01-01',
            'position' => 'Desarrollador Senior',
            'salary' => 5000000,
            'status' => 'Activo'
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('La fecha de inicio no puede ser mayor que la fecha de fin.');
        
        Contract::create($invalidDateData);
    }

    #[Test]
    public function prueba_verificar_que_se_puede_actualizar_un_contrato_existente()
    {
        $this->actingAs($this->user);

        // Crear un contrato primero
        $contract = Contract::factory()->create();

        $updateData = [
            'position' => 'Arquitecto de Software',
            'salary' => 8000000,
            'status' => 'Terminado'
        ];

        $contract->update($updateData);

        $this->assertDatabaseHas('contracts', [
            'id' => $contract->id,
            'position' => 'Arquitecto de Software',
            'salary' => 8000000,
            'status' => 'Terminado'
        ]);
    }
}