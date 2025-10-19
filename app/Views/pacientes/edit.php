<!-- app/Views/pacientes/edit.php -->

<!-- Vista para la edición de un Paciente -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
        }

        .div2 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }

        .div3 {
            grid-column: span 2 / span 2;
            grid-row-start: 2;
        }

        .div4 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 2;
        }

        .div5 {
            grid-column: span 4 / span 4;
            grid-row-start: 3;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Paciente</h1>

        <!-- Formulario para actualizar un paciente existente -->
        <form action="<?= base_url('pacientes/update/'.$paciente['ID_PACIENTE']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el rut del paciente -->
                <div class="div1">
                    <label for="RUT_PACIENTE" class="form-label">RUT</label>
                    <input type="number" class="form-control" id="RUT_PACIENTE" name="RUT_PACIENTE" value="<?= $paciente['RUT_PACIENTE'] ?>" required>
                </div>

                <!-- Campo para el nombre del paciente -->
                <div class="div2">
                    <label for="NOMBRE_PACIENTE" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="NOMBRE_PACIENTE" name="NOMBRE_PACIENTE" value="<?= $paciente['NOMBRE_PACIENTE'] ?>" required>
                </div>

                <!-- Campo para el apellido parteno del paciente -->
                <div class="div3">
                    <label for="APATERNO_PACIENTE" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="APATERNO_PACIENTE" name="APATERNO_PACIENTE" value="<?= $paciente['APATERNO_PACIENTE'] ?>" required>
                </div>

                <!-- Campo para el apellido materno del paciente -->
                <div class="div4">
                    <label for="AMATERNO_PACIENTE" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="AMATERNO_PACIENTE" name="AMATERNO_PACIENTE" value="<?= $paciente['AMATERNO_PACIENTE'] ?>" required>
                </div>

                <!-- Campo para la fecha nacimiento del paciente -->
                <div class="div5">
                    <label for="FECHA_NACIMIENTO" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="FECHA_NACIMIENTO" name="FECHA_NACIMIENTO" value="<?= $paciente['FECHA_NACIMIENTO'] ?>" required>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>