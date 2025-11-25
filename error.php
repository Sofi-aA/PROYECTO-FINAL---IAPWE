<?php
session_start();

// Verificar que realmente superó los intentos
if(!isset($_SESSION['intentos']) || $_SESSION['intentos'] < 3){
    header("location: login.php");
    exit;
}

// Manejar idioma
$idioma = $_GET["idioma"] ?? "es";
$fichero = "$idioma.php";

if(file_exists($fichero)){
    require $fichero;
} else {
    require "es.php";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 100px auto; padding: 20px; text-align: center; }
        .error { background: #ffebee; padding: 20px; border-radius: 5px; }
        .btn { display: inline-block; padding: 10px 20px; background: blue; color: white; text-decoration: none; }
    </style>
</head>
<body>

    <h1>Error</h1>
    <style>
            .footer { 
            text-align: center; 
            color: #666666; /* COLOR GRIS */
            margin-top: 40px;
            padding: 20px;
            border-top: 1px solid #ccc;
        }
    </style>


    <div class="error">
        <p>Ha excedido el número máximo permitido de</p>
        <p>intentos de sesión.</p>
        <p>Volver intentarlo 👇​</p>
    </div>
    
    <br>
    <a href="logout.php" class="btn">Volver al login</a>


        <div class="footer">
        <p>Sofía RODRIGUES CAVALCANTI</p>
        <p>2do ASIR - IAPWE</p>
    </div>
</body>
</html>