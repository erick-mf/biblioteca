<main>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($errors['general'])) : ?>
        <div style="color: red;"><?php echo htmlspecialchars($errors['general']); ?></div>
    <?php endif; ?>

    <!-- <form action="/login" method="post"> -->
    <!--     <label for="email">Correo:</label><br> -->
    <!--     <input type="email"  name="user[email]" required value="<?php echo htmlspecialchars($_POST['user']['email'] ?? ''); ?>"><br> -->
    <!---->
    <!--     <label for="clave">Contraseña:</label><br> -->
    <!--     <input type="password"  name="user[clave]" required><br> -->
    <!---->
    <!--     <input type="submit" value="Iniciar Sesión"> -->
    <!--     <button type="button" onclick="location.href='/'">Cancelar</button> -->
    <!-- </form> -->
    <!---->
    <!-- <p>¿No tienes una cuenta? <a href="/registrarse">Regístrate aquí</a>.</p> -->

<div class="h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-md-4 col-lg-3">
      <form action="login" method="post">
        <div class="form-group">
          <label for="email">Correo</label>
          <input type="email" class="form-control" name="user[email]" required value="<?php echo htmlspecialchars($_POST['user']['email'] ?? ''); ?>">
        </div><br>
        <div class="form-group">
          <label for="password">Constraseña</label>
          <input type="password" class="form-control" name="user[clave]" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        <button type="button" class="btn btn-danger" onclick="location.href='/'">Cancelar</button>
      </form>
      <p>¿No tienes una cuenta? <a href="/registrarse">Regístrate aquí</a>.</p>
    </div>
  </div>
</div>
</main>
