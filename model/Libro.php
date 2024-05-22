<?php
class Libro {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crear($titulo, $isbn, $autor) {
        $stmt = $this->conn->prepare("INSERT INTO libros (titulo, isbn, autor) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $titulo, $isbn, $autor);
        $stmt->execute();
        $stmt->close();
    }

    public function actualizar($id, $titulo, $isbn, $autor) {
        $stmt = $this->conn->prepare("UPDATE libros SET titulo = ?, isbn = ?, autor = ? WHERE id = ?");
        $stmt->bind_param("sssi", $titulo, $isbn, $autor, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM libros WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function obtenerTodos() {
        $result = $this->conn->query("SELECT * FROM libros");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM libros WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
