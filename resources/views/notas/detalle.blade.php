@extends('plantilla')
@section('contenido')
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cuadro {
        background-color: white;
        border: 2px solid white;
        width: 100%;

        border-radius: 30px 30px 10px 10px;
    }

    .divi {
        border-top: 6px solid rgb(0, 0, 0);
        width: 100%;
        float: left;
    }
</style>
<div class="divider"></div>
<h3 class="center">Detalle del usuario</h3>
<h5 class="center"><strong>ID {{$nota->id}}</strong></h5>
<div class="divider"></div>
<br>
<div class="col s12">
<div class="cuadro">
        <h4 class="center">Acciones</h4>
        <div class="divi"></div>
        <table class="highlight" style=" color: black;" data-aos="fade-right">
            <thead>
                <tr>
                    <th data-aos="fade-up" data-aos-duration="1000">Borrar</th>
                    <th data-aos="fade-up" data-aos-duration="1000">Editar</th>
                    <th data-aos="fade-up" data-aos-duration="1000">Descargar reporte individual(solo este usuario).</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                <?php
                    $id=$nota->id;
                    ?>
                    
                    <td>
                        <form method="POST" action="{{ route('notas.eliminar', $nota) }}">
                            @method('DELETE')
                            @csrf
                            <button class="btn red" type="submit" name="action">
                                <i class="material-icons">delete_forever</i>
                            </button>
                        </form>
                    </td>


                    <td>
                        <form><a href=" {{route('notas.editar',$nota)}} " class="btn yellow"><i class="material-icons">create</i></a></form>
                    </td>
                    <td>
                    <div class=""><a class="btn green" href="{{ route('excel', $id) }}">Descargar excel</a></div>
                    </td>

                </tr>
            </tbody>
        </table>
        <br>
    </div>


    <br>


    <div class="cuadro">
        <h4 class="center">Datos personales</h4>
        <div class="divi"></div>
        <table class="highlight" style=" color: black;" data-aos="fade-right">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apelidos</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{$nota->id}}</td>
                    <td>{{$nota->nombre}}</td>
                    <td>{{$nota->apellido}}</td>
                    <td>{{$nota->telefono}}</td>
                    <td>{{$nota->direccion}}</td>
                    <td>{{$nota->email}}</td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>

    <br>

    <div class="cuadro">
        <h4 class="center">Datos de proyecto</h4>
        <div class="divi"></div>
        <table class="highlight" style=" color: black;" data-aos="fade-right">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Creado el</th>
                    <th>Actualizado el</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{$nota->trabajo}}</td>
                    <td>{{$nota->created_at->format('d M Y H:H ')}}</td>
                    <td>{{$nota->updated_at->format('d M Y H:H')}}</td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>


    <br>

    <div class="cuadro">
        <h4 class="center">Datos de pago</h4>
        <div class="divi"></div>
        <table class="highlight" style=" color: black;" data-aos="fade-right">
            <thead>
                <tr>
                    <th>Pago por hora</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Paga</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>${{$nota->pago}}</td>
                    <td>{{$nota->hora_entrada}}</td>
                    <td>{{$nota->hora_salida}}</td>
                    <td>
                    
    <?php
    $hora_salida=$nota->hora_salida;
    $hora_entrada=$nota->hora_entrada;
    $pago_hora=$nota->pago;

    $hora_salida1 = $hora_salida[11];
    $hora_salida2 = $hora_salida[12];
    $total_salida = $hora_salida1.$hora_salida2;

    $hora_entrada1 = $hora_entrada[11];
    $hora_entrada2 = $hora_entrada[12];
    $total_entrada = $hora_entrada1.$hora_entrada2;

    $resta= $total_salida - $total_entrada;

    $total = $resta * $pago_hora;
    echo '$'.$total;
    ?>

                    </td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>
</div>
</div>
<br>
<script type="text/javascript">
window.addEventListener('load', () => {
            setTimeout(carga);

            function carga() {
                alert('Esta es una página para administrar, borrar y editar datos \nEstas acciones son irreversibles ten cuidado.');
            }
        })
</script>
@endsection