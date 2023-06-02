<?php
$Nombre = $_GET['Nombre'];
$Correo = $_GET['Correo'];
$Password = $_GET['Password'];

$Correo = "duartea194@gmail.com";

//echo "Nombre de usuario: ".$Nombre;

//API KEY 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

require("sendgrid-php.php");

// Configuración de SendGrid


$email = new \SendGrid\Mail\Mail();
$email->setFrom("aduartec003@alumno.uaemex.mx", "sipretam");
$email->setSubject("SIPRETAM | Verifica tu contraseña");
$email->addTo('duartea194@gmail.com', $Nombre);
// Contenido HTML del correo
$emailContent = '
    <html>
    <head>
        <title>Verificación de cuenta</title>
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <td style="background-color:#ffffff;padding:20px">
                        <h3>Hola ' . $Nombre . ', Bienvenid@</h3>
                        <p>
                            Se ha registrado tu cuenta de correo electronico en el sistema de prestamos del taller de manufactura | SIPRETAM UAEMex
                        </p>

                        <p>
                            Pudes ingresar al sistema utilizando las siguientes credenciales<br>
                            <strong>Usuario: </strong>' . $Correo . '<br>
                            <strong>Contraseña: </strong>' . $Password . '
                        </p>
                        <div>
                            <a href="http://localhost:3000/" style="border-radius:15px;border:solid 1px #ec0000;color:#fff;font-weight:bold;padding:5px 26px;font-size:16px;font-style:normal;font-stretch:normal;line-height:1.43;letter-spacing:normal;text-align:center;font-family:Arial,sans-serif;text-decoration:none;background-color:#ec0000">Entrar</a>
                        </div>
                        <p>o puedes ingresar al sitio atraves del enlace:<br>
                        <a href="http://localhost:3000/">http://localhost:3000/</a>
                        </p><br>
                        <small>
                            ¿No has sido tú? Simplemente ignora este email. Si crees que alguien puede estar suplantando tu identidad, ponte en contacto con nosotros en correoejemplo@uaemex.mx
                        </small>
                        <p>Estamos a tus ordenes para cualquier duda o aclaracion.</p>
                        <p>Contacto:<br>
                            Email: <strong>correoejemplo@uaemex.mx</strong><br>
                            Telefono: <strong>+52 7221737101</strong>
                        </p>
                        <hr>
                        <p>
                            <strong>Atentamente:</strong> <br>
                            Universidad Autonoma del Estado de México <br>
                            Facultad de ingenieria <br>
                            Administracion del taller de manufactura <br>
                        </p>
                        <br>
                       
                    </td>
                </tr>
                <tr></tr>
            </tbody>
        </table>
    </body>
    </html>';


$email->addContent(
    "text/html",
    $emailContent
);

$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    //print $response->statusCode() . "\n";
    //print_r($response->headers());
    //print $response->body() . "\n";
    $resp = 'success';
    echo ($resp);
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
