<?php
session_start();

if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voleibol</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { background: #007bff; color: white; padding: 15px; text-align: center; }
        .menu { margin: 10px 0; }
        .menu a { color: white; margin: 0 10px; text-decoration: none; }
        .contenido { padding: 20px; }
        .footer { 
            text-align: center; 
            color: #666666;
            margin-top: 40px;
            padding: 20px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Voleibol</h1>
        <div class="menu">
            <a href="logout.php">Salir</a>
        </div>
    </div>

    <div class="contenido">
        <h2>Información sobre Voleibol</h2>
        
        <p>El voleibol es un deporte que se juega con dos equipos de 6 jugadores.</p>
        
        <h3>Reglas básicas:</h3>
        <ul>
            <li>6 jugadores por equipo</li>
            <li>3 toques máximo por equipo</li>
            <li>El balón no puede tocar el suelo</li>
            <li>Se juega al mejor de 3 o 5 sets</li>
            <li>No se puede tocar la red</li>
        </ul>

        <h3>Posiciones:</h3>
        <ul>
            <li>Colocador</li>
            <li>Central</li>
            <li>Libero</li>
            <li>Jugador de punta</li>
            <li>Jugador opuesto</li>
        </ul>

        
    </div>

    <div class="footer">
        <p>Sofía RODRIGUES CAVALCANTI</p>
        <p>2do ASIR - IAPWE</p>
    </div>
</body>
</html>