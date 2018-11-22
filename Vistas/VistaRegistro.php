<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
        
        <link href="Estilos/Estilo.css" type="text/css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    </head>
    <body>
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"/>
                <p id="profile-name" class="profile-name-card"></p>
                
                <form class="form-signin" method="post" action="../Controladores/ControladorRegistro.php">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required autofocus>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos" required>
                    <input type="text" id="dni" name="dni" class="form-control" placeholder="DNI" required>
                    <input type="date" id="fechaNac" name="fechaNac" class="form-control" placeholder="Fecha Nacimiento" required>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                    <input type="password" id="password1" name="password1" class="form-control" placeholder="Contraseña" required>
                    <input type="password" id="password2" name="password2" class="form-control" placeholder="Repite la Contraseña" required>
                    
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Registro</button>
                </form>

            </div>
        </div>
    </body>
</html>

