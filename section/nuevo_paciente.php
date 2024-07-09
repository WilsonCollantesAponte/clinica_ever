<!-- Archivo: nuevo_paciente.php -->
<div class="form-container">
    <h1>Nuevo Paciente</h1>
    <h4>Datos del paciente</h4>
    
    <form action="../php/registroPaciente.php" method="POST" id="formulario">
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <h6>Primer Nombre</h6>
                <input type="text" class="h-8 rounded-lg border-2 border-solid border-blue-600" name="primerNombre" id="primerNombre" style="width: 100%;"/>
                <div id="errorPrimerNombre" style="color: red; font-size: small;"></div>
            </div>
            <div>
                <h6>Segundo Nombre</h6>
                <input type="text" class="h-8 rounded-lg border-2 border-solid border-blue-600" name="segundoNombre" id="segundoNombre" style="width: 100%;"/>
                <div id="errorSegundoNombre" style="color: red; font-size: small;"></div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <h6>Apellido Paterno</h6>
                <input type="text" class="h-8 rounded-lg border-2 border-solid border-blue-600" name="apellidoPaterno" id="apellidoPaterno" style="width: 100%;"/>            
                <div id="errorApellidoPaterno" style="color: red; font-size: small;"></div>
            </div>
            <div>
                <h6>Apellido Materno</h6>
                <input type="text" class="h-8 rounded-lg border-2 border-solid border-blue-600" name="apellidoMaterno" id="apellidoMaterno" style="width: 100%;"/>
                <div id="errorApellidoMaterno" style="color: red; font-size: small;"></div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <h6>Grupo Sanguíneo</h6>
                <select class="h-8 rounded-lg border-2 border-solid border-blue-600" name="grupoSanguineo" id="grupoSanguineo" style="width: 100%;">
                    <option value="">Seleccionar...</option>
                    <option value="A+">Grupo A Rh+</option>
                    <option value="A-">Grupo A Rh-</option>
                    <option value="B+">Grupo B Rh+</option>
                    <option value="B-">Grupo B Rh-</option>
                    <option value="AB+">Grupo AB Rh+</option>
                    <option value="AB-">Grupo AB Rh-</option>
                    <option value="O+">Grupo O Rh+</option>
                    <option value="O-">Grupo O Rh-</option>
                </select>
                <div id="errorGrupoSanguineo" style="color: red; font-size: small;"></div>
            </div>
            <div>
                <h6>Estado Civil</h6>
                <select class="h-8 rounded-lg border-2 border-solid border-blue-600" name="estadoCivil" id="estadoCivil" style="width: 100%;">
                    <option value="">Seleccionar...</option>
                    <option value="soltero">Soltero/a</option>
                    <option value="casado">Casado/a</option>
                    <option value="conviviente">Conviviente</option>
                    <option value="divorciado">Divorciado/a</option>
                    <option value="viudo">Viudo/a</option>
                </select>
                <div id="errorEstadoCivil" style="color: red; font-size: small;"></div>
            </div>
            </div>
        <div class="grid grid-cols-1">
            <h6>Fecha de nacimiento</h6>
            <input type="date" class="form__input h-8 p-4 rounded-lg border-2 border-solid border-blue-600" name="fecha" id="fecha"/>
            <div id="errorFecha" style="color: red; font-size: small;"></div>
            <h6>Documento de Identidad</h6>
            <div>
                <input id="dni" type="radio" name="tipoDocumento" value="dni" />
                <label for="dni">DNI</label>
                <input id="carnet" type="radio" name="tipoDocumento" value="carnet" />
                <label for="carnet">Carnet de Extranjería</label>
                <input id="pasaporte" type="radio" name="tipoDocumento" value="pasaporte" />
                <label for="pasaporte">PASAPORTE</label>
            </div>
            <div id="errorTipoDocumento" style="color: red; font-size: small;"></div>
            <input type="text" name="documentoIdentidad" class="form__input h-8 p-4 rounded-lg border-2 border-solid border-blue-600" id="documentoIdentidad"/>
            <div id="errorDocumentoIdentidad" style="color: red; font-size: small;"></div>
            <div class="grid grid-cols-1 mt-4">
                <h6>Género</h6>
                <div>
                    <input id="masculino" type="radio" name="genero" value="masculino" />
                    <label for="masculino">Masculino </label>
                </div>
                <div>
                    <input id="femenino" type="radio" name="genero" value="femenino" />
                    <label for="femenino">Femenino </label>
                </div>
                <div id="errorGenero" style="color: red; font-size: small;"></div>
            </div>
        </div>
        <div>
            <h6>Historial Médico</h6>
            <textarea name="historial" id="historial" placeholder="Ej. Hipertensión, Diabetes tipo 2, alergias..."></textarea>
            <div id="errorHistorial" style="color: red; font-size: small;"></div>
        </div>
        <div class="flex justify-end">
            <button class="mr-8" type="submit">Guardar</button>
        </div>
    </form>
</div>
<script src="js/formulario.js"></script>
