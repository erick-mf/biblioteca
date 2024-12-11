<main>
    <h1>Registro de Usuario</h1>

    <form action="/registrarse" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="user[nombre]" required value="<?php echo htmlspecialchars($_POST['user']['nombre'] ?? ''); ?>">
        <?php if (isset($errors['nombre'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['nombre']); ?></span>
        <?php endif; ?><br>

        <label for="apellido1">Primer Apellido:</label><br>
        <input type="text" id="apellido1" name="user[apellido1]" required value="<?php echo htmlspecialchars($_POST['user']['apellido1'] ?? ''); ?>">
        <?php if (isset($errors['apellido1'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['apellido1']); ?></span>
        <?php endif; ?><br>

        <label for="apellido2">Segundo Apellido:</label><br>
        <input type="text" id="apellido2" name="user[apellido2]" value="<?php echo htmlspecialchars($_POST['user']['apellido2'] ?? ''); ?>">
        <?php if (isset($errors['apellido2'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['apellido2']); ?></span>
        <?php endif; ?><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="user[direccion]" value="<?php echo htmlspecialchars($_POST['user']['direccion'] ?? ''); ?>">
        <?php if (isset($errors['direccion'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['direccion']); ?></span>
        <?php endif; ?><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="user[email]" required value="<?php echo htmlspecialchars($_POST['user']['email'] ?? ''); ?>">
        <?php if (isset($errors['email'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['email']); ?></span>
        <?php endif; ?><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="tel" id="telefono" name="user[telefono]" value="<?php echo htmlspecialchars($_POST['user']['telefono'] ?? ''); ?>">
        <?php if (isset($errors['telefono'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['telefono']); ?></span>
        <?php endif; ?><br>

        <label for="dni">DNI:</label><br>
        <input type="text" id="dni" name="user[dni]" required value="<?php echo htmlspecialchars($_POST['user']['dni'] ?? ''); ?>">
        <?php if (isset($errors['dni'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['dni']); ?></span>
        <?php endif; ?><br>

        <label for="clave">Contraseña:</label><br>
        <input type="password" id="clave" name="user[clave]" required>
        <?php if (isset($errors['clave'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['clave']); ?></span>
        <?php endif; ?><br>

        <label for="clave_confirmacion">Confirmar Contraseña:</label><br>
        <input type="password" id="clave_confirmacion" name="user[clave_confirmacion]" required>
        <?php if (isset($errors['clave_confirmacion'])) : ?>
            <span style="color: red;"><?php echo htmlspecialchars($errors['clave_confirmacion']); ?></span>
        <?php endif; ?><br>

 <?php if ($userRole === 'administrador') : ?>
        <label for="rol">Rol:</label>
        <select name="user[rol]">
            <option value="lector">Lector</option>
            <option value="bibliotecario">Bibliotecario</option>
        </select>
    <?php else: ?>
        <input type="hidden" name="user[rol]" value="lector">
    <?php endif; ?><br>

        <input type="submit" value="Registrarse">
        <button type="button" onclick="location.href='/'">Cancelar</button>
    </form>

    <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a>.</p>
</main>
