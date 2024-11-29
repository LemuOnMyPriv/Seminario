<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\Alumno;
use App\Http\Controllers\AlumnoController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AlumnoControllerUnitTest extends TestCase
{
    //Prueba de que al no ingresar datos se genera una excepcion
    public function test_probar_validacion_falla_para_crear_Alumnos(): void
    {
        //variable para el controlador, aqui se crea la instancia de dicho controlador
        $controller = new AlumnoController();
        $request = Request::create('/alumnos', 'POST', [
            'name' => '', //Ingresando dato vacio para comprobar la validacion de require
            'lastname' => '',
            'email' => '',
            'age' => ''
        ]);
        $this->expectException(ValidationException::class);
        // Se espera que falle la validación
        $controller->store($request);
    }
    /*Prueba de que al ingresar los datos de forma correcta se ejecuta 
    la captura de los datos correctamente */
    public function test_probar_validacion_correcta_para_crear_Alumnos(): void
    {
        //variable para el controlador, aqui se crea la instancia de dicho controlador
        $controller = new AlumnoController();
        $request = Request::create('/alumnos', 'POST', [
            'name' => 'Abdias', //Ingresando dato vacio para comprobar la validacion de require
            'lastname' => 'Cevallos',
            'mail' => 'aCevallos@unicah.edu',
            'age' => '21'
        ]);

        // Si no se genera una exc  epcion, la validacion sera correcta
        $response = $controller->store($request);
        $this->assertTrue($response->isRedirect(route('alumnos.index')));
    }


    //Prueba de que al no ingresar datos se genera una excepcion
    public function test_probar_validacion_falla_para_correo_Alumnos(): void
    {
        //variable para el controlador, aqui se crea la instancia de dicho controlador
        $controller = new AlumnoController();
        $request = Request::create('/alumnos', 'POST', [
            'name' => 'abdias', //Ingresando dato vacio para comprobar la validacion de require
            'lastname' => 'anariba',
            'email' => '',
            'age' => '21'
        ]);
        $this->expectException(ValidationException::class);
        // Se espera que falle la validación
        $controller->store($request);
    }
}
