<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title>Enviar correos con Swiftmailer</title>
</head>
<body>
<h2>Contacto</h2>
<form action="swiftmailer/send_email.php" method="post">
    Correo electronico: <br/>
    <input type="email" name="email" /><br/>
    Asunto: <br/>
    <input type="text" name="asunto" /><br/>
    Mensaje:<br/>
    <textarea name="mensaje"></textarea><br/>
    <input type="submit" name="submit" value="Enviar"/>
</form>
</body>
</html>