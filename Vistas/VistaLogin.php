<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
    </head>
    <body>
        
        <div class="container">
            <div class="col-md-5 col-md-offset-3">
                <div class="page-header text-center">
                    <h1>Login</h1>
                </div>
                
                <form class="form-signin" method="post" action="../Controladores/ControladorLogin.php">
                    <h2 class="form-signin-heading">Inicia sesion</h2>
                    <label for="user" class="sr-only">Usuario</label>
                    <input type="text" name="email"  id="email" class="form-control" placeholder="Email" required="true" autofocus>
                    <label for="password" class="sr-only">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required="true">
                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Entrar">
                                        
                </form>
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
