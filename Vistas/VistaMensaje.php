<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mensaje Estanteria</title>
    </head>
    <body>
        <?php
        
        if($_GET['id'] == "2") {
                echo $_GET['filas'];
            }
        
            if($_GET['id'] == "1") {
                
                if($_GET['filas'] == "1") {
                    echo "Estanteria insertada correctamente";
                }else{
                    echo "ERROR al insertar Estanteria " . $_GET['filas'];
                }
            }
            
            
        ?>
        
          <br>
        
        <a href="../index.php">Volver al Inicio</a>
        
    </body>
</html>
