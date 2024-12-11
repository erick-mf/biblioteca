<main>
    <h1>Listado de Libros</h1>
    <a href="/libros/crear">Agregar Nuevo Libro</a>

    <?php if (!empty($libros)) : ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>ISBN</th>
                <th>Editorial</th>
                <th>Fecha de Publicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
            <tr>
                <td><?php echo htmlspecialchars($libro->id_libro()); ?></td>
                <td><?php echo htmlspecialchars($libro->titulo()); ?></td>
                <td><?php echo htmlspecialchars($libro->isbn()); ?></td>
                <td><?php echo htmlspecialchars($libro->editorial()); ?></td>
                <td><?php echo htmlspecialchars($libro->fecha_publicacion()); ?></td>
                <td>
                    <a href="/libros/<?php echo $libro->id_libro(); ?>">Ver</a> |
                    <a href="/libros/edit/<?php echo $libro->id_libro(); ?>">Editar</a> |
                    <a href="/libros/delete/<?php echo $libro->id_libro(); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No hay libros disponibles en la biblioteca.</p>
    <?php endif; ?>
</main>
