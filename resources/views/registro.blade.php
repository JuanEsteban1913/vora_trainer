<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vora Trainer - Registro</title>
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <style>
        .mitad-izquierda {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)), url('{{ asset('registro_2.png') }}') !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }
        /* Estilos visuales para los botones de roles */
        .rol-label {
            flex: 1;
            background: #18181b;
            border: 1px solid #27272a;
            padding: 10px 8px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            font-size: 13px;
            color: #9ca3af;
            transition: all 0.2s ease;
        }
        .rol-label.activo {
            border-color: #a3e635;
            color: #ffffff;
            background: rgba(163, 230, 53, 0.05);
        }
    </style>
</head>
<body>

    <main class="contenedor-login">
        
        <!-- MITAD IZQUIERDA: Fondo con atleta y estadísticas -->
        <section class="mitad-izquierda">
            <div class="cabecera-izquierda">
                <img src="{{ asset('logo.png') }}" alt="Logo Vora" class="logo-pequeno">
                <a href="{{ route('login') }}" class="volver-inicio">← Volver al inicio</a>
            </div>

            <div class="textos-motivacionales">
                <h1>Tu mejor versión<br>comienza aquí.</h1>
                <p>Rutinas personalizadas, nutrición profesional y seguimiento de progreso real.</p>
                
                <div style="display: flex; gap: 25px; margin-top: 30px; color: #ffffff;">
                    <div>
                        <span style="color: #a3e635; font-size: 20px; font-weight: bold; display: block;">2,400+</span>
                        <span style="font-size: 11px; color: #e5e7eb;">Usuarios activos</span>
                    </div>
                    <div>
                        <span style="color: #a3e635; font-size: 20px; font-weight: bold; display: block;">98%</span>
                        <span style="font-size: 11px; color: #e5e7eb;">Satisfacción</span>
                    </div>
                    <div>
                        <span style="color: #a3e635; font-size: 20px; font-weight: bold; display: block;">150+</span>
                        <span style="font-size: 11px; color: #e5e7eb;">Entrenadores</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- MITAD DERECHA: Formulario de Registro -->
        <section class="mitad-derecha">
            <div class="caja-formulario">
                <h2 style="color: #ffffff; font-size: 26px; margin-bottom: 6px;">Crea tu cuenta</h2>
                <p class="subtitulo" style="color: #d1d5db; margin-bottom: 18px; font-size: 13px;">Empieza tu transformación hoy — es completamente gratis.</p>

                @if ($errors->any())
                    <div class="alerta-error" style="color: #f87171; background: rgba(220, 38, 38, 0.1); border: 1px solid #dc2626; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 13px;">
                        ⚠️ {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/register" id="form-registro">
    @csrf
    
    <div class="grupo-input">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="name" value="{{ old('name') }}" placeholder="Tu nombre completo" required autofocus class="campo-progreso">
    </div>

    <div class="grupo-input">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required class="campo-progreso">
    </div>

    <div style="display: flex; gap: 15px;">
        <div class="grupo-input" style="flex: 1;">
            <label for="clave">Contraseña</label>
            <input type="password" id="clave" name="password" placeholder="••••••••" required class="campo-progreso">
        </div>
        <div class="grupo-input" style="flex: 1;">
            <label for="clave_confirmation">Confirmar contraseña</label>
            <input type="password" id="clave_confirmation" name="password_confirmation" placeholder="••••••••" required class="campo-progreso">
        </div>
    </div>

    <!-- Indicador de progreso y seguridad dinámico -->
    <div style="margin: -2px 0 15px 0;">
        <div style="background: #27272a; height: 4px; border-radius: 2px; width: 100%; margin-bottom: 4px; overflow: hidden;">
            <div id="barra-progreso" style="background: #a3e635; height: 100%; width: 0%; transition: width 0.3s ease, background-color 0.3s ease;"></div>
        </div>
        <span id="texto-progreso" style="color: #9ca3af; font-size: 11px;">Completa los campos para avanzar...</span>
    </div>

    <!-- Términos y condiciones -->
    <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 18px;">
        <input type="checkbox" id="terms" required style="accent-color: #a3e635; margin-top: 3px;">
        <label for="terms" style="color: #9ca3af; font-size: 11px; line-height: 1.3;">
            Acepto los términos y la política de tratamiento de datos personales (Ley 1581 de 2012)
        </label>
    </div>

    <button type="submit" class="btn-neon">Registrarse</button>
</form>

                <p class="enlace-registro" style="margin-top: 15px; text-align: center; color: #9ca3af; font-size: 13px;">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color: #a3e635; text-decoration: none;">Inicia sesión</a>
                </p>
            </div>
        </section>

    </main>

    <!-- Script de JavaScript para la barra de progreso y cambio visual de roles -->
    <script>
        const campos = document.querySelectorAll('.campo-progreso');
        const barra = document.getElementById('barra-progreso');
        const textoProgreso = document.getElementById('texto-progreso');

        function actualizarProgreso() {
            let totalCampos = campos.length;
            let llenos = 0;

            campos.forEach(campo => {
                if (campo.value.trim() !== '') {
                    llenos++;
                }
            });

            let porcentaje = (llenos / totalCampos) * 100;
            barra.style.width = porcentaje + '%';

            if (porcentaje === 0) {
                barra.style.backgroundColor = '#a3e635';
                textoProgreso.textContent = 'Completa los campos para avanzar...';
                textoProgreso.style.color = '#9ca3af';
            } else if (porcentaje < 100) {
                barra.style.backgroundColor = '#facc15'; // Amarillo intermedio
                textoProgreso.textContent = '¡Buen progreso! Sigue llenando los datos.';
                textoProgreso.style.color = '#facc15';
            } else {
                barra.style.backgroundColor = '#a3e635'; // Verde completo
                textoProgreso.textContent = '✔ ¡Formulario listo para registrarse!';
                textoProgreso.style.color = '#a3e635';
            }
        }

        campos.forEach(campo => {
            campo.addEventListener('input', actualizarProgreso);
        });

        // Función para iluminar visualmente el rol seleccionado
        function actualizarRol(rolSeleccionado) {
            document.querySelectorAll('.rol-label').forEach(label => {
                label.classList.remove('activo');
            });
            document.getElementById('label-' + rolSeleccionado).classList.add('activo');
        }
    </script>
</body>
</html>