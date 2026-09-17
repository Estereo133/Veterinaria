<?php
$hash = password_hash('admin123', PASSWORD_DEFAULT);
echo "<h2>Hash generado para 'admin123':</h2>";
echo "<code style='background:#eee;padding:10px;display:block;word-break:break-all'>$hash</code>";
echo "<p>Copia y ejecuta esto en phpMyAdmin → pestaña SQL:</p>";
echo "<pre>UPDATE usuarios SET contrasena = '$hash' WHERE usuario = 'admin';</pre>";