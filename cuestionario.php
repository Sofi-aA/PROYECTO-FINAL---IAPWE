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
        
        /* Estilos específicos del cuestionario */
        .pregunta {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        
        .pregunta h3 {
            margin-top: 0;
            color: #333;
        }
        
        .opciones {
            margin-left: 20px;
        }
        
        .opcion {
            margin: 8px 0;
        }
        
        .boton-enviar {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .boton-enviar:hover {
            background-color: #0056b3;
        }
        
        .resultado {
            margin-top: 30px;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
        
        .correcto {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .incorrecto {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .volver {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        
        .volver:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Cuestionario de Voleibol</h1>
        <div class="menu">
            <a href="index.php">Volver a Inicio</a>
            <a href="logout.php">Salir</a>
        </div>
    </div>

    <div class="contenido">
        <h2>Pon a prueba tus conocimientos sobre voleibol</h2>
        <p>Responde las siguientes preguntas basadas en la información de la página principal.</p>
        
        <form id="cuestionario">
            <!-- Pregunta 1 -->
            <div class="pregunta">
                <h3>1. ¿Cuántos jugadores hay en cada equipo de voleibol?</h3>
                <div class="opciones">
                    <div class="opcion">
                        <input type="radio" id="p1a" name="p1" value="a">
                        <label for="p1a">5 jugadores</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p1b" name="p1" value="b">
                        <label for="p1b">6 jugadores</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p1c" name="p1" value="c">
                        <label for="p1c">7 jugadores</label>
                    </div>
                </div>
            </div>
            
            <!-- Pregunta 2 -->
            <div class="pregunta">
                <h3>2. ¿Cuál es el número máximo de toques que puede dar un equipo antes de pasar el balón al campo contrario?</h3>
                <div class="opciones">
                    <div class="opcion">
                        <input type="radio" id="p2a" name="p2" value="a">
                        <label for="p2a">2 toques</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p2b" name="p2" value="b">
                        <label for="p2b">3 toques</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p2c" name="p2" value="c">
                        <label for="p2c">4 toques</label>
                    </div>
                </div>
            </div>
            
            <!-- Pregunta 3 -->
            <div class="pregunta">
                <h3>3. ¿Qué sucede si el balón toca el suelo durante el juego?</h3>
                <div class="opciones">
                    <div class="opcion">
                        <input type="radio" id="p3a" name="p3" value="a">
                        <label for="p3a">Se considera falta y punto para el equipo contrario</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p3b" name="p3" value="b">
                        <label for="p3b">El juego continúa normalmente</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p3c" name="p3" value="c">
                        <label for="p3c">Se repite la jugada</label>
                    </div>
                </div>
            </div>
            
            <!-- Pregunta 4 -->
            <div class="pregunta">
                <h3>4. ¿A cuántos sets se juega normalmente un partido de voleibol?</h3>
                <div class="opciones">
                    <div class="opcion">
                        <input type="radio" id="p4a" name="p4" value="a">
                        <label for="p4a">Al mejor de 3 o 5 sets</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p4b" name="p4" value="b">
                        <label for="p4b">Siempre a 3 sets</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p4c" name="p4" value="c">
                        <label for="p4c">Solo a 5 sets</label>
                    </div>
                </div>
            </div>
            
            <!-- Pregunta 5 -->
            <div class="pregunta">
                <h3>5. ¿Qué jugador tiene la función principal de organizar el ataque del equipo?</h3>
                <div class="opciones">
                    <div class="opcion">
                        <input type="radio" id="p5a" name="p5" value="a">
                        <label for="p5a">Colocador</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p5b" name="p5" value="b">
                        <label for="p5b">Central</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p5c" name="p5" value="c">
                        <label for="p5c">Libero</label>
                    </div>
                </div>
            </div>
            
            <!-- Pregunta 6 -->
            <div class="pregunta">
                <h3>6. ¿Qué jugador tiene un rol defensivo especial y viste un uniforme de color diferente?</h3>
                <div class="opciones">
                    <div class="opcion">
                        <input type="radio" id="p6a" name="p6" value="a">
                        <label for="p6a">Libero</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p6b" name="p6" value="b">
                        <label for="p6b">Jugador de punta</label>
                    </div>
                    <div class="opcion">
                        <input type="radio" id="p6c" name="p6" value="c">
                        <label for="p6c">Jugador opuesto</label>
                    </div>
                </div>
            </div>
            
            <button type="button" class="boton-enviar" onclick="calcularResultado()">Enviar respuestas</button>
        </form>
        
        <div id="resultado" class="resultado"></div>
        
        <a href="index.php" class="volver">← Volver a la página principal</a>
    </div>

    <div class="footer">
        <p>Sofía RODRIGUES CAVALCANTI</p>
        <p>2do ASIR - IAPWE</p>
        <a href="?modo=cambiar">TEMA</a>
    </div>

    <script>
        // Respuestas correctas
        const respuestasCorrectas = {
            p1: "b", // 6 jugadores
            p2: "b", // 3 toques
            p3: "a", // Falta y punto para el equipo contrario
            p4: "a", // Al mejor de 3 o 5 sets
            p5: "a", // Colocador
            p6: "a"  // Libero
        };
        
        function calcularResultado() {
            let puntuacion = 0;
            const totalPreguntas = Object.keys(respuestasCorrectas).length;
            
            // Verificar cada pregunta
            for (let i = 1; i <= totalPreguntas; i++) {
                const pregunta = "p" + i;
                const respuestaSeleccionada = document.querySelector(`input[name="${pregunta}"]:checked`);
                
                if (respuestaSeleccionada && respuestaSeleccionada.value === respuestasCorrectas[pregunta]) {
                    puntuacion++;
                }
            }
            
            // Mostrar resultado
            const resultadoDiv = document.getElementById("resultado");
            const porcentaje = (puntuacion / totalPreguntas) * 100;
            
            let mensaje = "";
            if (porcentaje >= 80) {
                mensaje = `<div class="correcto">
                    <h3>¡Excelente! Obtuviste ${puntuacion} de ${totalPreguntas} puntos (${porcentaje.toFixed(0)}%)</h3>
                    <p>Demuestras un gran conocimiento sobre voleibol.</p>
                </div>`;
            } else if (porcentaje >= 60) {
                mensaje = `<div class="correcto">
                    <h3>¡Buen trabajo! Obtuviste ${puntuacion} de ${totalPreguntas} puntos (${porcentaje.toFixed(0)}%)</h3>
                    <p>Tienes buenos conocimientos sobre voleibol.</p>
                </div>`;
            } else if (porcentaje >= 40) {
                mensaje = `<div class="incorrecto">
                    <h3>Obtuviste ${puntuacion} de ${totalPreguntas} puntos (${porcentaje.toFixed(0)}%)</h3>
                    <p>Puedes mejorar repasando la información en la página principal.</p>
                </div>`;
            } else {
                mensaje = `<div class="incorrecto">
                    <h3>Obtuviste ${puntuacion} de ${totalPreguntas} puntos (${porcentaje.toFixed(0)}%)</h3>
                    <p>Te recomiendo revisar la información sobre voleibol en la página principal.</p>
                </div>`;
            }
            
            resultadoDiv.innerHTML = mensaje;
            resultadoDiv.style.display = "block";
            
            // Desplazar hacia el resultado
            resultadoDiv.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>