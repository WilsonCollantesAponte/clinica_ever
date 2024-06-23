<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia Clínica de Emergencia</title>-->
    <link rel="stylesheet" href="../estilos/styleem.css">
    <style>
        ul{
            list-style-type: none;
        }
    </style>
   <!-- <script src="https://cdn.tailwindcss.com"></script>
</head>
<body> -->
    <!-- Hamburger al achicar la pantalla -->
    <!-- <div class="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>-->
    <div class="menubar">
        <ul>
            <li><a href="../php/logout.php">Cerrar Sesión</a></li>
        </ul>
    </div> 
    
    <div class="container_d">
    <div class="search-container">
    <form action="search.php" method="post">
  <input type="text" id="document_number" name="document_number">
  <button id = 'search-button'type="submit">Search</button>
</form>
    
</div>
        <script src="../js/peticionesem.js"></script>
        <br>
        <br>
        <div class="form-container">
            <h1>Historia Clínica de Emergencia</h1>
            <form id="emergencyForm">
                 <!-- Información General  -->
                <fieldset>
                    <legend>Datos Generales</legend>
                    <div class="row">
                        <label for="fechaAtencion">Fecha de Atención:</label>
                        <input type="date" id="fechaAtencion" name="fechaAtencion">
                        <label for="horaAtencion">Hora de Atención:</label>
                        <input type="time" id="horaAtencion" name="horaAtencion">
                    </div>
                    <div class="row">
                        <label for="primernombre">Primer Nombre:</label>
                        <input type="text" id="primerNombre" name="primerNombre">
                        <label for="segundonombre">Segundo Nombre:</label>
                        <input type="text" id="segundoNombre" name="segundoNombre" >
                    </div>
                    <div class="row">
                        <label for="apellidopaterno">Apellido Paterno:</label>
                        <input type="text" id="apellidoPaterno" name="apellidoPaterno">
                        <label for="apellidomaterno">Apellido Materno:</label>
                        <input type="text" id="apellidoMaterno" name="apellidoMaterno" >
                    </div> 
                    <div class="row">
                        <label for="dni">Tipo de Documento:</label>
                        <input type="text" id="dni" name="dni">
                        <label for="edad">Edad:</label>
                        <input type="number" id="edad" name="edad" >
                    </div>
                    <div class="row">
                        <label for="sexo">Sexo:</label>
                        <select id="sexo" name="sexo" readonly>
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fechaNacimiento" name="fechaNacimiento">
                    </div>
                    <div class="row">
                        <label for="estadoCivil">Estado Civil:</label>
                        <select id="estadoCivil" name="estadoCivil" readonly>
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Casado">Casado</option>
                            <option value="Viudo">Viudo</option>
                            <option value="Divorciado">Divorciado</option>
                        </select>
                    </div>
                </fieldset>

                 <!-- Domicilio -->
                <fieldset>
                    <legend>Domicilio</legend>
                    <div class="row">
                        <label for="departamento">Departamento:</label>
                        <input type="text" id="departamento" name="departamento">
                    </div>
                    <div class="row">
                        <label for="provincia">Provincia:</label>
                        <input type="text" id="provincia" name="provincia">
                        <label for="distrito">Distrito:</label>
                        <input type="text" id="distrito" name="distrito">
                    </div>
                    <div class="row">
                        <label for="localidad">Localidad:</label>
                        <input type="text" id="localidad" name="localidad">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion">
                    </div>
                
                </fieldset>

             <!-- Tipo de Atención y Servicio  -->
                <fieldset>
                    <legend>Tipo de Atención y Servicio</legend>
                    <div class="row">
                        <label for="tipoAtencion">Tipo de Atención:</label>
                        <select id="tipoAtencion" name="tipoAtencion">
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="Sin Seguro">Sin Seguro</option>
                            <option value="AUS">AUS</option>
                            <option value="SOAT">SOAT</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                    <div class="row">
                        <label for="servicio">Servicio:</label>
                        <select id="servicio" name="servicio">
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="Medicina">Medicina</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                </fieldset>

           <!-- Anamnesis  -->
                <fieldset>
                    <legend>Anamnesis</legend>
                    <div class="row">
                        <label for="tiempoEnfermedad">Tiempo de Enfermedad:</label>
                        <input type="text" id="tiempoEnfermedad" name="tiempoEnfermedad">
                    </div>
                    <div class="row">
                        <label for="sintomas">Síntomas principales:</label>
                        <textarea id="sintomas" name="sintomas"></textarea>
                    </div>
                    <div class="row">
                        <label for="relato">Relato:</label>
                        <textarea id="relato" name="relato"></textarea>
                    </div>
                    <div class="row">
                        <label for="antecedentes">Antecedentes:</label>
                        <textarea id="antecedentes" name="antecedentes"></textarea>
                    </div>
                    <div class="row">
                        <label for="examenFisico">Examen Físico:</label>
                    </div>
                    <div class="row">
                        <label for="frecuenciacardiaca">Frecuencia Cardíaca:</label>
                        <input type="text" id="frecuenciacardiaca" name="fecuenciacardiaca">
                        <label for="frecurespiratoria">Frecuencia Respiratoria:</label>
                        <input type="text" id="frecurespiratoria" name="frecurespiratoria" readonly>
                    </div>
                    <div class="row">
                        <label for="temperatura">Temperatura:</label>
                        <input type="text" id="temperatura" name="temperatura">
                        <label for="presionarterial">Presion Arterial:</label>
                        <input type="text" id="presionarterial" name="presionarterial" readonly>
                    </div>
                    <div class="row">
                        <label for="saturacion">Saturación de Oxigeno:</label>
                        <input type="text" id="saturacion" name="saturacion">
                       
                    </div>
                    
                </fieldset>

             <!-- Impresión Diagnóstica  -->
                <fieldset>
                    <legend>Impresión Diagnóstica</legend>
                    <div class="row">
                        <label for="diagnostico">Diagnóstico:</label>
                        <input type="text" id="diagnostico" name="diagnostico">
                        <label for="tipodeDX">Tipo de DX:</label>
                        <select id="tipo" name="tipo">
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="presuntivo">Presuntivo</option>
                            <option value="definitivo">Definitivo</option>
                            <option value="repetido">Repetido</option>
                        </select>
                        <label for="cie10">CIE-10:</label>
                        <input type="text" id="cie10" name="cie10">
                    </div>
                </fieldset>

             <!-- Examen Auxiliares  -->
                <fieldset>
                    <legend>Examen Auxiliares</legend>
                    <div class="row">
                        <label for="examenAuxiliares">Examen Auxiliares:</label>
                        <textarea id="examenAuxiliares" name="examenAuxiliares"></textarea>
                    </div>
                </fieldset>

            <!-- Tratamiento  -->
                <fieldset>
                    <legend>Tratamiento</legend>
                    <div class="row">
                        <label for="tratamiento">Tratamiento:</label>
                        <textarea id="tratamiento" name="tratamiento"></textarea>
                    </div>
                </fieldset>
                <!-- Datos del acompañante  -->
                <fieldset>
                <legend>Datos del Acompañante del Paciente</legend>
                <div class="row">
                        <label for="primernombre">Primer Nombre:</label>
                        <input type="text" id="primerNombre" name="primerNombre">
                        <label for="segundonombre">Segundo Nombre:</label>
                        <input type="text" id="segundoNombre" name="segundoNombre" >
                    </div>
                    <div class="row">
                        <label for="apellidopaterno">Apellido Paterno:</label>
                        <input type="text" id="apellidoPaterno" name="apellidoPaterno">
                        <label for="apellidomaterno">Apellido Materno:</label>
                        <input type="text" id="apellidoMaterno" name="apellidoMaterno" >
                    </div> 
                    <div class="row">
                        <label for="dni">Tipo de Documento:</label>
                        <input type="text" id="dni" name="dni">
                        <label for="parentesco">Parentesco:</label>
                        <input type="text" id="parentesco" name="parentesco" >
                    </div>

                </fieldset>
                <!-- Destino del Paciente  -->
                <fieldset>
                    <legend>Destino del Paciente</legend>
                    <div class="row">
                        <label for="destinoPaciente">Destino del Paciente:</label>
                        <select id="destinoPaciente" name="destinoPaciente">
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="Domicilio">Domicilio</option>
                            <option value="Referido">Referido</option>
                            <option value="Defunción">Defunción</option>
                            <option value="Fuga">Fuga</option>
                            <option value="Observación">Observación</option>
                        </select>
                        <label for="establecimiento">Especificar Establecimiento:</label>
                        <textarea id="establecimiento" name="establecimiento"></textarea>
                    </div>
                </fieldset>

              <!-- Datos de Atención en Observación  -->
                <fieldset>
                    <legend>Datos de Atención en Observación</legend>
                    <div class="row">
                        <label for="fechaAtencion">Fecha de Ingreso:</label>
                        <input type="date" id="fechaAtencion" name="fechaAtencion">
                        <label for="horaAtencion">Hora de Ingreso:</label>
                        <input type="time" id="horaAtencion" name="horaAtencion">
                    </div>
                    <div class="row">
                        <label for="evolucion">Evolución:</label>
                        <textarea id="evolucion" name="evolucion"></textarea>
                    </div>
                    <div class="row">
                        <label for="diagnostico">Diagnóstico:</label>
                        <input type="text" id="diagnostico" name="diagnostico">
                        <label for="tipodeDX">Tipo de DX:</label>
                        <select id="tipo" name="tipo">
                        <option value="" selected="selected">- selecciona -</option>
                            <option value="presuntivo">Presuntivo</option>
                            <option value="definitivo">Definitivo</option>
                            <option value="repetido">Repetido</option>
                        </select>
                        <label for="cie10">CIE-10:</label>
                        <input type="text" id="cie10" name="cie10">
                    </div>
                </fieldset>

                 <!-- Alta del Paciente  -->
                <fieldset>
                    <legend>Alta del Paciente</legend>
                    <div class="row">
                        <label for="fechaAtencion">Fecha de Egreso:</label>
                        <input type="date" id="fechaAtencion" name="fechaAtencion">
                        <label for="horaAtencion">Hora de Egreso:</label>
                        <input type="time" id="horaAtencion" name="horaAtencion">
                    </div>
                    <div class="row">
                        <label for="responsableAlta">Responsable de Alta:</label>
                        <input type="text" id="responsableAlta" name="responsableAlta">
                        <label for="codigoResponsable">Código del Responsable:</label>
                        <input type="text" id="codigoResponsable" name="codigoResponsable">
                    </div>
                </fieldset>

                <!-- Firma  -->
                <fieldset>
                    <legend>Firma</legend>
                    <div class="row">
                        <label for="firma">Firma:</label>
                        <input type="file" id="firma" name="firma">
                    </div>
                </fieldset>

               <!-- Botón de Enviar  -->
                <div class="row">
                    <button type="submit">Guardar Historia Clínica</button>
                </div>
            </form>
        </div>
    </div>

    <!-- <script src="../js/scriptb.js"></script> -->
    <!-- <script src="../diana/script.js"></script> -->
</body>
</html>
