<?php
// tests/Unit/Contract/ContractExtensionTest.php

namespace Tests\Unit\Contract;

use Tests\TestCase;
use App\Models\Contract;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ContractExtensionTest extends TestCase
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
    public function prueba_verificar_que_se_puede_añadir_una_prórroga_en_tiempo_o_valor_a_un_contrato_de_tipo_fijo_o_prestación_de_servicios()
    {
        $this->actingAs($this->user);

        // Prórroga de TIEMPO en contrato FIJO
        $contratoFijo = Contract::factory()->create([
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'salary' => 3000000,
            'status' => 'Activo'
        ]);

        $prorrogaTiempo = $contratoFijo->addExtension('Tiempo', [
            'new_end_date' => '2025-06-30',
            'description' => 'Prórroga de tiempo por 6 meses'
        ]);

        $this->assertDatabaseHas('contract_extensions', [
            'id' => $prorrogaTiempo->id,
            'contract_id' => $contratoFijo->id,
            'extension_type' => 'Tiempo',
            'new_end_date' => '2025-06-30'
        ]);

        // Prórroga de VALOR en contrato PRESTACIÓN DE SERVICIOS
        $contratoPrestacion = Contract::factory()->create([
            'contract_type' => 'Prestación de Servicios',
            'salary' => 3000000,
            'status' => 'Activo'
        ]);

        $prorrogaValor = $contratoPrestacion->addExtension('Valor', [
            'additional_value' => 500000,
            'description' => 'Adición presupuestal'
        ]);

        $this->assertDatabaseHas('contract_extensions', [
            'id' => $prorrogaValor->id,
            'contract_id' => $contratoPrestacion->id,
            'extension_type' => 'Valor',
            'additional_value' => 500000
        ]);

        // Verificar que el salario se actualizó
        $this->assertEquals(3500000, $contratoPrestacion->fresh()->salary);
    }

    #[Test]
    public function prueba_verificar_que_la_fecha_de_finalización_del_contrato_se_actualiza_correctamente_al_añadir_una_prórroga_de_tiempo()
    {
        $this->actingAs($this->user);

        // Crear un contrato de tipo Fijo
        $contrato = Contract::factory()->create([
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'status' => 'Activo'
        ]);

        $fechaOriginal = '2024-12-31';
        $nuevaFecha = '2025-06-30';

        // Verificar fecha original
        $this->assertEquals($fechaOriginal, $contrato->end_date->format('Y-m-d'));

        // Añadir prórroga
        $contrato->addExtension('Tiempo', [
            'new_end_date' => $nuevaFecha,
            'description' => 'Prórroga de tiempo'
        ]);

        // Verificar que la fecha se actualizó
        $this->assertEquals($nuevaFecha, $contrato->fresh()->end_date->format('Y-m-d'));
    }

    #[Test]
    public function prueba_verificar_que_el_sistema_rechaza_una_prórroga_para_un_contrato_con_estado_terminado_o_finalizado()
    {
        $this->actingAs($this->user);

        $collaborator = Collaborator::factory()->create();

        // Test para contrato TERMINADO
        $contratoTerminado = Contract::factory()->create([
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'status' => 'Terminado'
        ]);

        try {
            $contratoTerminado->addExtension('Tiempo', [
                'new_end_date' => '2025-06-30'
            ]);
            $this->fail('Debería haber lanzado excepción para contrato terminado');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('No se pueden añadir prórrogas a un contrato que no está activo.', $e->getMessage());
        }

        // Test para contrato FINALIZADO
        $contratoFinalizado = Contract::factory()->create([
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'status' => 'Finalizado'
        ]);

        try {
            $contratoFinalizado->addExtension('Tiempo', [
                'new_end_date' => '2025-06-30'
            ]);
            $this->fail('Debería haber lanzado excepción para contrato finalizado');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('No se pueden añadir prórrogas a un contrato que no está activo.', $e->getMessage());
        }
    }
}