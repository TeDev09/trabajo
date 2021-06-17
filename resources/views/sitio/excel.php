<?php
session_start();
if (isset($_SESSION['admin']) or isset($_SESSION['sup'])) {
    if (isset($id) && !empty($id)) {
        require 'excel_agregado.php';
        $seleccion2 = "SELECT * FROM usuarios WHERE ID = '$id'";
        $name = $id . rand(100, 1000);
        header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
        header("Content-Disposition: attachment; filename=Reporte_$name.xls");
?>
        <style>
            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 10px;
            }
        </style>
        <table>
            <caption>
                <h3>Datos personales</h3>
            </caption>
            <tr>
                <th style="text-align: center; color: yellowgreen;">ID</th>
                <th style="text-align: center;">EMAIL</th>
                <th style="text-align: center;">NOMBRE:</th>
                <th style="text-align: center;">APELLIDO:</th>
                <th style="text-align: center;">DIRECCION:</th>
                <th style="text-align: center;">TELEFONO:</th>
            </tr>
            <?php
            $resultado2 = mysqli_query($conexion, $seleccion2) or die('ERROR' . mysqli_error($error));
            while ($registro2 = mysqli_fetch_array($resultado2)) {
            ?>
                <tr>
                    <td style="text-align: center; color: yellowgreen;"><?php echo $registro2['id']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['email']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['nombre']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['apellido']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['direccion']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['telefono']; ?></td>
                </tr>
        </table>
    <?php                                            } ?>
    <br>
    <table>
        <caption>
            <h3>Datos de preyecto</h3>
        </caption>
        <tr>
            <th style="text-align: center;">PAGO HORA:</th>
            <th style="text-align: center;">PROYECTO:</th>
            <th style="text-align: center; color: yellowgreen;">ID EMPLEADO:</th>
            <th style="text-align: center;">ULTIMA HORA DE ENTRADA REGISTRADA:</th>
            <th style="text-align: center;">ULTIMA HORA DE SALIDA REGISTRADA:</th>
            <th style="text-align: center;">CUENTA CREADA EL:</th>
            <th style="text-align: center;">CUENTA MODIFICADA EL:</th>
        </tr>
        <?php
        $resultado2 = mysqli_query($conexion, $seleccion2) or die('ERROR' . mysqli_error($error));
        while ($registro2 = mysqli_fetch_array($resultado2)) {
        ?>
            <tr>
                <td style="text-align: center;"><?php echo $registro2['pago']; ?></td>
                <td style="text-align: center;"><?php echo $registro2['trabajo']; ?></td>
                <td style="text-align: center; color: yellowgreen;"><?php echo $registro2['ID_empleado']; ?></td>
                <td style="text-align: center;"><?php echo $registro2['hora_entrada']; ?></td>
                <td style="text-align: center;"><?php echo $registro2['hora_salida']; ?></td>
                <td style="text-align: center;"><?php echo $registro2['created_at']; ?></td>
                <td style="text-align: center;"><?php echo $registro2['updated_at']; ?></td>
            </tr>
    </table>
<?php
}
?>







<table>
            <caption>
                <h3>Datos de pago</h3>
            </caption>
            <tr>
                <th style="text-align: center; color: red;">ID</th>
                <th style="text-align: center;">HORA DE ENTRADA:</th>
                <th style="text-align: center;">HORA DE SALIDA:</th>
                <th style="text-align: center;">PAGO POR HORA:</th>
                <th style="text-align: center;">HORAS TRABAJADAS:</th>
                <th style="text-align: center;">TOTAL A PAGAR:</th>
            </tr>
            <?php
            $resultado2 = mysqli_query($conexion, $seleccion2) or die('ERROR' . mysqli_error($error));
            while ($registro2 = mysqli_fetch_array($resultado2)) {
                $hora_salida = $registro2['hora_salida'];
                $hora_entrada = $registro2['hora_entrada'];
                $pago_hora = $registro2['pago'];
                $hora_salida1 = $hora_salida[11];
                $hora_salida2 = $hora_salida[12];
                $total_salida = $hora_salida1 . $hora_salida2;

                $hora_entrada1 = $hora_entrada[11];
                $hora_entrada2 = $hora_entrada[12];
                $total_entrada = $hora_entrada1 . $hora_entrada2;

                $resta = $total_salida - $total_entrada;

                $total = $resta * $pago_hora;
            ?>
                <tr>
                    <td style="text-align: center; color: red;"><?php echo $registro2['id']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['hora_salida']; ?></td>
                    <td style="text-align: center;"><?php echo $registro2['hora_entrada']; ?></td>
                    <td style="text-align: center;color: orange"><?php echo '$' . $registro2['pago']; ?></td>
                    <td style="text-align: center; color: DarkOrange;"><?php echo $resta . ' horas'; ?></td>
                    <td style="text-align: center; color: green;"><?php echo '$' . $total; ?></td>
                </tr>
        </table>
    <?php                                          }   ?>








<?php
    } else {
        echo "No se ha seleccionado ningún ID";
    }
} else {
    echo 'debes iniciar sesión';
}
?>