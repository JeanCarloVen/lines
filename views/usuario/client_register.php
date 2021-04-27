<form action="<?=base_url?>cliente/saveClient" method="POST">
    <div>
    <label for="name">Nombre</label>
    <input name="name" type="text">
    </div>
    <div>
        <label for="sex">Sexo</label>
    <select id="sex">
        <option value="MAN">Hombre</option>
        <option value="WOM">Mujer</option>
    </select>
    </div>
    <div>
    <label for="phone">Telefono</label>
    <input name="phone" type="number">
    </div>
    <div>
    <label for="street">Calle y Numero</label>
    <input name="street" type="text">
    </div>
    <div>
    <label for="neighborhood">Colonia</label>
    <input name="neighborhood" type="text">
    </div>
    <div>
    <label for="location">Municipio</label>
    <input name="location" type="text">
    </div>
    <div>
    <label for="postal_code">Codigo Postal</label>
    <input name="postal_code" type="number">
    </div>
    <div> 
    <label for="send">Enviar</label>
    <input name="send" type="submit">
    </div>
    <input type="hidden" name="type_client"  value="PRO">
</form>