CREATE TABLE IF NOT EXISTS historia_clinica (
    dni VARCHAR(20) PRIMARY KEY,
    primerNombre VARCHAR(50),
    segundoNombre VARCHAR(50),
    apellidoPaterno VARCHAR(50),
    apellidoMaterno VARCHAR(50),
    fechaNacimiento DATE,
    edad INT,
    sexo CHAR(1),
    estadoCivil VARCHAR(20),
    grupoSanguineo VARCHAR(10),
    fechaAtencion DATE,
    horaAtencion TIME,
    departamento VARCHAR(50),
    provincia VARCHAR(50),
    distrito VARCHAR(50),
    localidad VARCHAR(50),
    direccion VARCHAR(100),
    tipoAtencion VARCHAR(50),
    servicio VARCHAR(50),
    tiempoEnfermedad VARCHAR(100),
    sintomas TEXT,
    relato TEXT,
    antecedentes TEXT,
    frecuenciaCardiaca VARCHAR(20),
    frecuenciaRespiratoria VARCHAR(20),
    temperatura VARCHAR(20),
    presionArterial VARCHAR(20),
    saturacionOxigeno VARCHAR(20),
    diagnostico VARCHAR(255),
    tipoDX VARCHAR(50),
    cie10 VARCHAR(50),
    tratamiento TEXT,
    nombrePrimerAcomp VARCHAR(50),
    nombreSegundoAcomp VARCHAR(50),
    apellidoPaternoAcomp VARCHAR(50),
    apellidoMaternoAcomp VARCHAR(50),
    dniAcompanante VARCHAR(20),
    parentesco VARCHAR(50),
    destinoPaciente VARCHAR(50),
    establecimientoReferencia TEXT,
    evolucion TEXT,
    fechaEgreso DATE,
    horaEgreso TIME,
    nombreResponsableAlta VARCHAR(50),
    idPersonalMedico INT,
    firma VARCHAR(255)
);
