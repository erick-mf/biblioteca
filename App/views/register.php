<main>
    <h1>Registro de Usuario</h1>

    <form action="/registrarse" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text"  name="user[nombre]" required value="<?php echo htmlspecialchars($_POST['user']['nombre'] ?? ''); ?>">
        <?php if (isset($errors['nombre'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['nombre']); ?></span>
        <?php endif; ?><br>

        <label for="apellido1">Primer Apellido:</label><br>
        <input type="text"  name="user[apellido1]" required value="<?php echo htmlspecialchars($_POST['user']['apellido1'] ?? ''); ?>">
        <?php if (isset($errors['apellido1'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['apellido1']); ?></span>
        <?php endif; ?><br>

        <label for="apellido2">Segundo Apellido:</label><br>
        <input type="text"  name="user[apellido2]" value="<?php echo htmlspecialchars($_POST['user']['apellido2'] ?? ''); ?>">
        <?php if (isset($errors['apellido2'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['apellido2']); ?></span>
        <?php endif; ?><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text"  name="user[direccion]" value="<?php echo htmlspecialchars($_POST['user']['direccion'] ?? ''); ?>">
        <?php if (isset($errors['direccion'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['direccion']); ?></span>
        <?php endif; ?><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="email"  name="user[email]" required value="<?php echo htmlspecialchars($_POST['user']['email'] ?? ''); ?>">
        <?php if (isset($errors['email'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['email']); ?></span>
        <?php endif; ?><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="tel"  name="user[telefono]" value="<?php echo htmlspecialchars($_POST['user']['telefono'] ?? ''); ?>">
        <?php if (isset($errors['telefono'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['telefono']); ?></span>
        <?php endif; ?><br>

        <label for="dni">DNI:</label><br>
        <input type="text"  name="user[dni]" required value="<?php echo htmlspecialchars($_POST['user']['dni'] ?? ''); ?>">
        <?php if (isset($errors['dni'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['dni']); ?></span>
        <?php endif; ?><br>

        <label for="clave">Contraseña:</label><br>
        <input type="password"  name="user[clave]" required><br>
        <?php if (isset($errors['clave'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['clave']); ?></span>
        <?php endif; ?><br>


        <?php if (isset($_SESSION["user_rol"])) : ?>
            <?php if ($_SESSION["user_rol"] === "administrador") : ?>
                <label for="rol">Rol:</label>
                <select name="user[rol]">
                    <option value="bibliotecario">Bibliotecario</option>
                    <option value="lector">Lector</option>
                </select><br>
            <?php elseif ($_SESSION["user_rol"] === "bibliotecario") : ?>
                <label for="rol">Rol:</label>
                <select name="user[rol]">
                    <option value="lector">Lector</option>
                </select><br>
            <?php endif; ?>
        <?php endif; ?><br>

        <input type="submit" value="Registrar">
        <button type="button" onclick="location.href='/'">Cancelar</button>
    </form>

    <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a>.</p>
</main>
