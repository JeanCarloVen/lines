<div id="central">
    <section class="bloque_principal">
        <div class="upload_file">
        <?php if(isset($_SESSION['register']) && $_SESSION['register']  == 'new_register'): ?>        
            <form action="<?=base_url?>servicio/getServicesDefault" method="post">
                <!--Paso 1-->
                <!--Seleccionar Proveedor-->
                <ul>
                     <li>
                        <!--Carga y seleccion de proveedores-->
                        <label for="proveedor_id">Selecciona Proveedor:</label>
                        <select name="proveedor_id">
                            <option value="" selected disabled>Selecciona un proveedor...</option>
                            <?php while($sup = $suppliers->fetch_object()): ?>
                                <option type="hidden" value="<?= $sup->id; ?>">
                                    <?=$sup->nombre; ?>
                                </option>
                            <?php endwhile; ?>
                        </select> 
                        <input type="submit" value="Establecer Proveedor">
                    </li>
                </ul>
            </form>
        <?php else: ?>
            <?php if(isset($_SESSION['register']) 
                    && $_SESSION['register'] == 'old_register'
                    && isset($_SESSION['supplier_check']) 
                    && !isset($_SESSION['file'])): ?>
                <form action="<?=base_url?>archivo/upload_file" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>                    
                            <!-- Subir Archivo --> 
                            <input type="file" name="my_file[]" multiple>
                        </li>
                        <!--Paso 2-->
                        <!--Seleccionar Servicio DEFAULT-->
                        <h4>Servicios Default</h4>
                            <!--Muestra tamaño de Hoja -->
                        <?php if(isset($_SESSION['services_default']) && $_SESSION['services_default'] == 'failed'):?>
                            <strong>No se tienen Servicios</strong>
                        <?php else:?>
                        <li>
                        <label for="size_sheet">Tamaño Hoja:</label>
                        <select name="size_paper">
                            <option value="" selected disabled>Seleccionar...</option>
                            <?php  while($sizePaper = $sizePaperServices->fetch_object()): ?>
                                <option value="<?=$sizePaper->id?>">
                                    <?=$sizePaper->servicio_def; ?>
                                </option>                                     
                            <?php endwhile;?>        
                        </select>
                        </li>
                        <li>
                            <!--Muestra Tipo de Impresion -->
                        <label for="printServ">Impresión:</label>
                        <select name="print_serv">
                            <option value="" selected disabled>Seleccionar...</option>
                            <?php  while($printServ = $printServices->fetch_object()): ?>
                                <option value="<?=$printServ->id?>">
                                    <?=$printServ->servicio_def; ?>
                                </option>                                     
                            <?php endwhile;?>
                        </select>
                        </li>
                        <?php endif;?>
                        
                        <!-- Orientación -->
                        <li>
                            <label for="orientation">Orientación:</label>
                            <select name="orientation">
                                <option value="POR">Portrait</option>
                                <option value="LAN">Landscape</option>
                            </select>                    
                        </li>
                        <!-- Paginas a imprimir de X a Y -->
                        <li>
                        <label for=from_x>De: </label>
                        <input name="from_x" type="number">
                        <label for=to_y>Hasta: </label>
                        <input name="to_y" type="number">
                        </li>
                        <!--Debo hacer que carge sólo los servicios adicionales que tenga el proveedor-->
                        <!--El primer paso debería ser, calcular el numero total de servicios adicionales que tiene-->
                        <!--Debe generar un li por cada servicio-->
                        <!--Dentro de cada li, debería de generar un label, y un select-->
                        <!--Dentro de cada select debe de incluirse la lista de servicios--> 
                        <h4>Servicios Adicionales</h4>
                        <li>
                            <label for=servicio_01>Servicio 01</label>
                            <select name="servicio_id">
                                <option value="" selected disabled>Seleccionar...</option>
                                <option value="NULL" selected >default</option>
                            </select>   
                        </li>
                        <li>
                            <label for=servicio_02>Servicio 02</label>
                            <select name="servicio_02">
                                <option value="" selected disabled>Seleccionar...</option>
                            </select>    
                        </li>
                        <li>
                            <label for=servicio_03>Servicio 03</label>
                            <select name="servicio_03">
                                <option value="" selected disabled>Seleccionar...</option>
                            </select>  
                        </li>
                        <input type="submit" value="Enviar al proveedor">
                    </ul>
                </form>
            <?php else: ?>
                <!--Aquí se puede colocar un boton para agregar más archivos-->
                <form action="<?=base_url?>archivo/upload_file" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>                    
                            <!-- Subir Archivo --> 
                            <input type="file" name="my_file[]" multiple>
                        </li>
                        <!--Paso 2-->
                        <!--Seleccionar Servicio DEFAULT-->
                        <h4>Servicios Default</h4>
                         <!--Muestra tamaño de Hoja -->
                        <?php if(isset($_SESSION['services_default']) && $_SESSION['services_default'] == null && $_SESSION['services_default'] == 'failed'):?>
                            <strong>No se tienen Servicios</strong>
                        <?php else:?>
                        <li>
                        <?php var_dump($printServ)?>
                        <label for="size_sheet">Tamaño Hoja:</label>
                        <select name="size_paper">
                            <option value="" selected disabled>Seleccionar...</option>
                            <?php  while($sizePaper = $sizePaperServices->fetch_object()): ?>
                                <option value="<?=$sizePaper->id?>">
                                    <?=$sizePaper->servicio_def; ?>
                                </option>                                     
                            <?php endwhile;?>        
                        </select>
                        </li>
                        <li>
                            <!--Muestra Tipo de Impresion -->
                        <label for="printServ">Impresión:</label>
                        <select name="print_serv">
                            <option value="" selected disabled>Seleccionar...</option>
                            <?php  while($printServ = $printServices->fetch_object()): ?>
                                <option value="<?=$printServ->id?>">
                                    <?=$printServ->servicio_def; ?>
                                </option>                                     
                            <?php endwhile;?>
                        </select>
                        </li>
                        <?php endif;?>
                        
                        <!-- Orientación -->
                        <li>
                            <label for="orientation">Orientación:</label>
                            <select name="orientation">
                                <option value="POR">Portrait</option>
                                <option value="LAN">Landscape</option>
                            </select>                    
                        </li>
                        <!-- Paginas a imprimir de X a Y -->
                        <li>
                        <label for=from_x>De: </label>
                        <input name="from_x" type="number">
                        <label for=to_y>Hasta: </label>
                        <input name="to_y" type="number">
                        </li>
                        <!--Debo hacer que carge sólo los servicios adicionales que tenga el proveedor-->
                        <!--El primer paso debería ser, calcular el numero total de servicios adicionales que tiene-->
                        <!--Debe generar un li por cada servicio-->
                        <!--Dentro de cada li, debería de generar un label, y un select-->
                        <!--Dentro de cada select debe de incluirse la lista de servicios--> 
                        <h4>Servicios Adicionales</h4>
                        <li>
                            <label for=servicio_01>Servicio 01</label>
                            <select name="servicio_id">
                                <option value="" selected disabled>Seleccionar...</option>
                                <option value="NULL" selected >default</option>
                            </select>   
                        </li>
                        <li>
                            <label for=servicio_02>Servicio 02</label>
                            <select name="servicio_02">
                                <option value="" selected disabled>Seleccionar...</option>
                            </select>    
                        </li>
                        <li>
                            <label for=servicio_03>Servicio 03</label>
                            <select name="servicio_03">
                                <option value="" selected disabled>Seleccionar...</option>
                            </select>  
                        </li>
                        <input type="submit" value="Enviar al proveedor">
                    </ul>
                </form>
            <?php endif; ?>
                
        <?php endif;?>
<!--Get META DATA from the file PDF php get metadata pdf --> 
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
<!--Continua en el data.php-->