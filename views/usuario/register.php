<?php
 //Lógica y validación
?>
<div id=form-wrapper>
    <form action="<?=$url_action?>" method="POST"> 
        <div>
            <label for="correo">Correo</label>
            <input type="email" name="correo"/>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Mínimo 6 carácteres"/>
        </div>
        <div>
            <label for="again_password">Repite la Contraseña</label>
            <input type="again_password" name="again_password" placeholder="Mínimo 6 carácteres"/>
        </div>
        
        <!-- Es necesario meter un Captcha -->
        
        
        
    </form>
</div>


</div> <!--End Central-->
</div> <!--End Content-->
</div> <!--End Container-->
        
</body>
</html>