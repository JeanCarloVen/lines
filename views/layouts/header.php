<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lines</title>       
        <link type="text/css" rel="stylesheet" href="<?=base_url?>assets/css/style.css" />
        <link type="text/css" rel="stylesheet" href="<?=base_url?>assets/css/style_new.css" />
        
    </head>
    
     <body>
        <div id="container">
            <body>
            <div id="container">
                <header id="header">
                    <div class="header">
                        <div id="logo">
                            <a href="<?=base_url?>index"> <img class="logo" src="<?=base_url?>assets/img/logo_lines.png" alt="Lines Logo" > </a>
                        <div class="header-right">
                        <div>
                            <h5><?= isset($_SESSION['identity']) && $_SESSION['identity'] ?  $_SESSION['identity']->correo : ''; ?></h5>
                            <div class="cerrar-sesion">
                                <?php if(isset($_SESSION['identity']) && $_SESSION['identity']): ?>
                                    <a  href="<?=base_url?>usuario/salir">Cerrar Sesión</a>
                                <?php else: ?>
                                    <a  href="<?=base_url?>usuario/entrar">Abrir Sesión</a>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        </div>
                        <div class="header-center">
                            <div class="button">
                                <a class="button-pink" href="#">Home</a>
                                <a class="button-pink" href="<?=base_url?>cliente/recargar">Recargar</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </header>
                

                <div id="content">
                <!-- Barra lateral -->
    
                <aside id="lateral">

                                                