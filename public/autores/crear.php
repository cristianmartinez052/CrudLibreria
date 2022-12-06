<?php

use Src\Autores;

session_start();

require dirname(__DIR__) . "/../vendor/autoload.php";

function mostrarError($nombre)
{
    if (isset($_SESSION[$nombre])) {
        echo <<<TXT

        <p class="text-danger">{$_SESSION[$nombre]}</p>

        TXT;
        unset($_SESSION[$nombre]);
    }
}

$error = false;

function HayError($n, $a)
{
    //Comprobamos los campos
    if (strlen($n) == 0) {
        $error = true;
        $_SESSION['error_nombre'] = "Error, el campo nombre está vacío!!";
    }

    if (strlen($a) == 0) {
        $error = true;
        $_SESSION['error_apellidos'] = "Error, el campo apellidos está vacío!!";
    }

    return $error;
}

//Procesamos el formulario
if (isset($_POST['btnCrear'])) {
    //Recogemos el valor de los campos
    $nombre = trim(ucfirst($_POST['nombre']));
    $apellidos = trim(ucwords($_POST['apellidos']));

    //Si no hay errores, creamos el autor:
    if (!HayError($nombre, $apellidos)) {
        (new Autores)->setNombre($nombre)
            ->setApellidos($apellidos)
            ->create();
        header("Location:index.php");
        $_SESSION['mensaje'] = "Autor creado correctamente!";
        die();
    }
    header("Location:{$_SERVER['PHP_SELF']}");
} else {





?>

    <!DOCTYPE html>

    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--FONTAWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!--BOOTSTRAP -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <!--SWEETALERT2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title></title>
    </head>

    <body style="background-color:antiquewhite ;">
        <div class="container">
            <h5 class="text-center my-4"> Crear Autor</h5>
            <div class="mb-3">
                <a href="./index.php" class="btn btn-info"><i class="fas fa-backward"></i>&nbsp;Volver</a>
            </div>
            <div class="card mx-auto" style="width: 70% ;">
                <div class="card-body">
                    <div class="card-header">Crear nuevo Autor</div>
                    <form name="borrar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="n" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="n">
                            <?php
                            mostrarError("error_nombre");
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="a" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="a" name="apellidos">
                            <?php
                            mostrarError("error_apellidos");
                            ?>
                        </div>
                        <div class="mb-3">
                            <button name="btnCrear" class="btn btn-success"><i class="fas fa-user"></i>&nbsp;Crear Autor</button>
                            <button type="reset" class="btn btn-danger"><i class="fa-solid fa-broom"></i>&nbsp;Limpiar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </body>

    </html> <?php } ?>