<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Caja</title>
        
        <link href="Estilos/EstiloAltaEstanteria.css" type="text/css" rel="stylesheet">
        
        <script type="text/javascript" src="JS/JSControlLejasLibres.js"></script>

    </head>
    <body>

        <div id="contact-form">
            <div>
                <h2>Alta de Caja</h2>
            </div>

            <form name="formularioAltaCaja" action="../Controladores/ControladorAltaCaja.php">
                <div>
                    <label for="name">
                        <span class="required">Codigo</span> 
                        <input type="text" id="codigo" name="codigo" placeholder="Codigo" required="true" autofocus="autofocus" />
                    </label> 
                </div>
                <div>
                    <label for="altura">
                        <span class="required">Altura</span>
                        <input type="number" id="altura" name="altura" placeholder="Altura"  min="1" required="true" />
                    </label>  
                </div>

                <div>
                    <label for="anchura">
                        <span class="required">Anchura</span>
                        <input type="number" id="anchura" name="anchura" placeholder="Anchura"  min="1" required="true" />
                    </label>  
                </div>

                <div>
                    <label for="profundidad">
                        <span class="required">Profundidad</span>
                        <input type="number" id="profundidad" name="profundidad" min="1" placeholder="Profundidad" required="true" />
                    </label>  
                </div>

                <div>
                    <label for="material">
                        <span class="required">Material</span>
                        <input type="text" id="material" name="material" placeholder="Material" required="true" />
                    </label>  
                </div>

                <div>
                    <label for="color">
                        <span class="required">Color</span>
                        <input type="color" id="color" name="color" placeholder="Color" required="true" />
                    </label>  
                </div>

                <div>
                    <label for="contenido">
                        <span class="required">Contenido</span>
                        <input type="text" id="contenido" name="contenido" placeholder="Contenido" required="true"/>
                    </label>  
                </div>

                <?php
                include_once '../Modelos/Estanteria.php';

                session_start();

                $estanteriasLibres = $_SESSION['estanterias'];

                echo "<label>Estanterias con lejas libres </label>";

                echo "<select id='estanteriasDisponibles' name='estanteriasDisponibles' onchange='cargaLejasLibres(this.value)'>";
                echo "<option value=0>Selecciona Estanteria</option>";
                for ($i = 0; $i < count($estanteriasLibres); $i++) {
                    echo "<option value=" . $estanteriasLibres[$i]->getId() . ">Codigo " . $estanteriasLibres[$i]->getCodigo() . "</option>";
                }

                echo "</select>";
                
                ?>     

                <label>Lejas libres</label>
                <select id="listaLejas" name="listaLejas" required="true">


                </select>

                <div>		           
                    <button name="submit" type="submit" id="submit" >Guardar Caja</button> 
                </div>
            </form>
        </div>

    </body>
</html>