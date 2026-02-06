<?php
// app/Controladores/ControladorCursos.php
require_once __DIR__ . '/../Modelos/RepositorioCursos.php';

class ControladorCursos {
    private $repositorio;

    public function __construct() {
        $this->repositorio = new RepositorioCursos();
    }

    public function listar(): void {
        try {
            $cursos = $this->repositorio->obtenerTodos();
            $this->renderizar('cursos/listar', ['cursos' => $cursos]);
        } catch (Exception $e) {
            $this->registrarError("LISTAR", $e);
            $this->renderizar('cursos/listar', [
                'cursos' => [],
                'error' => 'Error al cargar cursos. Verifique errores.log'
            ]);
        }
    }

    public function crear(): void {
        $this->renderizar('cursos/crear', [
            'antiguos' => ['nombre' => '', 'horas' => ''],
            'error' => ''
        ]);
    }

    public function guardar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=listar');
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $horas = trim($_POST['horas'] ?? '');

        try {
            $this->validar($nombre, $horas);
            $curso = new Curso(
                null,
                $nombre,
                (int)$horas,
                date('Y-m-d H:i:s')
            );
            $this->repositorio->insertar($curso);
            header('Location: index.php?accion=listar&exito=1');
            exit;
        } catch (Exception $e) {
            $this->registrarError("GUARDAR", $e);
            $this->renderizar('cursos/crear', [
                'error' => $e->getMessage(),
                'antiguos' => ['nombre' => $nombre, 'horas' => $horas]
            ]);
        }
    }

    private function validar(string $nombre, string $horas): void {
        if (mb_strlen($nombre) < 3) {
            throw new Exception("El nombre debe tener al menos 3 caracteres");
        }
        if (!ctype_digit($horas) || $horas === '') {
            throw new Exception("Las horas deben ser un número entero positivo");
        }
        $horasNum = (int)$horas;
        if ($horasNum < 1 || $horasNum > 1000) {
            throw new Exception("Las horas deben estar entre 1 y 1000");
        }
    }

    private function renderizar(string $vista, array $datos = []): void {
        extract($datos);
        $rutaVista = __DIR__ . "/../Vistas/{$vista}.php";
        if (!file_exists($rutaVista)) {
            http_response_code(500);
            die("Error: Vista '{$vista}' no encontrada");
        }
        $vistaContenido = $rutaVista;
        require __DIR__ . '/../Vistas/layout.php';
    }

    private function registrarError(string $contexto, Throwable $e): void {
        $logPath = __DIR__ . '/../../storage/errores.log';
        $mensaje = sprintf(
            "[%s] %s | %s | Archivo: %s | Línea: %d\n",
            date('Y-m-d H:i:s'),
            $contexto,
            $e->getMessage(),
            $e->getFile(),
            $e->getLine()
        );
        file_put_contents($logPath, $mensaje, FILE_APPEND | LOCK_EX);
    }
}