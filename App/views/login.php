<main>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($errors['general'])) : ?>
        <div style="color: red;"><?php echo htmlspecialchars($errors['general']); ?></div>
    <?php endif; ?>

    <form action="/login" method="post">
        <label for="email">Correo:</label><br>
        <input type="email" id="email" name="user[email]" required value="<?php echo htmlspecialchars($_POST['user']['email'] ?? ''); ?>"><br>

        <label for="clave">Contraseña:</label><br>
        <input type="password" id="clave" name="user[clave]" required><br>

        <input type="submit" value="Iniciar Sesión">
        <button type="button" onclick="location.href='/'">Cancelar</button>
    </form>

    <p>¿No tienes una cuenta? <a href="/registrarse">Regístrate aquí</a>.</p>
</main>
