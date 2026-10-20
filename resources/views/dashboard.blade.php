<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vora Trainer - Panel Principal</title>
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
</head>
<body style="background-color: #0b0b0b; color: #ffffff; font-family: sans-serif; margin: 0; padding: 0;">

    <!-- Cabecera del Dashboard -->
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; border-bottom: 1px solid #27272a;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('logo.png') }}" alt="Logo Vora" style="height: 35px;">
            <span style="font-weight: bold; font-size: 18px; letter-spacing: 0.5px;">Vora Trainer</span>
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <span style="color: #9ca3af; font-size: 14px;">Hola, <strong style="color: #ffffff;">{{ auth()->user()->user_name }}</strong></span>
            
            <!-- Botón para cerrar sesión -->
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: transparent; border: 1px solid #dc2626; color: #f87171; padding: 6px 14px; border-radius: 6px; cursor: pointer; font-size: 13px; transition: background 0.2s;">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main style="padding: 40px; max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 28px; margin-bottom: 8px;">Panel Principal</h1>
        <p style="color: #9ca3af; margin-bottom: 30px; font-size: 14px;">Bienvenido a tu espacio de control y seguimiento en Vora Trainer.</p>

        <!-- SECCIÓN CONDICIONAL SEGÚN EL ROL -->
        @if(auth()->user()->role === 'entrenador' || auth()->user()->role === 'nutricionista')
            <!-- Vista exclusiva para Entrenadores o Nutricionistas (Admins / Profesionales) -->
            <div style="background: #18181b; border: 1px solid #27272a; border-left: 4px solid #a3e635; padding: 24px; border-radius: 8px; margin-bottom: 25px;">
                <h3 style="color: #a3e635; margin-top: 0; font-size: 20px;">Panel de Gestión Profesional ({{ ucfirst(auth()->user()->role) }})</h3>
                <p style="color: #d1d5db; font-size: 14px; line-height: 1.5;">Tienes privilegios de administración. Desde aquí puedes supervisar clientes, diseñar rutinas de entrenamiento y asignar planes nutricionales personalizados.</p>
                
                <div style="display: flex; gap: 15px; margin-top: 20px;">
                    <button style="background: #a3e635; color: #000; border: none; padding: 10px 18px; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 13px;">+ Crear Nueva Rutina</button>
                    <button style="background: #27272a; color: #fff; border: 1px solid #3f3f46; padding: 10px 18px; border-radius: 6px; cursor: pointer; font-size: 13px;">Ver Mis Clientes</button>
                </div>
            </div>
        @else
            <!-- Vista para Clientes -->
            <div style="background: #18181b; border: 1px solid #27272a; border-left: 4px solid #3b82f6; padding: 24px; border-radius: 8px; margin-bottom: 25px;">
                <h3 style="color: #60a5fa; margin-top: 0; font-size: 20px;">Tu Progreso Personal</h3>
                <p style="color: #d1d5db; font-size: 14px; line-height: 1.5;">Aquí encontrarás tus entrenamientos asignados para hoy, gráficos de evolución y directrices de tu nutricionista.</p>
                
                <div style="display: flex; gap: 15px; margin-top: 20px;">
                    <button style="background: #3b82f6; color: #fff; border: none; padding: 10px 18px; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 13px;">Ver Mi Rutina de Hoy</button>
                    <button style="background: #27272a; color: #fff; border: 1px solid #3f3f46; padding: 10px 18px; border-radius: 6px; cursor: pointer; font-size: 13px;">Registrar Mis Métricas</button>
                </div>
            </div>
        @endif

        <!-- Tarjetas de resumen secundarias -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 30px;">
            <div style="background: #18181b; border: 1px solid #27272a; padding: 20px; border-radius: 8px;">
                <h4 style="margin: 0; color: #9ca3af; font-size: 13px; text-transform: uppercase;">Estado de la Cuenta</h4>
                <p style="font-size: 18px; font-weight: bold; color: #a3e635; margin: 10px 0 0 0;">Activa (Verificada)</p>
            </div>
            
            <div style="background: #18181b; border: 1px solid #27272a; padding: 20px; border-radius: 8px;">
                <h4 style="margin: 0; color: #9ca3af; font-size: 13px; text-transform: uppercase;">Rol Asignado</h4>
                <p style="font-size: 18px; font-weight: bold; color: #ffffff; margin: 10px 0 0 0; text-transform: capitalize;">
                    {{ auth()->user()->role ?? 'Cliente' }}
                </p>
            </div>
        </div>
    </main>
</body>
</html>