<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /");
    exit;
}

// Anti bot
if (!empty($_POST["website"] ?? "")) {
    header("Location: /#contacto");
    exit;
}

function limpiar($valor) {
    return trim(strip_tags((string)$valor));
}

$nombre = limpiar($_POST["nombre"] ?? "");
$empresa = limpiar($_POST["nombreEmpresa"] ?? "");
$mail = limpiar($_POST["mail"] ?? "");
$celular = limpiar($_POST["celular"] ?? "");
$servicio = limpiar($_POST["servicio"] ?? "");
$mensaje = limpiar($_POST["mensaje"] ?? "");

if ($nombre === "" || $servicio === "" || $mensaje === "") {
    header("Location: /?form=error#contacto");
    exit;
}

$mailValido = ($mail !== "" && filter_var($mail, FILTER_VALIDATE_EMAIL));
$telefonoValido = (
    $celular !== "" &&
    preg_match('/^[0-9+\s()\-]{8,25}$/', $celular)
);

if ($mail !== "" && !$mailValido) {
    header("Location: /?form=mail-invalido#contacto");
    exit;
}

if (!$mailValido && !$telefonoValido) {
    header("Location: /?form=contacto#contacto");
    exit;
}

$destinatario = "hablapmc@hotmail.com";

$servicioSeguro = str_replace(["\r", "\n"], "", $servicio);
$asunto = "Nueva consulta web - " . $servicioSeguro;

$contenido = "Nueva consulta desde pmcconsultora.com.ar\n\n";
$contenido .= "Nombre: " . $nombre . "\n";
$contenido .= "Empresa / local: " . ($empresa !== "" ? $empresa : "No informado") . "\n";
$contenido .= "Email: " . ($mail !== "" ? $mail : "No informado") . "\n";
$contenido .= "Celular / WhatsApp: " . ($celular !== "" ? $celular : "No informado") . "\n";
$contenido .= "Servicio: " . $servicio . "\n\n";
$contenido .= "Mensaje:\n" . $mensaje . "\n";

$headers = "From: PMC Consultora <no-reply@pmcconsultora.com.ar>\r\n";

if ($mailValido) {
    $replyTo = str_replace(["\r", "\n"], "", $mail);
    $headers .= "Reply-To: " . $replyTo . "\r\n";
}

$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$enviado = mail($destinatario, $asunto, $contenido, $headers);

if ($enviado) {
    header("Location: /?form=ok#contacto");
} else {
    header("Location: /?form=error#contacto");
}

exit;
?>