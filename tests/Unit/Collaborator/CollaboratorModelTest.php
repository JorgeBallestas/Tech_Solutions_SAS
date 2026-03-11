<?php
// tests/Unit/Collaborator/CollaboratorModelTest.php

namespace Tests\Unit\Collaborator;

use Tests\TestCase;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;
use Database\Seeders\RoleSeeder; // <-- IMPORTAR EL SEEDER

class CollaboratorModelTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // EJECUTAR EL SEEDER EXPLÍCITAMENTE
        $this->seed(RoleSeeder::class);
        
        // Ahora crear el usuario y asignar rol
        $this->user = User::factory()->create();
        $this->user->assignRole('Gestor RRHH');
    }

    #[Test]
    public function puede_crear_un_colaborador_con_datos_validos()
    {
        $this->actingAs($this->user);

        $data = [
            'first_name' => 'Juan',
            'last_name' => 'Pérez',
            'document_type' => 'CC',
            'document_number' => '123456789',
            'birth_date' => '1990-01-01',
            'email' => 'juan.perez@example.com',
            'phone_number' => '3001234567',
            'address' => 'Calle 123 #45-67'
        ];

        $collaborator = Collaborator::create($data);

        $this->assertDatabaseHas('collaborators', [
            'id' => $collaborator->id,
            'document_number' => '123456789',
            'email' => 'juan.perez@example.com'
        ]);
    }

    #[Test]
    public function rechaza_creacion_cuando_documento_o_email_estan_duplicados()
    {
        $this->actingAs($this->user);

        // Crear primer colaborador
        Collaborator::create([
            'first_name' => 'Juan',
            'last_name' => 'Pérez',
            'document_type' => 'CC',
            'document_number' => '123456789',
            'birth_date' => '1990-01-01',
            'email' => 'juan@example.com',
            'phone_number' => '3001234567',
            'address' => 'Calle 123'
        ]);

        $this->expectException(QueryException::class);
        
        Collaborator::create([
            'first_name' => 'Ana',
            'last_name' => 'García',
            'document_type' => 'CC',
            'document_number' => '123456789',
            'birth_date' => '1992-02-02',
            'email' => 'ana@example.com',
            'phone_number' => '3007654321',
            'address' => 'Carrera 45'
        ]);
    }

    #[Test]
    public function puede_actualizar_colaborador_existente()
    {
        $this->actingAs($this->user);

        $collaborator = Collaborator::factory()->create();

        $collaborator->update([
            'first_name' => 'Juan Carlos',
            'phone_number' => '3009998888',
            'email' => 'juancarlos@example.com'
        ]);

        $this->assertDatabaseHas('collaborators', [
            'id' => $collaborator->id,
            'first_name' => 'Juan Carlos',
            'phone_number' => '3009998888',
            'email' => 'juancarlos@example.com'
        ]);
    }

    #[Test]
    public function puede_obtener_listado_de_colaboradores()
    {
        $this->actingAs($this->user);

        Collaborator::factory()->count(3)->create();

        $this->assertCount(3, Collaborator::all());
    }

    #[Test]
    public function puede_eliminar_colaborador_con_soft_delete()
    {
        $this->actingAs($this->user);

        $collaborator = Collaborator::factory()->create();

        $collaborator->delete();

        $this->assertSoftDeleted($collaborator);
        $this->assertNotNull(Collaborator::withTrashed()->find($collaborator->id)->deleted_at);
    }
}