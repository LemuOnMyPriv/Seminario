<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Alumno;


class AlumnoControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function puede_crear_un_alumno()
    {
        $response = $this->post('/alumnos', [
            'name' => 'Hola',
            'lastname' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'age' => 20,
        ]);
        $response->assertRedirect('/alumnos'); // Verifica que redirija a la lista de alumnos
        $this->assertDatabaseHas('alumnos', [
            'nombre' => 'Hola',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);
    }
    /** @test */
    public function puede_mostrar_detalles_de_un_alumno()
    {
        $alumno = Alumno::factory()->create();
        $response = $this->get("/alumnos/{$alumno->id}");
        $response->assertStatus(200); // Verifica que la solicitud fue exitosa
        $response->assertSee($alumno->nombre);
        $response->assertSee($alumno->apellido);
    }

    /** @test */
    public function puede_actualizar_un_alumno()
    {

        $alumno = Alumno::factory()->create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);

        $response = $this->put("/alumnos/{$alumno->id}", [
            'nombre' => 'Carlos',
            'apellido' => 'García',
            'email' => 'carlos.garcia@example.com',
            'edad' => 22,
        ]);

        $response->assertRedirect('/alumnos');

        $this->assertDatabaseHas('alumnos', [
            'id' => $alumno->id,
            'nombre' => 'Carlos',
            'apellido' => 'García',
            'email' => 'carlos.garcia@example.com',
            'edad' => 22,
        ]);
        $this->assertDatabaseMissing('alumnos', [
            'id' => $alumno->id,
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'edad' => 20,
        ]);
    }
    /** @test */
    public function validar_exitoso_lista_alumnos()
    {
        $response = $this->get('/alumnos');

        $response->assertStatus(200);
    }

    /** @test */
    public function puede_eliminar_un_alumno()
    {
        $alumno = Alumno::factory()->create();
        $response = $this->delete("/alumnos/{$alumno->id}");
        $response->assertRedirect('/alumnos');
        $this->assertSoftDeleted('alumnos', [
            'id' => $alumno->id,
        ]);
    }
}
