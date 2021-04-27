<div id="central">
    <section class="bloque_principal">
        <div class="upload_file">
        <form action="<?=base_url?>archivo/upload_file" method="post" enctype="multipart/form-data">
            <!--Seleccionar Proveedor-->
            <ul>
                 <li>
                    <!--Carga y seleccion de proveedores-->
<!--                        https://es.stackoverflow.com/questions/299383/select-option-con-php-->
                    <label for="proveedor">Selecciona Proveedor:</label>
                    <select name="proveedor_id">
                        <option value="" selected disabled>Selecciona un proveedor...</option>
                        <?php while($sup = $suppliers->fetch_object()): ?>
                            <option value="<?= $sup->id?>">
                                <?=$sup->nombre; ?>
                            </option>
                        <?php endwhile; ?>
                    </select> 
                    <input type="submit" value="Establecer Proveedor">
                </li> 
                <!--Seleccionar Servicios-->
                <li>
                    <!-- Subir Archivo --> 
                    <input type="file" name="my_file[]" multiple>
                </li>
                <?php  while($serv = $serv->fetch_object()): ?>
                <li>
                    <!-- Tamaño de Hoja -->
                    <label for="size">Selecciona:</label>
                    <select>
                        <option value="Carta">Carta</option>
                        <option value="Oficio">Oficio</option>
                    </select>                                     
                </li>
                <li>
                    <!-- Color / BN -->  
                    <label for="color">Selecciona:</label>
                    <select name="servicio">
                        <option value="Color">Color</option>
                        <option value="B/N">B/N</option>
                    </select>  
                </li>
                <?php endwhile;?>        
                <!-- Orientación -->
                <li>
                    <label for="orientation">Selecciona:</label>
                    <select>
                        <option value="Portrait">Portrait</option>
                        <option value="Landscape">Landscape</option>
                    </select>                    
                </li>
                <!-- Paginas a imprimir de X a Y -->
                <li>
                <label for=from_x>De: </label>
                <input name="from_x" type="number">
                <label for=to_y>Hasta: </label>
                <input name="to_y" type="number">
                </li>
                <input type="submit" value="Enviar al proveedor">
            </ul>
        </form>
<!--                            Get META DATA from the file PDF php get metadata pdf --> 
<!--https://stackoverflow.com/questions/1175347/how-can-i-select-and-upload-multiple-files-with-html-and-php-using-http-post-->
<!--http://lampspw.wallonie.be/dgo4/tinymvc/myfiles/plugins/multifile-2.2.1/docs.html-->
<!--https://github.com/blueimp/jQuery-File-Upload/blob/master/README.md-->
        </div>
        <div>
            <div class="opciones_locacion">
                <h1>Selecciona:</h1>
                <select class="location_select" name="select">
                    <option value="value1">Value 1</option>
                    <option value="value2" selected>Value 2</option>
                    <option value="value3">Value 3</option>
                </select>
            </div>
        </div>
        <div>
            <div class="mapa">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30111.917691708742!2d-99.27052158400785!3d19.36959816287425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d200c41f6ecbc5%3A0x617650eef53e5be4!2sSanta%20Fe%2C%20Zedec%20Sta%20F%C3%A9%2C%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1611275882016!5m2!1ses-419!2smx" width="350" height="250" frameborder="0" style="border-radius: 20px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </section>
    <section class="bloque_secundario">
        <label for=pedido>Pedido: XYZ123 </label>
        <div class="tabla">
            <table id="tabla_principal">
                <tr>
                    <th>No</th>
                    <th>Archivo</th>
                    <th>Tipo</th>
                    <th>Tamaño Hoja</th>
                    <th>Color - B/N</th>
                    <th>Orientación</th>
                    <th>De X Hasta Y</th>
                    <th>Fecha y Hora</th>
                    <th>P.U.</th>
                    <th>Importe</th>
                    <th>Eliminar</th>
                </tr>
                <!--While para mostrar en la tabla -->
                <?php while($arc = $archivos->fetch_object()): ?>
                <tr>
                    <td><?= $arc->id; ?> </td>
                    <td><?= $arc->nombre; ?> </td>
                    <td><?= $arc->tipo; ?> </td>
                    <td><?= $arc->tamano; ?> </td>
                    <td><?= $arc->color; ?> </td>
                    <td><?= $arc->orientacion; ?> </td>
                    <td><?= $arc->from_x;?> - <?= $arc->to_y;?> </td>
                    <td><?= $arc->fecha; ?></td>
                    <td><?= $arc->precio_unitario; ?></td>
                    <td><?= $arc->importe ?></td>                                   
                    <td>
                        <label class="container"> 
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <?php endwhile; ?>
                </tr>
            </table>
        </div>
        <div class="delete_file">
            <div class="header button">
                <a class="button-pink" href="#">Eliminar</a>
            </div>
        </div>
        <div class="footer">
            <div class="dropdown">
                <h4> 
                    <span> Consulta Lista de Precios </span>
                </h4>
                <div class="dropdown-content">
                    <table>
                        <tr>
                            <th>Descripción</th>
                            <th>Precio Unitario</th>
                        </tr>
                        <tr>
                            <td>Blanco/Negro</td>
                            <td>$1.00</td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td>$0.50</td>
                        </tr>
                        <tr>
                            <td>Hoja Oficio</td>
                            <td>$2.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>