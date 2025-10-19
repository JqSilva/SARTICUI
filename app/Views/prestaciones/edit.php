<!-- app/Views/prestaciones/edit.php -->

<!-- Vista para la edición de una Prestación -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prestación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, auto);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
        }

        .div2 {
            grid-column-start: 3;
        }

        .div3 {
            grid-column-start: 4;
        }

        .div4 {
            grid-column: span 2 / span 2;
            grid-row-start: 2;
        }

        .div5 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 2;
        }

        .div6 {
            grid-column: span 2 / span 2;
            grid-row-start: 3;
            margin-bottom: 10px;
        }

        .div7 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 3;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Prestación</h1>

        <!-- Formulario para actualizar una prestación existente -->
        <form action="<?= base_url('prestaciones/update/'.$prestacion['ID_PRESTACION']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para la fecha de prestación -->
                <div class="div1">
                    <label for="FECHA_PRESTACION" class="form-label">Fecha de Prestación</label>
                    <input type="date" class="form-control" id="FECHA_PRESTACION" name="FECHA_PRESTACION" value="<?= $prestacion['FECHA_PRESTACION'] ?>" required>
                </div>

                <!-- Campo para la hora de inicio de la prestación -->
                <div class="div2">
                    <label for="HORA_INICIO" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" id="HORA_INICIO" name="HORA_INICIO" value="<?= $prestacion['HORA_INICIO'] ?>" required>
                </div>

                <!-- Campo para la hora de fin de la prestación -->
                <div class="div3">
                    <label for="HORA_FIN" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" id="HORA_FIN" name="HORA_FIN" value="<?= $prestacion['HORA_FIN'] ?>" required>
                </div>

                <!-- Campo para el procedimiento de la prestación -->
                <div class="div4">
                    <label for="ID_PROCEDIMIENTO_PRES" class="form-label">Procedimiento</label>
                    <select class="form-control" id="ID_PROCEDIMIENTO_PRES" name="ID_PROCEDIMIENTO_PRES" required>
                        <?php foreach ($procedimientos as $procedimiento): ?>
                            <option value="<?= $procedimiento['ID_PROCEDIMIENTO'] ?>" <?= $prestacion['ID_PROCEDIMIENTO_PRES'] == $procedimiento['ID_PROCEDIMIENTO'] ? 'selected' : '' ?>>
                                <?= $procedimiento['NOMBRE_PROCEDIMIENTO'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la condición del paciente de la prestación -->
                <div class="div5">
                    <label for="ID_CONDICION_PACIENTE_PRES" class="form-label">Condición del Paciente</label>
                    <select class="form-control" id="ID_CONDICION_PACIENTE_PRES" name="ID_CONDICION_PACIENTE_PRES" required>
                        <?php foreach ($condicionespacientes as $condicionpaciente): ?>
                            <option value="<?= $condicionpaciente['ID_CONDICION_PACIENTE'] ?>" <?= $prestacion['ID_CONDICION_PACIENTE_PRES'] == $condicionpaciente['ID_CONDICION_PACIENTE'] ? 'selected' : '' ?>>
                                <?= $condicionpaciente['NOMBRE_CONDICION_PACIENTE'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el paciente de la prestación -->
                <div class="div6">
                    <label for="ID_PACIENTE_PRES" class="form-label">Paciente</label>
                    <select class="form-control" id="ID_PACIENTE_PRES" name="ID_PACIENTE_PRES" required>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?= $paciente['ID_PACIENTE'] ?>" <?= $prestacion['ID_PACIENTE_PRES'] == $paciente['ID_PACIENTE'] ? 'selected' : '' ?>>
                                <?= $paciente['RUT_PACIENTE'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la sala de la prestación -->
                <div class="div7">
                    <label for="ID_SALA_PRES" class="form-label">Sala</label>
                    <select class="form-control" id="ID_SALA_PRES" name="ID_SALA_PRES" required>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= $sala['ID_SALA'] ?>" <?= $prestacion['ID_SALA_PRES'] == $sala['ID_SALA'] ? 'selected' : '' ?>>
                                <?= $sala['NOMBRE_SALA'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Prestación</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
