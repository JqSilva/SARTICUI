<!-- app/Views/condicionespacientes/create.php -->

<!-- Vista para la creación de una nueva Condición de Paciente -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Condición de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(1, 1fr);
            gap: 8px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Condición de Paciente</h1>

        <!-- Formulario para crear una nueva condicion -->
        <form action="<?= base_url('condicionespacientes/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre de la condicion del paciente -->
                <div class="mb-3">
                    <label for="NOMBRE_CONDICION_PACIENTE" class="form-label">Nombre de la Condición de Paciente</label>
                    <input type="text" class="form-control" id="NOMBRE_CONDICION_PACIENTE" name="NOMBRE_CONDICION_PACIENTE" required>
                </div>

                <!-- Campo para el estado de la condicion del paciente -->
                <div class="mb-3">
                    <label for="ESTADO_CONDICION_PACIENTE" class="form-label">Estado</label>
                    <select class="form-control" id="ESTADO_CONDICION_PACIENTE" name="ESTADO_CONDICION_PACIENTE" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Condición de Paciente</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
