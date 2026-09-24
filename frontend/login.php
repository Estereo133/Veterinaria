<?php
require_once __DIR__ . '/includes/auth.php';
iniciarSesion();

if (!empty($_SESSION['id_usuario'])) {
    redirigir('/veterinaria/dashboard.php');
}

$error = '';
$emailValor = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailValor = trim($_POST['email'] ?? '');
    $contrasena = $_POST['password'] ?? '';

    $resultado = autenticar($emailValor, $contrasena);

    if ($resultado['ok']) {
        redirigir('/veterinaria/dashboard.php');
    } else {
        $error = $resultado['mensaje'];
    }
}

if (isset($_GET['error']) && $_GET['error'] === 'sesion') {
    $error = 'Debes iniciar sesión para acceder.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Veterinaria</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos propios (generados por Sass) -->
    <link rel="stylesheet" href="includes/assets/css/styles.css">
</head>
<body class="login-page">

    <main class="page-shell" role="main">

        <section class="login-panel" aria-labelledby="login-title">

            <!-- Encabezado de marca -->
            <header class="brand-block">
                <div class="brand-mark" aria-hidden="true">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <div>
                    <p class="eyebrow">Sistema</p>
                    <h1>Veterinaria</h1>
                </div>
            </header>

            <!-- Bienvenida -->
            <div class="welcome-copy">
                <p class="eyebrow">Bienvenido</p>
                <h2 id="login-title">Inicia sesión</h2>
            </div>

            <!-- Alerta de error -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center py-2 px-3 mb-3"
                     role="alert" aria-live="polite">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <!-- Formulario -->
            <form class="login-form" method="post" action="login.php" novalidate>

                <label for="email">Correo electrónico</label>
                <div class="input-icon">
                    <i class="bi bi-envelope" aria-hidden="true"></i>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control"
                        placeholder="usuario@veterinaria.com"
                        value="<?= htmlspecialchars($emailValor) ?>"
                        required
                        autofocus>
                </div>

                <label for="password">Contraseña</label>
                <div class="input-icon">
                    <i class="bi bi-lock" aria-hidden="true"></i>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control"
                        placeholder="••••••••"
                        required>
                    <button type="button"
                            class="btn-toggle-pass"
                            id="togglePass"
                            aria-label="Mostrar u ocultar contraseña">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <div class="form-row">
                    <label class="checkbox-wrap">
                        <input type="checkbox" name="remember">
                        <span>Recordarme</span>
                    </label>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                </button>
            </form>

            <!-- Footer del panel -->
            <footer class="signup-text">
                <small>&copy; <?= date('Y') ?> Clínica Veterinaria</small>
            </footer>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePass')?.addEventListener('click', (e) => {
            const input = document.getElementById('password');
            const icon  = e.currentTarget.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>
</html>