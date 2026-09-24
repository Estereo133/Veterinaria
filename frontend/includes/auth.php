<?php

// Iniciar sesión
function iniciarSesion()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Redirigir a otra página
function redirigir($ruta)
{
    header('Location: ' . $ruta);
    exit;
}

// Autenticar usuario
function autenticar($email, $contrasena)
{
    // Por ahora usamos un usuario de prueba.
    // Después lo conectaremos con MySQL.

    $usuarioDemo = 'admin';
    $contrasenaDemo = '1234';

    if ($email === $usuarioDemo && $contrasena === $contrasenaDemo) {

        iniciarSesion();

        $_SESSION['id_usuario'] = 1;
        $_SESSION['nombre_usuario'] = 'Administrador';
        $_SESSION['email_usuario'] = $email;

        return [
            'ok' => true,
            'mensaje' => 'Inicio de sesión correcto.'
        ];
    }

    return [
        'ok' => false,
        'mensaje' => 'El correo o la contraseña son incorrectos.'
    ];
}