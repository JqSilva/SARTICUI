<!-- app/Views/insumos/create.php -->

<!-- Vista para la creación de un nuevo Insumo -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Insumo</title>
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
        <h1>Crear Insumo</h1>

        <!-- Formulario para crear un nuevo insumo -->
        <form action="<?= base_url('insumos/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el codigo ABAS del insumo -->
                <div class="div1">
                    <label for="CODIGO_ABAS_INSUMO" class="form-label">Código ABAS del Insumo</label>
                    <input type="text" class="form-control" id="CODIGO_ABAS_INSUMO" name="CODIGO_ABAS_INSUMO" required>
                </div>

                <!-- Campo para el nombre del insumo -->
                <div class="div2">
                    <label for="NOMBRE_INSUMO" class="form-label">Nombre del Insumo</label>
                    <input type="text" class="form-control" id="NOMBRE_INSUMO" name="NOMBRE_INSUMO" required>
                </div>

                <!-- Campo para la clasificacion del insumo -->
                <div class="div3">
                    <label for="ID_CLASIFICACION_INSUMO" class="form-label">Clasificación del Insumo</label>
                    <select class="form-control" id="ID_CLASIFICACION_INSUMO" name="ID_CLASIFICACION_INSUMO" required>
                        <?php foreach ($clasificaciones as $clasificacion): ?>
                            <option value="<?= $clasificacion['ID_CLASIFICACION'] ?>"><?= $clasificacion['NOMBRE_CLASIFICACION'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la clasificacion del insumo -->
                <div class="div4">
                    <label for="ID_DISPONIBILIDAD_INSUMO" class="form-label">Disponibilidad del Insumo</label>
                    <select class="form-control" id="ID_DISPONIBILIDAD_INSUMO" name="ID_DISPONIBILIDAD_INSUMO" required>
                        <?php foreach ($disponibilidades as $disponibilidad): ?>
                            <option value="<?= $disponibilidad['ID_DISPONIBILIDAD'] ?>"><?= $disponibilidad['NOMBRE_DISPONIBILIDAD'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el estado del insumo -->
                <div class="div5">
                    <label for="ESTADO_INSUMO" class="form-label">Estado del Insumo</label>
                    <select class="form-control" id="ESTADO_INSUMO" name="ESTADO_INSUMO" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Insumo</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
