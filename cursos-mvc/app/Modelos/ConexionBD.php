<?php
// app/Modelos/ConexionBD.php
// EN PRODUCCIÓN: Mover credenciales a .env
class ConexionBD {
    private static $conexion = null;

    public static function obtenerConexion() {
        if (self::$conexion === null) {
            $host = "localhost";
            $baseDatos = "formacion";
            $usuario = "root";
            $password = "root123";

            try {
                $dsn = "mysql:host=$host;dbname=$baseDatos;charset=utf8mb4";
                self::$conexion = new PDO($dsn, $usuario, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("FATAL: " . $e->getMessage());
                die("Error crítico: Base de datos no disponible. Contacte al administrador.");
            }
        }
        return self::$conexion;
    }
}