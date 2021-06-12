<?php
session_start();
if (isset($_SESSION['admin']) or isset($_SESSION['sup'])) {
        require 'excel_agregado.php';
        $comprobar = "SELECT * FROM usuarios";

        $name = 'allusers'. rand(100, 1000);
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
            $resultado1 = mysqli_query($conexion, $comprobar) or die('ERROR');
            while ($registro2 = mysqli_fetch_array($resultado1)) {
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
    <?php                                          }   ?>
        </table>
    <br>
<?php

    
} else {
    echo 'debes iniciar sesión';
}
?>