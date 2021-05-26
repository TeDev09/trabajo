<?php

use \vendor\autoload;
#CONEXION A BASE DE DATOS
$host = 'localhost';
$user = 'root';
$pass = '';
$bd = 'sistemabd';
$conexion = mysqli_connect($host, $user, $pass, $bd);
if (isset($conexion)) {
    /* echo '<script>
alert("conexion exitosa");
</script>'; */
} else {
    echo '<script>
alert("ERROR al conectar");
</script>';
}

#CONEXION A BASE DE DATOS
session_start();
if (isset($_SESSION['usuario'])) {
    if (isset($idusu) && !empty($idusu)) {
        $comprobar = "SELECT * FROM usuarios WHERE id ='$idusu'";
        $resultado1 = mysqli_query($conexion, $comprobar) or die('ERROR'); //se realiza el query
        while ($registro2 = mysqli_fetch_array($resultado1)) {
            $hora_salida = $registro2['hora_salida'];
            $hora_entrada = $registro2['hora_entrada'];
            $pago_hora = $registro2['pago'];
        }
        $hora_salida1 = $hora_salida[11];
        $hora_salida2 = $hora_salida[12];
        $total_salida = $hora_salida1 . $hora_salida2;

        $hora_entrada1 = $hora_entrada[11];
        $hora_entrada2 = $hora_entrada[12];
        $total_entrada = $hora_entrada1 . $hora_entrada2;

        $resta = $total_salida - $total_entrada;

        $total = $resta * $pago_hora;
        $html = " 
<html lang=\"es\">
<meta charset=\"UTF-8\">
 <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
 <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/icon?family=Material+Icons\">
<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css\">
<link href=\"https://unpkg.com/aos@2.3.1/dist/aos.css\" rel=\"stylesheet\">
<style>

</style>
    <title>Registro</title>
</head>
<body>
<h1 style=\"color:red; padding-left:150px;\">Registro anexo de datos ID $idusu</h1>
<P style=\"padding-left:150px;\">Este es un reporte generado automaticamente y contiene</P>
<P style=\"padding-left:150px;\">tus datos de entrada como de salida y tu pago total.</P>
<P style=\"padding-left:150px;\">Puedes descargarlo según tu navegador para evitar inconvenientes.</P>
<div style=\"padding-left:150px;\">
    <table border=\"1\">
            <thead>
            <tr>
                <th>Hora entrada:</th>
                <th>Hora salida:</th>
                <th>Pago H:</th>
                <th>Pago total:</th>
            </tr>
            </thead>
    
            <tbody>
            <tr>
                <td>$hora_entrada</td>
                <td>$hora_salida</td>
                <td>$$pago_hora</td>
                <td>$total</td>
            </tr>
            </tbody>
            
        </table>
</div>
</body>
</html>
";
    }
} else {
    $html = "<h1>Debes inciciar sesión para ver este contenido.</h1>";
}

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("Documento pdf", array('Attachment' => '0'));
