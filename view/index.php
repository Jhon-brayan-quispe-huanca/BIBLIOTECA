<?php
require_once '../controller/LibroController.php';
$controller = new LibroController($conn);
$libros = $controller->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Libros</h1>
        <form action="../controller/LibroController.php" method="post">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" required>
            </div>
            <div class="buttons">
                <button type="submit" name="guardar">Guardar</button>
                <button type="reset">Nuevo</button>
            </div>
        </form>

        <div class="table-container">
            <table>
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
                                <a class="button" href="editar.php?id=<?php echo $libro['id']; ?>">Editar</a>
                                <a class="button delete-button" href="../controller/LibroController.php?eliminar=<?php echo $libro['id']; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
