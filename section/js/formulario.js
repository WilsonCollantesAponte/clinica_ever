document
  .getElementById("formulario")
  .addEventListener("submit", function (event) {
    let errores = [];

    const primerNombre = document.getElementById("primerNombre");
    const segundoNombre = document.getElementById("segundoNombre");
    const apellidoPaterno = document.getElementById("apellidoPaterno");
    const apellidoMaterno = document.getElementById("apellidoMaterno");
    const grupoSanguineo = document.getElementById("grupoSanguineo");
    const estadoCivil = document.getElementById("estadoCivil");
    const fecha = document.getElementById("fecha");
    const documentoIdentidad = document.getElementById("documentoIdentidad");
    const tipoDocumento = document.querySelector(
      'input[name="tipoDocumento"]:checked'
    );
    const genero = document.querySelector('input[name="genero"]:checked');
    const historial = document.getElementById("historial");

    // Limpiar mensajes de error
    document.querySelectorAll(".text-red-500").forEach((el) => {
      el.textContent = "";
    });

    // Validar campos
    if (!primerNombre.value.trim()) {
      errores.push({
        campo: "errorPrimerNombre",
        mensaje:
          "El primer nombre no puede estar vacío o contener solo espacios.",
      });
    } else if (!/^[a-zA-Z]+$/.test(primerNombre.value)) {
      errores.push({
        campo: "errorPrimerNombre",
        mensaje: "El primer nombre solo puede contener letras.",
      });
    }

    if (!/^[a-zA-Z]*$/.test(segundoNombre.value)) {
      errores.push({
        campo: "errorSegundoNombre",
        mensaje: "El segundo nombre solo puede contener letras.",
      });
    }

    if (!apellidoPaterno.value.trim()) {
      errores.push({
        campo: "errorApellidoPaterno",
        mensaje:
          "El apellido paterno no puede estar vacío o contener solo espacios.",
      });
    } else if (!/^[a-zA-Z]+$/.test(apellidoPaterno.value)) {
      errores.push({
        campo: "errorApellidoPaterno",
        mensaje: "El apellido paterno solo puede contener letras.",
      });
    }

    if (!apellidoMaterno.value.trim()) {
      errores.push({
        campo: "errorApellidoMaterno",
        mensaje:
          "El apellido materno no puede estar vacío o contener solo espacios.",
      });
    } else if (!/^[a-zA-Z]+$/.test(apellidoMaterno.value)) {
      errores.push({
        campo: "errorApellidoMaterno",
        mensaje: "El apellido materno solo puede contener letras.",
      });
    }

    if (!grupoSanguineo.value.trim()) {
      errores.push({
        campo: "errorGrupoSanguineo",
        mensaje: "Debe seleccionar un grupo sanguíneo.",
      });
    }

    if (!estadoCivil.value.trim()) {
      errores.push({
        campo: "errorEstadoCivil",
        mensaje: "Debe seleccionar un estado civil.",
      });
    }

    if (!fecha.value) {
      errores.push({
        campo: "errorFecha",
        mensaje: "Debe seleccionar una fecha de nacimiento.",
      });
    } else {
      const fechaNacimiento = new Date(fecha.value);
      const fechaActual = new Date();
      if (fechaNacimiento > fechaActual) {
        errores.push({
          campo: "errorFecha",
          mensaje: "La fecha de nacimiento no puede ser una fecha futura.",
        });
      }
    }

    if (!tipoDocumento) {
      errores.push({
        campo: "errorTipoDocumento",
        mensaje: "Debe seleccionar un tipo de documento.",
      });
    }

    if (!documentoIdentidad.value.trim()) {
      errores.push({
        campo: "errorDocumentoIdentidad",
        mensaje:
          "El documento de identidad no puede estar vacío o contener solo espacios.",
      });
    } else {
      if (
        tipoDocumento &&
        tipoDocumento.value === "dni" &&
        !/^[0-9]{8}$/.test(documentoIdentidad.value)
      ) {
        errores.push({
          campo: "errorDocumentoIdentidad",
          mensaje: "El DNI debe tener 8 números positivos.",
        });
      }
      if (
        tipoDocumento &&
        tipoDocumento.value === "carnet" &&
        !/^[0-9]{1,20}$/.test(documentoIdentidad.value)
      ) {
        errores.push({
          campo: "errorDocumentoIdentidad",
          mensaje: "El Carnet de Extranjería debe tener entre 1 y 20 dígitos.",
        });
      }
      if (
        tipoDocumento &&
        tipoDocumento.value === "pasaporte" &&
        !/^[A-Za-z]{3}[0-9]{6}$/.test(documentoIdentidad.value)
      ) {
        errores.push({
          campo: "errorDocumentoIdentidad",
          mensaje:
            "El Pasaporte debe tener tres letras seguidas de seis dígitos.",
        });
      }
    }

    if (!genero) {
      errores.push({
        campo: "errorGenero",
        mensaje: "Debe seleccionar un género.",
      });
    }

    if (!historial.value.trim()) {
      errores.push({
        campo: "errorHistorial",
        mensaje:
          "El historial médico no puede estar vacío o contener solo espacios.",
      });
    }

    if (errores.length > 0) {
      event.preventDefault();
      errores.forEach((error) => {
        document.getElementById(error.campo).textContent = error.mensaje;
      });
    }
  });

