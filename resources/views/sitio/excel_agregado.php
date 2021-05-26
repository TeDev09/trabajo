<?php
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
    /* echo '<script>
alert("ERROR al conectar");
</script>'; */
}
?>