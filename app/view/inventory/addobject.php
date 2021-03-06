<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 31/10/2018
 * Time: 19:42
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Agregar Objeto</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Agregar Objecto</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/listObjects" >Volver</a>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Objeto a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Objeto</label>
                                <input type="text" class="form-control" id="object_name" placeholder="Ingresar Nombre Objeto...">
                            </div>
                            <div class="form-group">
                                <label >Descripcion Objeto</label>
                                <input type="text" class="form-control" id="object_description" placeholder="Ingresar Descripción Objeto...">
                            </div>
                            <div class="form-group">
                                <label >Objeto Cantidad</label>
                                <input type="text" class="form-control" onkeypress="return valida(event)" id="object_total" placeholder="Ingresar Cantidad Objeto...">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Objeto</button>
                        </div>
                    </div>
                </div>
                <!-- /.box -->



            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    function valida(e){
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla==8){
            return true;
        }
        // Patron de entrada, en este caso solo acepta numeros
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    function add() {
        var valor = "correcto";
        var object_name = $('#object_name').val();
        var object_description = $('#object_description').val();
        var object_total = $('#object_total').val();

        if(object_name == ""){
            alertify.error('El campo Nombre Objeto está vacío');
            $('#object_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#object_name').css('border','');
        }

        if(object_description == ""){
            alertify.error('El campo Descripcion Objeto está vacío');
            $('#object_description').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#object_description').css('border','');
        }

        if(object_total == ""){
            alertify.error('El campo Cantidad Objeto está vacío');
            $('#object_total').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#object_total').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "object_name=" + object_name +
                "&object_description=" + object_description +
                "&object_total=" + object_total;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveObject",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Inventory/listObjects';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>
