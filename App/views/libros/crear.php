<main>
 <h1>Agregar Nuevo Libro</h1>

    <?php if (!empty($errors)) : ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="/libros/store" method="post">
        <label for="titulo">Título:</label><br />
        <input type="text" id="titulo" name="titulo" required><br />

        <label for="isbn">ISBN:</label><br />
        <input type="text" id="isbn" name="isbn" required><br />

        <label for="editorial">Editorial:</label><br />
        <input type="text" id="editorial" name="editorial" required><br />

        <label for="fecha_publicacion">Fecha de Publicación:</label><br />
        <input type="date" id="fecha_publicacion" name="fecha_publicacion" required><br />

        <input type="submit" value="Agregar Libro">
    </form>

    <a href="/libros">Volver al listado de libros</a>
</main>
