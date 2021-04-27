<div class="position_lateral">
        <div class="block_aside">
            <div class="fila">
                <div class="column">
                        <h2>Saldo: </h2>
                        <h2>Importe</h2>
                        <h3>Comisión</h3>
                        <h3>Total</h3>
                </div>
                <div class="column">
                        
                        <h5><?= isset($_SESSION['cliente']) && $_SESSION['cliente'] != 'notIsClient' ? $_SESSION['cliente']->saldo : '';?> </h5>
                        <h2>$100.00</h2>
                        <h3>$12.00</h3>
                        <h3>$112.00</h3>
                </div>
                </div>
        </div>

        <div class="header button">
                <a class="button-pink" href="#" > Comprar  </a>
        </div>
    </div>
</aside>