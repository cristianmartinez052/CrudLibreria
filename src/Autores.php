<?php

namespace Src;

use PDO;
use PDOException;
use PDORow;
use Faker;



class Autores extends Conexion
{

    private int $id;
    private string $nombre;
    private string $apellidos;

    public function __construct()
    {
        parent::__construct();
    }

    //_____________Metodos_______________//

    public function create()
    {
        $q = "insert into autores(nombre,apellidos) values(:n,:a)";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':a' => $this->apellidos
            ]);
        } catch (PDOException $ex) {
            die("Error en el create" . $ex->getMessage());
        }
        parent::$conexion = null;
    }

    public function read($id)
    {
        $q = "select * from autores where id_autor=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([':i' => $id]);
        } catch (PDOException $ex) {
            die("Error en el read" . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }



    public function delete($id)
    {
        $q = "delete from autores where id_autor=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':i' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error al Borrar el autor: " . $ex->getMessage());
        }
        parent::$conexion = null;
    }

    public function update($id)
    {
        $q = "update autores set nombre=:n,apellidos=:a where id_autor=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':a' => $this->apellidos,
                ':i' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error en el update" . $ex->getMessage());
        }
        parent::$conexion = null;
    }


    public function readAll()
    {
        $q = "select * from autores";
        $stmt = parent::$conexion->prepare($q);

        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error en leer todos" . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function generarAutores($cant)
    {
        if ($this->hayAutores()) return;
        //Si hay autores los creamos
        $faker = \Faker\Factory::create('es_ES');
        for ($i = 0; $i <= $cant; $i++) {
            $nombre = $faker->firstname();
            $apellidos = $faker->lastName() . " " . $faker->lastName();
            (new Autores)->setNombre($nombre)
                ->setApellidos($apellidos)
                ->create();
        }
    }

    public function hayAutores()
    {
        $q = "select * from autores";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error en hay autores" . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->rowCount(); //Devuelve el número de filas
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }
}
