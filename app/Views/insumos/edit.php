<!-- app/Views/insumos/edit.php -->

<!-- Vista para la edición de un Insumo -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Insumo</title>
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
        <h1>Editar Insumo</h1>

        <!-- Formulario para actualizar un insumo existente -->
        <form action="<?= base_url('insumos/update/'.$insumo['ID_INSUMO']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre de un insumo -->
                <div class="div1">
                    <label for="CODIGO_ABAS_INSUMO" class="form-label">Nombre del Insumo</label>
                    <input type="text" class="form-control" id="CODIGO_ABAS_INSUMO" name="CODIGO_ABAS_INSUMO" value="<?= $insumo['CODIGO_ABAS_INSUMO'] ?>" required>
                </div>

                <!-- Campo para el nombre de un insumo -->
                <div class="div2">
                    <label for="NOMBRE_INSUMO" class="form-label">Nombre del Insumo</label>
                    <input type="text" class="form-control" id="NOMBRE_INSUMO" name="NOMBRE_INSUMO" value="<?= $insumo['NOMBRE_INSUMO'] ?>" required>
                </div>

                <!-- Campo para la clasificacion de un insumo -->
                <div class="div3">
                    <label for="ID_CLASIFICACION_INSUMO" class="form-label">Clasificación del Insumo</label>
                    <select class="form-control" id="ID_CLASIFICACION_INSUMO" name="ID_CLASIFICACION_INSUMO" required>
                        <?php foreach ($clasificaciones as $clasificacion): ?>
                            <option value="<?= $clasificacion['ID_CLASIFICACION'] ?>" <?= $insumo['ID_CLASIFICACION_INSUMO'] == $clasificacion['ID_CLASIFICACION'] ? 'selected' : '' ?>>
                                <?= $clasificacion['NOMBRE_CLASIFICACION'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la disponibilidad de un insumo -->
                <div class="div4">
                    <label for="ID_DISPONIBILIDAD_INSUMO" class="form-label">Disponibilidad del Insumo</label>
                    <select class="form-control" id="ID_DISPONIBILIDAD_INSUMO" name="ID_DISPONIBILIDAD_INSUMO" required>
                        <?php foreach ($disponibilidades as $disponibilidad): ?>
                            <option value="<?= $disponibilidad['ID_DISPONIBILIDAD'] ?>" <?= $insumo['ID_DISPONIBILIDAD_INSUMO'] == $disponibilidad['ID_DISPONIBILIDAD'] ? 'selected' : '' ?>>
                                <?= $disponibilidad['NOMBRE_DISPONIBILIDAD'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el estado de un insumo -->
                <div class="div5">
                    <label for="ESTADO_INSUMO" class="form-label">Estado de la Licitación</label>
                    <select class="form-control" id="ESTADO_INSUMO" name="ESTADO_INSUMO" required>
                        <option value="1" <?= $insumo['ESTADO_INSUMO'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $insumo['ESTADO_INSUMO'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Insumo</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
