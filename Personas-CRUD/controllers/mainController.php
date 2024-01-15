<?php

header('Content-Type: text/html; charset=ISO-8859-1');

require_once 'helpers/helper.class.php';
include_once '../models/PersonaModel.php';
include_once '../models/beans/generos.php';
include_once '../models/beans/paises.php';
include_once '../models/beans/personas.php';


if ($_GET) {
    $op = $_GET['operacion'];
} else if ($_POST) {
    $op = $_POST['operacion'];
}

switch ($op) {
    case 'registrar':
        registrar();
        break;
    case 'modificar':
        modificar();
        break;
    case 'eliminar':
        eliminar();
        break;
}


function registrar()
{

    date_default_timezone_set('America/El_Salvador');
    $hlp = new Helper();
    $nombre = isset($_POST['nombre']) ? $hlp->limpiarParametro($_POST['nombre']) : false;
    $primer_apellido = isset($_POST['primer-apellido']) ? $hlp->limpiarParametro($_POST['primer-apellido']) : false;
    $email = isset($_POST['email']) ? $hlp->limpiarParametro($_POST['email']) : false;
    $genero = isset($_POST['genero']) ? $hlp->limpiarParametro($_POST['genero']) : false;
    $telefono = isset($_POST['telefono']) ? $hlp->limpiarParametro($_POST['telefono']) : false;
    $birthdate = isset($_POST['birthdate']) ? $hlp->limpiarParametro($_POST['birthdate']) : false;
    $pais = isset($_POST['pais']) ? $hlp->limpiarParametro($_POST['pais']) : false;



    if (!$nombre || !$primer_apellido || !$genero || !$birthdate || !$pais) {

        print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar los datos requeridos!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

    } elseif (!$hlp->validarTelefono($telefono)) {

        print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar el teléfono en el formato solicitado!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

    } else {


        $OGenero = new Genero();
        $OPais = new Pais();
        $persona = new Persona();

        $OPais->setIdPais($pais);
        $OGenero->set_id_genero($genero);

        $persona->setFirstName($nombre);
        $persona->setLastName($primer_apellido);
        $persona->setEmail($email);
        $persona->setPhone($telefono);
        $persona->setBirthDate($birthdate);
        $persona->setPais($OPais);
        $persona->setGender($OGenero);

        $agregarModel = new PersonaModel();
        $result = $agregarModel->AgregarPersona($persona);

        if ($result) {
            print_r(json_encode([
                "ok" => true,
                "mensaje" => "¡El registro se agregó correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

        } else {
            print_r(json_encode([
                "ok" => false,
                "mensaje" => "¡Error al guardar los datos!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
    }
}

function modificar()
{
    date_default_timezone_set('America/El_Salvador');
    $hlp = new Helper();
    $id = isset($_POST['id']) ? $hlp->limpiarParametro($_POST['id']) : false;
    $nombre = isset($_POST['nombre']) ? $hlp->limpiarParametro($_POST['nombre']) : false;
    $primer_apellido = isset($_POST['primer-apellido']) ? $hlp->limpiarParametro($_POST['primer-apellido']) : false;
    $email = isset($_POST['email']) ? $hlp->limpiarParametro($_POST['email']) : false;
    $genero = isset($_POST['genero']) ? $hlp->limpiarParametro($_POST['genero']) : false;
    $telefono = isset($_POST['telefono']) ? $hlp->limpiarParametro($_POST['telefono']) : false;
    $birthdate = isset($_POST['birthdate']) ? $hlp->limpiarParametro($_POST['birthdate']) : false;
    $pais = isset($_POST['pais']) ? $hlp->limpiarParametro($_POST['pais']) : false;


    if (!$nombre || !$primer_apellido || !$genero || !$birthdate || !$pais) {

        print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar los datos requeridos!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

    } elseif (!$hlp->validarTelefono($telefono)) {

        print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar el teléfono en el formato solicitado!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

    } else {


        $OGenero = new Genero();
        $OPais = new Pais();
        $persona = new Persona();

        $OPais->setIdPais($pais);
        $OGenero->set_id_genero($genero);

        $persona->setIdPersona($id);
        $persona->setFirstName($nombre);
        $persona->setLastName($primer_apellido);
        $persona->setEmail($email);
        $persona->setPhone($telefono);
        $persona->setBirthDate($birthdate);
        $persona->setPais($OPais);
        $persona->setGender($OGenero);

        $agregarModel = new PersonaModel();
        $result = $agregarModel->ModificarPersona($persona);

        if ($result) {

            print_r(json_encode([
                "ok" => true,
                "mensaje" => "¡El registro se modificó correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));


        } else {
            print_r(json_encode([
                "ok" => false,
                "mensaje" => "¡Error al actualizar los datos!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
    }
}


function eliminar()
{
    date_default_timezone_set('America/El_Salvador');
    $hlp = new Helper();
    $id = isset($_POST['id']) ? $hlp->limpiarParametro($_POST['id']) : false;


    if (!$id) {

        print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar un identificador correcto!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

    } else {
        $agregarModel = new PersonaModel();
        $result = $agregarModel->EliminarPersona($id);


        if ($result) {
            print_r(json_encode([
                "ok" => true,
                "mensaje" => "¡El registro se eliminó correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));

        } else {
            print_r(json_encode([
                "ok" => false,
                "mensaje" => "¡Error al eliminar los datos!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
    }
}

?>