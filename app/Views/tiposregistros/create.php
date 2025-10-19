<!-- app/Views/tiposregistros/create.php -->

<!-- Vista para la creación de un nuevo Tipo de Registro -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tipo de Registro</title>
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
        <h1>Crear Tipo de Registro</h1>

        <!-- Formulario para crear un nuevo Tipo de Registro -->
        <form action="<?= base_url('tiposregistros/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del tipo de registro -->
                <div class="mb-3">
                    <label for="NOMBRE_TIPO_REGISTRO" class="form-label">Nombre de Tipo de Registro</label>
                    <input type="text" class="form-control" id="NOMBRE_TIPO_REGISTRO" name="NOMBRE_TIPO_REGISTRO" required>
                </div>

                <!-- Selección del estado del tipo de registro -->
                <div class="mb-3">
                    <label for="ESTADO_TIPO_REGISTRO" class="form-label">Estado de Tipo de Registro</label>
                    <select class="form-control" id="ESTADO_TIPO_REGISTRO" name="ESTADO_TIPO_REGISTRO" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Tipo de Registro</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
