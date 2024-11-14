<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //Validación información personal
    $nombre = existeCampo("nombre") ? sanitizarCampo("nombre") : "Campo erroneo";
    $email = existeCampo("email") ? sanitizarCampo("email") : "Campo erroneo";
    $telefono = existeCampo("telefono") ? sanitizarCampo("telefono") : "Campo erroneo";
    $fechaNac = existeCampo("fnac") ? sanitizarCampo("fnac") : "Campo erroneo";
    $genero = existeCampo("genero") ? sanitizarCampo("genero") : "Campo erroneo";
    //Validación información del evento
    $fechaEven = existeCampo("feven") ? sanitizarCampo("feven") : "Campo erroneo";
    $tipo = existeCampo("tipoEntrada") ? sanitizarCampo("tipoEntrada") : "Campo erroneo";
    //Validación información de acceso
    $nUsuario = existeCampo("nuser") ? sanitizarCampo("nuser") : "Campo erroneo";
    //Validación de preferencia de contacto
    $notificaciones = existeCampo("notificaciones") ? "Si" : "No";


    //Mostrar:

    echo "<h2>Datos del Usuario:</h2>";
    echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
    echo "<p><strong>Correo electrónico:</strong> " . $email . "</p>";
    echo "<p><strong>Teléfono:</strong> " . $telefono . "</p>";
    echo "<p><strong>Fecha de nacimiento:</strong> " . $fechaNac . "</p>";
    echo "<p><strong>Género:</strong> " . $genero . "</p>";
    echo "<p><strong>Fecha del evento:</strong> " . $fechaEven . "</p>";
    echo "<p><strong>Tipo de Entrada:</strong> " . $tipo . "</p>";
    // Preferencias de comida (checkboxes)
    $comida = [];
    foreach (['vegetariano', 'vegano', 'sinGluten', 'sinPreferencias'] as $pref) {
        if (isset($_POST[$pref])) {
            $comida[] = ucfirst($pref);
        }
    }
    echo "<p><strong>Preferencias de comida:</strong> " . (!empty($comida) ? implode(', ', $comida) : 'Ninguna') . "</p>";

    echo "<p><strong>Nombre de usuario:</strong> " . $nUsuario . "</p>";

    echo "<p><strong>Contraseña: </strong> ";
    //Mostrar Contraseña  más validación
    if (!empty($_POST['pass']) && !empty($_POST['cpass'])) {
        if ($_POST['pass'] != $_POST['cpass']) {
            echo "Las contraseñas no coinciden";
        }else{
            echo "es un secreto";
        }
    } else {
        echo "Debe de rellenar el campo de contraseña y confirmación de contraseña";
    }

    echo "<p><strong>Notificaciones: </strong> " . $notificaciones . "</p>";

} else {
    echo "Error al enviar el formulario";
}






function existeCampo($campo)
{
    return isset($_POST[$campo]) && !empty($_POST[$campo]);
}

function sanitizarCampo($campo)
{
    return htmlspecialchars($_POST[$campo]);
}
