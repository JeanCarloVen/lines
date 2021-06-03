    <footer>
           <!-- TABLA DE ARCHIVOS -->
        <!-- Si existe archivo mostrar tabla, de lo contrario no mostrar nada-->
        <section class="bloque_secundario">
        <label for=pedido>Pedido: XYZ123 - </label>
        <label for=fecha>12/05/2021 18:32 </label>
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
                    <th>P.U.</th>
                    <th>Importe</th>
                    <th>Eliminar</th>
                </tr>
                <?php if(isset($_SESSION['file']) && $_SESSION['file'] == 'file_registered'): ?>
                <?php var_dump($_SESSION['file'])?>
                    <!-- Muestra Datos -->
                <tr>
                    <td>folio 001</td>                              
                    <td><?= $archivos['nombre']; ?></td> 
                    <td><?= $archivos['tipo']; ?></td> 
                    <td><?= $archivos['tamano']; ?></td>
                    <td><?= $archivos['color']; ?></td>
                    <td><?= $archivos['orientacion']; ?></td>
                    <td><?= $archivos['from_x']; ?> - <?= $archivos['to_y']; ?></td>
                    <td><?= $archivos['PU']; ?></td>
                    <td><?= $archivos['importe']; ?>
                    <td>
                        <label class="container"> 
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
                <?php unset($_SESSION['file']); ?>
                <?php else: ?>
                    <!-- No Muestra Datos -->
                <?php endif; ?>

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
    </footer>
</div>