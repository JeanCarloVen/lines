<!--
Debe de validar si se tiene la sesión abierta, de lo contrario invitar al usuario que se de alta-->

<?php if(!isset($_SESSION['identity'])): ?>
<h2>NO Se tiene cuenta, favor de crear una</h2>
<?php else:?>
<form action="<?=base_url?>cliente/rechargeUser" method="POST">     
    <div>
        <input id="id" name="id" type="hidden" value="<?=$_SESSION['identity']->id?>">
        <label for="recharge" class="label">Recargar</label>
        <input name="recharge" type="number" <?= isset($_SESSION['cliente']) && $_SESSION['cliente'] == 'notIsClient' ? 'disabled' : ''?> >
        <input type="submit" class="button" value="Recharge">
    </div> 
</form>
    <?php if(isset($_SESSION['cliente']) && $_SESSION['cliente'] == 'notIsClient'): ?>
        <a href="<?=base_url?>cliente/registrarCliente"> Termina tu registro, para poder recargar </a>
    <?php else: ?>
    <?php endif;?>
<?php endif;?>
