<?php
require_once 'db.php';
require_once 'Libro.php';

class LibroController {
    private $model;

    public function __construct($conn) {
        $this->model = new Libro($conn);
    }

    public function manejarSolicitud() {
        if (isset($_POST['guardar'])) {
            $this->crearLibro();
        } elseif (isset($_POST['actualizar'])) {
            $this->actualizarLibro();
        } elseif (isset($_GET['eliminar'])) {
            $this->eliminarLibro();
        }
    }

    private function crearLibro() {
        $titulo = $_POST['titulo'];
        $isbn = $_POST['isbn'];
        $autor = $_POST['autor'];
        $this->model->crear($titulo, $isbn, $autor);
        header("Location: index.php");
    }

    private function actualizarLibro() {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $isbn = $_POST['isbn'];
        $autor = $_POST['autor'];
        $this->model->actualizar($id, $titulo, $isbn, $autor);
        header("Location: index.php");
    }

    private function eliminarLibro() {
        $id = $_GET['eliminar'];
        $this->model->eliminar($id);
        header("Location: index.php");
    }

    public function obtenerTodos() {
        return $this->model->obtenerTodos();
    }

    public function obtenerPorId($id) {
        return $this->model->obtenerPorId($id);
    }
}

// Iniciar el controlador y manejar la solicitud
$controller = new LibroController($conn);
$controller->manejarSolicitud();
?>
