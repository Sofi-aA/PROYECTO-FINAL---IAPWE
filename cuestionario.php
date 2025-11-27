<?php
session_start();

if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true){
    header("location: login.php");
    exit;
};

// fondo
if (isset($_GET["modo"])){ 
    if (!isset($_SESSION["modo"])){ 
        $_SESSION["modo"] = "oscuro"; 
    } else { 
        if ($_SESSION["modo"] == "claro") { 
            $_SESSION["modo"] = "oscuro";
        } else {
            $_SESSION["modo"] = "claro";
        } 
    } 
} 

$modo = $_SESSION["modo"] ?? "claro"; 
$css = "$modo.css"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cuestionario de Voleibol</title>
    <link rel="stylesheet" href="<?= $css ?>">
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
        
        .pregunta { margin-bottom: 25px; padding: 15px; border: 1px solid #ddd; }
        .boton-enviar { background: #007bff; color: white; border: none; padding: 12px 25px; cursor: pointer; }
        .resultado { margin-top: 30px; padding: 15px; display: none; }
        .correcto { background: #d4edda; color: #155724; }
        .incorrecto { background: #f8d7da; color: #721c24; }
        .volver { display: block; margin-top: 20px; color: #007bff; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Cuestionario de Voleibol</h1>
        <div class="menu">
            <a href="home.php">Volver a Inicio</a>
            <a href="logout.php">Salir</a>
        </div>
    </div>

    <div class="contenido">
        <h2>Pon a prueba tus conocimientos sobre voleibol</h2>
        
        <form id="cuestionario">
            <!-- Pregunta 1: Tipo escribir -->
            <div class="pregunta">
                <h3>1. ¿Qué jugador organiza el ataque del equipo?</h3>
                <input type="text" name="p1" placeholder="Escribe aquí">
            </div>
            
            <!-- Pregunta 2: Tipo número -->
            <div class="pregunta">
                <h3>2. ¿Cuántos jugadores por equipo?</h3>
                <input type="number" name="p2" placeholder="Número">
            </div>
            
            <!-- Pregunta 3: Tipo test -->
            <div class="pregunta">
                <h3>3. ¿Máximo de toques por equipo?</h3>
                <input type="radio" name="p3" value="2"> 2 toques<br>
                <input type="radio" name="p3" value="3"> 3 toques<br>
                <input type="radio" name="p3" value="4"> 4 toques
            </div>
            
            <!-- Pregunta 4: Tipo escribir -->
            <div class="pregunta">
                <h3>4. ¿Jugador con uniforme diferente?</h3>
                <input type="text" name="p4" placeholder="Escribe aquí">
            </div>
            
            <!-- Pregunta 5: Tipo número -->
            <div class="pregunta">
                <h3>5. ¿Sets que se juegan?</h3>
                <input type="number" name="p5" placeholder="Número">
            </div>
            
            <button type="button" class="boton-enviar" onclick="calcular()">Enviar respuestas</button>
        </form>
        
        <div id="resultado" class="resultado"></div>

    <div class="footer">
        <p>Sofía RODRIGUES CAVALCANTI</p>
        <p>2do ASIR - IAPWE</p>
        <a href="?modo=cambiar">TEMA</a>
    </div>

    <script>
        function calcular() {
            // Respuestas correctas
            var correctas = {
                p1: "colocador",
                p2: 6,
                p3: "3",
                p4: "libero", 
                p5: 3
            };
            
            var puntos = 0;
            var total = 5;
            
            // Revisar cada pregunta
            for(var i = 1; i <= total; i++) {
                var pregunta = "p" + i;
                var respuesta = document.querySelector('[name="' + pregunta + '"]');
                var valor = "";
                
                if(respuesta.type == "text") {
                    valor = respuesta.value.toLowerCase().trim();
                } else if(respuesta.type == "number") {
                    valor = parseInt(respuesta.value);
                } else if(respuesta.type == "radio") {
                    var seleccionada = document.querySelector('[name="' + pregunta + '"]:checked');
                    valor = seleccionada ? seleccionada.value : "";
                }
                
                if(valor == correctas[pregunta]) {
                    puntos++;
                }
            }
            
            // Mostrar resultado
            var resultado = document.getElementById("resultado");
            var porcentaje = (puntos / total) * 100;
            
            if(porcentaje >= 60) {
                resultado.className = "resultado correcto";
                resultado.innerHTML = "<h3>¡Bien! Tienes " + puntos + " de " + total + " puntos</h3>";
            } else {
                resultado.className = "resultado incorrecto"; 
                resultado.innerHTML = "<h3>Tienes " + puntos + " de " + total + " puntos. Puedes mejorar.</h3>";
            }
            
            resultado.style.display = "block";
        }
    </script>
</body>
</html>