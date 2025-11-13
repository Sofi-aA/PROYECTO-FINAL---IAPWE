<?php
session_start();

$idioma = $_GET["idioma"] ?? "es";
$fichero = "$idioma.php";

if(file_exists($fichero)){
    require $fichero;
} else {
    require "es.php";
}

$usuario_correcto = "Sofi";
$contraseña_correcta = "1234";

if(!isset($_SESSION['intentos'])){
    $_SESSION['intentos'] = 0;
}

$mensaje_error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = $_POST["user"] ?? "";
    $contraseña = $_POST["pass"] ?? "";
    
    if($_SESSION['intentos'] >= 3){
        header("location: error.php");
        exit;
    }
    
    if($usuario_correcto == $usuario && $contraseña_correcta == $contraseña){
        $_SESSION['logueado'] = true;
        $_SESSION['intentos'] = 0;
        header("location: home.php");
        exit;
    } else {
        $_SESSION['intentos']++;
        $intentos_restantes = 3 - $_SESSION['intentos'];
        
        if($intentos_restantes > 0){
            $mensaje_error = $traducciones['error_login'] . ". " . str_replace('X', $intentos_restantes, $traducciones['intentos_restantes']);
        } else {
            header("location: error.php");
            exit;
        }
    }
}
?>

<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 100px auto; padding: 20px; }
        input { width: 100%; padding: 8px; margin: 5px 0; }
        button { width: 100%; padding: 10px; background: blue; color: white; border: none; }
        .error { color: red; margin: 10px 0; }
        .footer { 
            text-align: center; 
            color: #666666; /* COLOR GRIS */
            margin-top: 40px;
            padding: 20px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <div style="text-align: center; margin: 20px 0;">
        <a href="?idioma=es">ES</a> | 
        <a href="?idioma=en">EN</a> | 
        <a href="?idioma=pt">PT</a>
    </div>

    <h2>Login</h2>

    <form method="POST">
        <p><strong><?= $traducciones['usuario'] ?>:</strong></p>
        <input type="text" name="user" required>
        
        <p><strong><?= $traducciones['contraseña'] ?>:</strong></p>
        <input type="password" name="pass" required>
        
        <br><br>
        <button type="submit">Entrar</button>
    </form>

    <?php if(!empty($mensaje_error)): ?>
        <div class="error">
            <?= $mensaje_error ?>
        </div>
    <?php endif; ?>


    <div class="footer">
        <p>Sofía RODRIGUES CAVALCANTI</p>
        <p>2do ASIR - IAPWE</p>
    </div>
</body>
</html>