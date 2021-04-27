<h2>ALTA DE SERVICIOS</h2>
<!--https://parzibyte.me/blog/2019/07/23/formulario-dinamico-php/-->
<!--Debemos de recoger los servicios de la BDD-->
<?php
//Validar que se trate de un Proveedor

//Consultar la base de datos de servicios dado un proveedor específico; si es así, debería regresar un arreglo $servicios
//    while($servicio = $servicios->fetch_object()){
//        echo $servicio->SKU;
//        echo '<br>';
//        echo $servicio->descripcion;
//        echo '<br>';        
//    }
    //die();
?>
<form action="<?=base_url?>servicio/addService" method="POST" >
    <label for="servicio">Servicios</label>
        <br>
        <!--Recarga los servicios previamente cargados-->
        <table>
            <tr>
                <th>SKU</th>
                <th>Descripción</th>
                <th>P.U.</th>
                <th>Acción</th>
            </tr>
            <?php while($servicio = $servicios->fetch_object()):?>
            <tr>
                <td><?=$servicio->SKU;?></td>
                <td><?=$servicio->descripcion;?></td>
                <td><?=$servicio->precio_unitario;?></td>
                <td>Editar / Borrar</td>
            </tr>
            <?php endwhile;?>
            <!--Falta Editar y borrar-->
        </table>    
        <br>
        <!--Inserta los nuevos servicios -->
        <label for="sku">SKU</label>
        <input type="text" name="sku">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion">
        <label for="pu">P.U.</label>
        <input type="float" name="pu">
        <br><br>
        <button name="guardar" type="submit">Guardar Servicios</button>
        
</form>