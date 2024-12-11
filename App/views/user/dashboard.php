<h1><?php session_start(); print $_SESSION["user_name"]; ?></h1>
<button type="button" onclick="location.href='/logout'">Cerrar Sesión</button>
