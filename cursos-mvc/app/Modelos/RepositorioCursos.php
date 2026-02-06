<?php
// app/Modelos/RepositorioCursos.php
require_once __DIR__ . '/ConexionBD.php';
require_once __DIR__ . '/Curso.php';

class RepositorioCursos {
    private $conexion;

    public function __construct() {
        $this->conexion = ConexionBD::obtenerConexion();
    }

    public function insertar(Curso $curso): void {
        $sql = "INSERT INTO cursos (nombre, horas, fecha_creacion) 
                VALUES (:nombre, :horas, :fecha)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $curso->nombre,
            ':horas' => $curso->horas,
            ':fecha' => $curso->fechaCreacion
        ]);
    }

    public function obtenerTodos(): array {
        $sql = "SELECT * FROM cursos ORDER BY fecha_creacion DESC";
        $stmt = $this->conexion->query($sql);
        $cursos = [];
        while ($fila = $stmt->fetch()) {
            $cursos[] = new Curso(
                $fila['id'],
                $fila['nombre'],
                $fila['horas'],
                $fila['fecha_creacion']
            );
        }
        return $cursos;
    }
}