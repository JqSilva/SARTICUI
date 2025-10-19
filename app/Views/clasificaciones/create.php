<!-- app/Views/clasificaciones/create.php -->

<!-- Vista para la creación de una nueva Clasificación de Insumos -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Clasificación de Insumos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
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
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Clasificación</h1>

        <!-- Formulario para crear una nueva clasificación -->
        <form action="<?= base_url('clasificaciones/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre de la clasificación -->
                <div class="div1">
                    <label for="NOMBRE_CLASIFICACION" class="form-label">Nombre de la Clasificación</label>
                    <input type="text" class="form-control" id="NOMBRE_CLASIFICACION" name="NOMBRE_CLASIFICACION" required>
                </div>

                <!-- Campo para los días de post-apertura -->
                <div class="div2">
                    <label for="DIAS_ABERTURA_CLASIFICACION" class="form-label">Días de Post-Apertura</label>
                    <input type="number" class="form-control" id="DIAS_ABERTURA_CLASIFICACION" name="DIAS_ABERTURA_CLASIFICACION" required>
                </div>

                <!-- Campo para la unidad de contenido de la clasificación -->
                <div class="div3">
                    <label for="UNIDAD_CONTENIDO_CLASIFICACION" class="form-label">Contenido Base (Ejemplo: Unidad o Gramos)</label>
                    <input type="text" class="form-control" id="UNIDAD_CONTENIDO_CLASIFICACION" name="UNIDAD_CONTENIDO_CLASIFICACION" required>
                </div>

                <!-- Selección del estado de la clasificación -->
                <div class="div4">
                    <label for="ESTADO_CLASIFICACION" class="form-label">Estado de la Clasificación</label>
                    <select class="form-control" id="ESTADO_CLASIFICACION" name="ESTADO_CLASIFICACION" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Clasificación</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
