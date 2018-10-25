<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            $array = $_SESSION["lejas"];
            
            for ($i = 0; $i < count($array); $i++) {
                ?>
                    <option>
                        <?php echo $array[$i]; ?>
                    </option>
             <?php
            }
        ?>
    </body>
</html>
