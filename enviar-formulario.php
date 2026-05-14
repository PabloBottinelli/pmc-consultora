<?php
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: index.html");
        exit;
    }

    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $mail = trim($_POST["mail"] ?? "");
    $celular = trim($_POST["celular"] ?? "");
    $nombreEmpresa = trim($_POST["nombreEmpresa"] ?? "");
    $mensaje = trim($_POST["mensaje"] ?? "");

    if ($nombre === "" || $mail === "" || $celular === "" || $nombreEmpresa === "" || $mensaje === "") {
        header("Location: index.html?form=error#contacto");
        exit;
    }

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?form=mail-invalido#contacto");
        exit;
    }

    $destinatario = "hablapmc@hotmail.com";
    $asunto = "Mensaje desde la web de la consultora";

    $contenido = "Nuevo mensaje desde la web de PMC Consultora\n\n";
    $contenido .= "Nombre: " . $nombre . "\n";
    $contenido .= "Apellido: " . $apellido . "\n";
    $contenido .= "Email: " . $mail . "\n";
    $contenido .= "Celular: " . $celular . "\n";
    $contenido .= "Empresa: " . $nombreEmpresa . "\n\n";
    $contenido .= "Mensaje:\n" . $mensaje . "\n";

    $headers = "From: PMC Consultora <no-reply@pmcconsultora.com.ar>\r\n";
    $headers .= "Reply-To: " . $mail . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $enviado = mail($destinatario, $asunto, $contenido, $headers);

    if ($enviado) {
        header("Location: index.html?form=ok#contacto");
        exit;
    } else {
        header("Location: index.html?form=error#contacto");
        exit;
    }
?>