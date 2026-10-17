<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vora Trainer - Login</title>
    <link rel="stylesheet" href="/estilos.css">
</head>
<body>

    <main class="contenedor-login">
        
        <!-- MITAD IZQUIERDA: Imagen y textos -->
        <section class="mitad-izquierda">
            <div class="cabecera-izquierda">
                <!-- Aquí usaremos el logo que ya subiste -->
                <img src="/logo.png" alt="Logo Vora" class="logo-pequeno">
                <a href="#" class="volver-inicio">← Volver al inicio</a>
            </div>

            <div class="textos-motivacionales">
                <h1>Cada día que entrenas,<br>la distancia crece.</h1>
                <p>Tus rutinas, tu plan nutricional y tu progreso te esperan.</p>
                
                <div class="etiquetas-seguridad">
                    <span>🛡️ Acceso seguro</span>
                    <span>🔒 Datos protegidos</span>
                    <span>⚡ Acceso instantáneo</span>
                </div>
            </div>
        </section>

        <!-- MITAD DERECHA: Formulario de Login -->
        <section class="mitad-derecha">
            <div class="caja-formulario">
                <h2>Bienvenido de vuelta</h2>
                <p class="subtitulo">Ingresa tus credenciales para acceder a tu cuenta.</p>

                <!-- Mensaje de error de ejemplo (como en tu imagen) -->
                <div class="alerta-error">
                    ⚠️ Error en las credenciales
                </div>

                <form>
                    <div class="grupo-input">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" id="correo" placeholder="correo@ejemplo.com">
                    </div>

                    <div class="grupo-input">
                        <div class="etiquetas-contrasena">
                            <label for="clave">Contraseña</label>
                            <a href="#" class="olvido-clave">¿Olvidaste tu contraseña?</a>
                        </div>
                        <input type="password" id="clave" placeholder="••••••••">
                    </div>

                    <button type="button" class="btn-neon">Iniciar sesión</button>
                </form>

                <div class="separador">o continúa con</div>

                <button class="btn-google">Iniciar con Google — Próximamente</button>

                <p class="enlace-registro">¿No tienes cuenta? <a href="#">Regístrate</a></p>
            </div>
        </section>

    </main>

</body>
</html>