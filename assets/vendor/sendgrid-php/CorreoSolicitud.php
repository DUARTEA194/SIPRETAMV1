<?php
//$Nombre = $_GET['Nombre'];
//$Correo = $_GET['Correo'];
$Nombre = "Antonio";
$Correo = "duartea194@gmail.com";
$Password = "DUCA991211";
//echo "Nombre de usuario: ".$Nombre;

//API KEY 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

require("sendgrid-php.php");

// Configuración de SendGrid


$email = new \SendGrid\Mail\Mail();
$email->setFrom("aduartec003@alumno.uaemex.mx", "sipretam");
$email->setSubject("SIPRETAM | Solicitud de prestamo");
$email->addTo('duartea194@gmail.com', $Nombre);
// Contenido HTML del correo
$emailContent = '
    <html>
    <body>
        <table>
            <tbody>
                <tr>
                    <td style="background-color:#ffffff;padding:20px">
                        <h3>Hola ' . $Nombre . '.</h3>
                        <p>
                            Se ha resgistrado una nueva solictud de pretamo en tu cuenta con la siguiente informacion:
                        </p>

                        <p>
                            Dia: <strong>2023-05-31</strong><br>
                            Hora: <strong>15:30</strong>
                        </p>
                        <p>
                            Nombre del evento: <strong>Solicitud de prestamo</strong><br>
                        </p>
                        <p>
                            Tipo de trabajo: <strong>Tesis</strong><br>
                            Descripcion: <strong>En este ejemplo, el <div> con la clase "container" se configura con display: flex; para que se comporte como un contenedor flexible. Luego, justify-content: center; alinea horizontalmente el contenido del contenedor en el centro, y align-items: center; lo alinea verticalmente en el centro.</strong>
                        </p>
                        <p>
                            Maquinas solictadas:<strong></strong><br>
                        </p>
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <a href="http://localhost:3000/" style="border-radius:15px;border:solid 1px #ec0000;color:#fff;font-weight:bold;padding:5px 26px;font-size:16px;font-style:normal;font-stretch:normal;line-height:1.43;letter-spacing:normal;text-align:center;font-family:Arial,sans-serif;text-decoration:none;background-color:#ec0000">Ver en el sistema</a>
                        </div>
                        <hr></hr>
                        <p>
                        <strong>Recuerda que al ingresar a taller debes:</strong><br>
                        1.- Ingresar con bata y zapato de seguridad (en caso de no tener zapato de seguridad debes usar zapato cerrado).<br>
                        2.- Seguir al pie de la letra el reglamento y lineamientos del taller.<br>
                        3.- Seguir las indicaciones del técnico asignado.<br>
                        4.- Hacerte responsable por el material, herramientas y maquinas que utilices. <br>
                        5.- Entregar limpia tanto tu área de trabajo asi como las maquinas y herramientas empleadas<br>
                        </p>
                        <p>
                            Para mas informacion consulta: <a href="http://web.uaemex.mx/gaceta/pdf/gacetas2020/WebDiciembre2020.pdf#page=122">Reglamento de laboratorios y talleres de la UAEMex</a>
                        </p>
                        <hr></hr>
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
    $resp = array('tipo' => 'success', 'mensaje' => 'Correo Enviado con exito');
    echo json_encode($resp);
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
