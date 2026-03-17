<?php
// tests/Unit/Contract/ContractTerminationTest.php

namespace Tests\Unit\Contract;

use Tests\TestCase;
use App\Models\Contract;
use App\Models\Collaborator;
use App\Models\User;
use App\Models\ContractTermination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ContractTerminationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear el rol y usuario
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Gestor RRHH']);
        
        $this->user = User::factory()->create();
        $this->user->assignRole('Gestor RRHH');
    }

    #[Test]
    public function prueba_verificar_que_se_puede_cambiar_el_estado_de_un_contrato_a_terminado()
    {
        $this->actingAs($this->user);

        // Crear un contrato activo
        $contrato = Contract::factory()->create([
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'status' => 'Activo'
        ]);

        // Terminar el contrato
        $fechaTerminacion = '2024-06-30';
        $motivo = 'Renuncia voluntaria del colaborador';

        $terminacion = $contrato->terminate($fechaTerminacion, $motivo);

        // Verificar que el estado cambió a "Terminado"
        $this->assertDatabaseHas('contracts', [
            'id' => $contrato->id,
            'status' => 'Terminado'
        ]);

        // Verificar que NO está en estado Activo
        $this->assertNotEquals('Activo', $contrato->fresh()->status);
    }

    #[Test]
    public function prueba_verificar_que_se_registra_correctamente_la_fecha_y_el_motivo_de_la_terminación()
    {
        $this->actingAs($this->user);

        // Crear un contrato activo
        $contrato = Contract::factory()->create([
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'status' => 'Activo'
        ]);

        // Terminar el contrato
        $fechaTerminacion = '2024-06-30';
        $motivo = 'Renuncia voluntaria del colaborador para aceptar otra oferta laboral';

        $terminacion = $contrato->terminate($fechaTerminacion, $motivo);

        // Verificar que se creó el registro de terminación
        $this->assertDatabaseHas('contract_terminations', [
            'contract_id' => $contrato->id,
            'termination_date' => $fechaTerminacion,
            'reason' => $motivo
        ]);

        // Verificar la relación
        $this->assertInstanceOf(ContractTermination::class, $contrato->fresh()->termination);
        $this->assertEquals($fechaTerminacion, $contrato->fresh()->termination->termination_date->format('Y-m-d'));
        $this->assertEquals($motivo, $contrato->fresh()->termination->reason);
    }

    #[Test]
    public function prueba_verificar_que_no_se_puede_terminar_un_contrato_que_ya_ha_finalizado()
    {
        $this->actingAs($this->user);

        $collaborator = Collaborator::factory()->create();

        // Caso 1: Contrato ya TERMINADO
        $contratoTerminado = Contract::factory()->create([
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'status' => 'Terminado'
        ]);

        try {
            $contratoTerminado->terminate('2024-06-30', 'Intento de terminar contrato ya terminado');
            $this->fail('Debería haber lanzado excepción para contrato terminado');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('Solo se pueden terminar contratos activos.', $e->getMessage());
        }

        // Caso 2: Contrato ya FINALIZADO (llegó a su fecha de fin naturalmente)
        $contratoFinalizado = Contract::factory()->create([
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'status' => 'Finalizado'
        ]);

        try {
            $contratoFinalizado->terminate('2024-06-30', 'Intento de terminar contrato finalizado');
            $this->fail('Debería haber lanzado excepción para contrato finalizado');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('Solo se pueden terminar contratos activos.', $e->getMessage());
        }
    }
}