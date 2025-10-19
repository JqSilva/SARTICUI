<!-- app/Views/procedencias/create.php -->

<!-- Vista para la creación de una nueva Procedencia -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Procedencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(1, 1fr);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
            margin-bottom: 10px;
        }

        .div2 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Procedencia</h1>

        <!-- Formulario para crear una nueva precedencia -->
        <form action="<?= base_url('procedencias/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre de la procedencia -->
                <div class="div1">
                    <label for="NOMBRE_PROCEDENCIA" class="form-label">Nombre de Procedencia</label>
                    <input type="text" class="form-control" id="NOMBRE_PROCEDENCIA" name="NOMBRE_PROCEDENCIA" required>
                </div>

                <!-- Campo para el estado de la clasificación -->
                <div class="div2">
                    <label for="ESTADO_PROCEDENCIA" class="form-label">Estado de Procedencia</label>
                    <select class="form-control" id="ESTADO_PROCEDENCIA" name="ESTADO_PROCEDENCIA" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Procedencia</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
