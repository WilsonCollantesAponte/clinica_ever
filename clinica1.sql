-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2024 a las 20:22:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acompanante`
--

CREATE TABLE `acompanante` (
  `id` int(11) NOT NULL,
  `parentesco` varchar(50) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anamnesis`
--

CREATE TABLE `anamnesis` (
  `id` int(11) NOT NULL,
  `idExamenFisico` int(11) NOT NULL,
  `TiempoEnfermedad` text DEFAULT NULL,
  `SintomasPrincipales` text NOT NULL,
  `Relato` text NOT NULL,
  `Antecedentes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencionobservacion`
--

CREATE TABLE `atencionobservacion` (
  `id` int(11) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL,
  `evolucion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinopaciente`
--

CREATE TABLE `destinopaciente` (
  `id` int(11) NOT NULL,
  `destinoPaciente` varchar(30) NOT NULL,
  `establecimientoReferencia` varchar(100) DEFAULT NULL,
  `nombreResponsableAtencion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticoalta`
--

CREATE TABLE `diagnosticoalta` (
  `id` int(11) NOT NULL,
  `idObservacion` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `tipoDX` varchar(2) NOT NULL,
  `cie10` text NOT NULL,
  `fechaEgreso` date NOT NULL,
  `horaEgreso` time NOT NULL,
  `nombreResponsableAlta` varchar(100) NOT NULL,
  `firma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio_paciente`
--

CREATE TABLE `domicilio_paciente` (
  `id` int(11) NOT NULL,
  `departamento` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `distrito` varchar(40) NOT NULL,
  `localidad` varchar(40) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `idHistoriaClinica` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenfisico`
--

CREATE TABLE `examenfisico` (
  `id` int(11) NOT NULL,
  `frecuenciaCardiaca` varchar(45) NOT NULL,
  `frecuenciaRespiratoria` varchar(45) NOT NULL,
  `temperatura` varchar(45) NOT NULL,
  `presionArterial` varchar(45) NOT NULL,
  `saturacionOxigeno` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiaclinica`
--

CREATE TABLE `historiaclinica` (
  `id` int(11) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL,
  `edad` int(11) NOT NULL,
  `tipoSeguro` varchar(30) NOT NULL,
  `tipoServicio` varchar(30) NOT NULL,
  `idImpresionDiagnostica` int(11) NOT NULL,
  `idDomicilioPaciente` int(11) NOT NULL,
  `idPersonalmedico` int(11) NOT NULL,
  `idDiagnosticoAlta` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `idAnamnesis` int(11) NOT NULL,
  `idAcompanante` int(11) DEFAULT NULL,
  `idDestinoPaciente` int(11) NOT NULL,
  `idAtencionObservacion` int(11) NOT NULL,
  `idExamenFisico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresiondiagnostica`
--

CREATE TABLE `impresiondiagnostica` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `tipoDX` varchar(2) NOT NULL,
  `cie10` text NOT NULL,
  `examenesAuxiliares` text NOT NULL,
  `tratamiento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `estadoCivil` varchar(40) DEFAULT NULL,
  `historialMedico` text DEFAULT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `estadoCivil`, `historialMedico`, `idPersona`) VALUES
(1, 'soltero', 'jooml', 2),
(2, 'divorciado', 'diabetes tipo II, Hipertensionc (Marca pasos)', 3),
(3, 'casado', 'No registra', 4),
(4, 'conviviente', 'lojo', 5),
(5, 'casado', 'ninguna', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombrePrimer` varchar(45) NOT NULL,
  `nombreSegundo` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) NOT NULL,
  `apellidoMaterno` varchar(45) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `tipoDoumento` varchar(45) DEFAULT NULL,
  `documentoIdentidad` varchar(20) NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `grupoSanguineo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombrePrimer`, `nombreSegundo`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `tipoDoumento`, `documentoIdentidad`, `sexo`, `grupoSanguineo`) VALUES
(1, 'Pedro', 'Alfonso', 'Coronado', 'Garcia', '1995-06-05', 'DNI', '02672204', 'M', ''),
(2, 'filadelfio', 'pelon', 'cordova', 'gines', '1999-12-12', 'dni', '73947277', 'M', ''),
(3, 'Andres', 'Cecilio', 'Matorel', 'Juarez', '2002-03-11', 'dni', '73722502', 'M', ''),
(4, 'Gustavo', 'Heberth', 'Matorel', 'Mechato', '2003-04-05', 'dni', '73228290', 'M', ''),
(5, 'Gustavo', 'Heberth', 'Matorel', 'Mechato', '2000-06-05', 'dni', '73228290', 'F', ''),
(6, 'Veronica', 'Taylor', 'Yanque', 'Soto', '2000-08-14', 'dni', '72778280', 'F', ''),
(7, 'Heberth', 'Leonidas', 'Cordova', 'Gines', '2003-04-05', 'DNI', '73947277', 'M', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_medico`
--

CREATE TABLE `personal_medico` (
  `id` int(11) NOT NULL,
  `especialidad` varchar(20) NOT NULL,
  `numeroColegiatura` varchar(20) NOT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `personal_medico`
--

INSERT INTO `personal_medico` (`id`, `especialidad`, `numeroColegiatura`, `correo`, `idPersona`) VALUES
(1, 'Médico cirujano', '856487595', 'Coronado1995@gmail.com', 1),
(2, 'Enfermeria', '785942556', 'vero.2000@gmail.com', 6),
(3, 'Admision', '58648922', 'andresmatorel2002@gmail.com', 3),
(4, 'Admin', '----', 'cordovaheberth@gmail.com', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Admision'),
(3, 'Enfermeria'),
(4, 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `idPersonalMedico` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `codigo`, `password`, `estado`, `idPersonalMedico`, `id_cargo`) VALUES
(1, 'PC1995', '123456', 'activo', 1, 4),
(2, 'PC2000', '159951', 'activo', 2, 3),
(3, 'PC2002', '121314', 'activo', 3, 2),
(4, 'admin', 'h73947277', NULL, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acompanante`
--
ALTER TABLE `acompanante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_idx` (`idPersona`);

--
-- Indices de la tabla `anamnesis`
--
ALTER TABLE `anamnesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenfisico_idExamenMedico_users` (`idExamenFisico`);

--
-- Indices de la tabla `atencionobservacion`
--
ALTER TABLE `atencionobservacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `destinopaciente`
--
ALTER TABLE `destinopaciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diagnosticoalta`
--
ALTER TABLE `diagnosticoalta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atencionobservacion_idObservacion_users` (`idObservacion`);

--
-- Indices de la tabla `domicilio_paciente`
--
ALTER TABLE `domicilio_paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examenfisico`
--
ALTER TABLE `examenfisico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historiaclinica`
--
ALTER TABLE `historiaclinica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registro_nuevo_paciente_IDpaciente_formato_hc_emergencia` (`idPaciente`),
  ADD KEY `personal_medico_IDpersonalmedico_formato_hc_emergencia` (`idPersonalmedico`),
  ADD KEY `acompañante_IDacompañante_formato_hc_emergencia` (`fechaIngreso`),
  ADD KEY `domicilio_paciente_IDdomiciliopaciente_formato_hc_emergencia` (`tipoSeguro`),
  ADD KEY `fk_impresionDiagnostica_idx` (`idImpresionDiagnostica`),
  ADD KEY `fk_domicilioPaciente_idx` (`idDomicilioPaciente`),
  ADD KEY `fk_diagnosticoAlta_idx` (`idDiagnosticoAlta`),
  ADD KEY `fk_acompanante_idx` (`idAcompanante`),
  ADD KEY `fk_anamnesis_idx` (`idAnamnesis`),
  ADD KEY `fk_destinopaciente` (`idDestinoPaciente`),
  ADD KEY `fk_atencionObservacion` (`idAtencionObservacion`),
  ADD KEY `fk_examenFisico` (`idExamenFisico`);

--
-- Indices de la tabla `impresiondiagnostica`
--
ALTER TABLE `impresiondiagnostica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idPersona_UNIQUE` (`idPersona`),
  ADD KEY `fk_Persona_idx` (`idPersona`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_medico`
--
ALTER TABLE `personal_medico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idPersona_UNIQUE` (`idPersona`),
  ADD KEY `fk_persona_medico_idx` (`idPersona`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idPersonalMedico_UNIQUE` (`idPersonalMedico`),
  ADD KEY `fk_usuario_medico_idx` (`idPersonalMedico`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acompanante`
--
ALTER TABLE `acompanante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anamnesis`
--
ALTER TABLE `anamnesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `atencionobservacion`
--
ALTER TABLE `atencionobservacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `destinopaciente`
--
ALTER TABLE `destinopaciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diagnosticoalta`
--
ALTER TABLE `diagnosticoalta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicilio_paciente`
--
ALTER TABLE `domicilio_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examenfisico`
--
ALTER TABLE `examenfisico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historiaclinica`
--
ALTER TABLE `historiaclinica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personal_medico`
--
ALTER TABLE `personal_medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acompanante`
--
ALTER TABLE `acompanante`
  ADD CONSTRAINT `fk_persona` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `anamnesis`
--
ALTER TABLE `anamnesis`
  ADD CONSTRAINT `examenfisico_idExamenMedico_users` FOREIGN KEY (`idExamenFisico`) REFERENCES `examenfisico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `diagnosticoalta`
--
ALTER TABLE `diagnosticoalta`
  ADD CONSTRAINT `atencionobservacion_idObservacion_users` FOREIGN KEY (`idObservacion`) REFERENCES `atencionobservacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historiaclinica`
--
ALTER TABLE `historiaclinica`
  ADD CONSTRAINT `fk_acompanante` FOREIGN KEY (`idAcompanante`) REFERENCES `acompanante` (`id`),
  ADD CONSTRAINT `fk_anamnesis` FOREIGN KEY (`idAnamnesis`) REFERENCES `anamnesis` (`id`),
  ADD CONSTRAINT `fk_atencionObservacion` FOREIGN KEY (`idAtencionObservacion`) REFERENCES `atencionobservacion` (`id`),
  ADD CONSTRAINT `fk_destinopaciente` FOREIGN KEY (`idDestinoPaciente`) REFERENCES `destinopaciente` (`id`),
  ADD CONSTRAINT `fk_diagnosticoAlta` FOREIGN KEY (`idDiagnosticoAlta`) REFERENCES `diagnosticoalta` (`id`),
  ADD CONSTRAINT `fk_domicilioPaciente` FOREIGN KEY (`idDomicilioPaciente`) REFERENCES `domicilio_paciente` (`id`),
  ADD CONSTRAINT `fk_examenFisico` FOREIGN KEY (`idExamenFisico`) REFERENCES `examenfisico` (`id`),
  ADD CONSTRAINT `fk_impresionDiagnostica` FOREIGN KEY (`idImpresionDiagnostica`) REFERENCES `impresiondiagnostica` (`id`),
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`idPaciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `fk_personalMedico` FOREIGN KEY (`idPersonalmedico`) REFERENCES `personal_medico` (`id`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_persona_paciente` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `personal_medico`
--
ALTER TABLE `personal_medico`
  ADD CONSTRAINT `fk_persona_medico` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_id_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `fk_usuario_medico` FOREIGN KEY (`idPersonalMedico`) REFERENCES `personal_medico` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
