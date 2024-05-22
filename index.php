<?php
require_once 'LibroController.php';

$controller = new LibroController($conn);
$libros = $controller->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleTable() {
            var table = document.getElementById('tablaLibros');
            var boton = document.getElementById('mostrarBoton');
            if (table.style.display === 'none' || table.style.display === '') {
                table.style.display = 'table';
                boton.textContent = 'Ocultar';
            } else {
                table.style.display = 'none';
                boton.textContent = 'Mostrar';
            }
        }

        function editarLibro(id, titulo, isbn, autor) {
            document.getElementById('id').value = id;
            document.getElementById('titulo').value = titulo;
            document.getElementById('isbn').value = isbn;
            document.getElementById('autor').value = autor;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Gestión de Libros</h1>
        <form method="post" action="index.php">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" required>
            </div>
            <div class="buttons">
                <button type="submit" name="guardar">Guardar</button>
                <button type="submit" name="actualizar">Actualizar</button>
                <button type="button" id="mostrarBoton" onclick="toggleTable()">Mostrar</button>
            </div>
        </form>
        <div class="table-container">
            <table id="tablaLibros" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>ISBN</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                        <tr>
                            <td><?php echo $libro['id']; ?></td>
                            <td><?php echo $libro['titulo']; ?></td>
                            <td><?php echo $libro['isbn']; ?></td>
                            <td><?php echo $libro['autor']; ?></td>
                            <td>
                                <a href="index.php?eliminar=<?php echo $libro['id']; ?>" class="button delete-button">Eliminar</a>
                                <button class="button" onclick="editarLibro(<?php echo $libro['id']; ?>, '<?php echo $libro['titulo']; ?>', '<?php echo $libro['isbn']; ?>', '<?php echo $libro['autor']; ?>')">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
