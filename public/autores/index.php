<?php


namespace Src;

session_start();

require dirname(__DIR__) . "/../vendor/autoload.php";

use Src\Autores;

(new Autores)->generarAutores(25);
$autores = (new Autores)->readAll();

$totalAutores = (new Autores)->hayAutores();



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
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!--SWEETALERT2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title></title>
</head>

<body style="background-color:antiquewhite ;">
    <div class="container">
        <h5 class="text-center my-4"> Gestionar Autores</h5>
        <div class="mb-3">

            <a href="crear.php" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Nuevo Autor</a>
            <button type="button" class="btn btn-success">
                Total Autores <span class="badge text-bg-danger"><?php echo $totalAutores ?></span>
            </button>
        </div>

        <table class="table table-striped bg-light" id="tabla">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($autores as $item) {
                    echo <<<TXT

                    <tr>
                    <th scope="row">{$item->id_autor}</th>
                    <td>{$item->nombre}</td>
                    <td>{$item->apellidos}</td>
                    <td>
                        <form name='s' action='borrar.php' method='POST'>
                            <input type='hidden' name='id' value='$item->id_autor'>
                            <a href="update.php?id={$item->id_autor}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    </tr>



                    TXT;
                }


                if (isset($_SESSION['mensaje'])) {
                    echo <<<TXT
                        <script>
                        Swal.fire({
                            icon: 'success',
                            title: '{$_SESSION['mensaje']}',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        </script>
                    TXT;
                    unset($_SESSION['mensaje']);
                }
                ?>

            </tbody>


        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
        });
    </script>
</body>

</html>