// Añadir validadores dinámicos para limpiar errores
document.getElementById("primerNombre").addEventListener("input", function () {
  if (this.value.trim() && /^[a-zA-Z]+$/.test(this.value)) {
    document.getElementById("errorPrimerNombre").textContent = "";
  }
});

document.getElementById("segundoNombre").addEventListener("input", function () {
  if (/^[a-zA-Z]*$/.test(this.value)) {
    document.getElementById("errorSegundoNombre").textContent = "";
  }
});

document
  .getElementById("apellidoPaterno")
  .addEventListener("input", function () {
    if (this.value.trim() && /^[a-zA-Z]+$/.test(this.value)) {
      document.getElementById("errorApellidoPaterno").textContent = "";
    }
  });

document
  .getElementById("apellidoMaterno")
  .addEventListener("input", function () {
    if (this.value.trim() && /^[a-zA-Z]+$/.test(this.value)) {
      document.getElementById("errorApellidoMaterno").textContent = "";
    }
  });

document
  .getElementById("grupoSanguineo")
  .addEventListener("change", function () {
    if (this.value.trim()) {
      document.getElementById("errorGrupoSanguineo").textContent = "";
    }
  });

document.getElementById("estadoCivil").addEventListener("change", function () {
  if (this.value.trim()) {
    document.getElementById("errorEstadoCivil").textContent = "";
  }
});

document.getElementById("fecha").addEventListener("change", function () {
  if (this.value) {
    const fechaNacimiento = new Date(this.value);
    const fechaActual = new Date();
    if (fechaNacimiento <= fechaActual) {
      document.getElementById("errorFecha").textContent = "";
    }
  }
});

document.querySelectorAll('input[name="tipoDocumento"]').forEach((elem) => {
  elem.addEventListener("change", function () {
    if (document.querySelector('input[name="tipoDocumento"]:checked')) {
      document.getElementById("errorTipoDocumento").textContent = "";
    }
  });
});

document
  .getElementById("documentoIdentidad")
  .addEventListener("input", function () {
    const tipoDocumento = document.querySelector(
      'input[name="tipoDocumento"]:checked'
    );
    if (this.value.trim()) {
      let valid = false;
      if (tipoDocumento.value === "dni" && /^[0-9]{8}$/.test(this.value)) {
        valid = true;
      } else if (
        tipoDocumento.value === "carnet" &&
        /^[0-9]{1,20}$/.test(this.value)
      ) {
        valid = true;
      } else if (
        tipoDocumento.value === "pasaporte" &&
        /^[A-Za-z]{3}[0-9]{6}$/.test(this.value)
      ) {
        valid = true;
      }
      if (valid) {
        document.getElementById("errorDocumentoIdentidad").textContent = "";
      }
    }
  });

document.querySelectorAll('input[name="genero"]').forEach((elem) => {
  elem.addEventListener("change", function () {
    if (document.querySelector('input[name="genero"]:checked')) {
      document.getElementById("errorGenero").textContent = "";
    }
  });
});

document.getElementById("historial").addEventListener("input", function () {
  if (this.value.trim()) {
    document.getElementById("errorHistorial").textContent = "";
  }
});
