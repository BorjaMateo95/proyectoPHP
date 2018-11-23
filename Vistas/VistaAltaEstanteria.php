<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Estanteria</title>
        
        <link href="Estilos/EstiloAltaEstanteria.css" type="text/css" rel="stylesheet">

    </head>
    <body>
        <div id="contact-form">
            <div>
                <h2>Alta de Estanteria</h2>
            </div>

            <form name="formularioAltaEstanteria" action="../Controladores/ControladorAltaEstanteria.php">
                <div>
                    <label for="name">
                        <span class="required">Codigo</span> 
                        <input type="text" id="codigo" name="codigo" placeholder="Codigo" required="true" autofocus="autofocus" />
                    </label> 
                </div>
                <div>
                    <label for="nLejas">
                        <span class="required">Numero de Lejas</span>
                        <input type="number" id="nLejas" name="nLejas" min="1" placeholder="Numero de Lejas" required="true"/>
                    </label>  
                </div>

                <div>
                    <label for="pasillo">
                        <span class="required">Pasillo</span>
                        <input type="text" id="pasillo" name="pasillo" placeholder="Pasillo" required="true" />
                    </label>  
                </div>

                <div>
                    <label for="numero">
                        <span class="required">Numero</span>
                        <input type="number" id="numero" name="numero" min="1" placeholder="Numero" required="true"/>
                    </label>  
                </div>
                
                <div>		           
                    <button name="submit" type="submit" id="submit" >Guardar Estanteria</button> 
                </div>
            </form>
        </div>

    </body>
</html>
