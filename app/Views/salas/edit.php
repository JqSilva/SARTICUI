<!-- app/Views/salas/edit.php -->

<!-- Vista para la edición de una Sala -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sala</title>
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
        <h1>Editar Sala</h1>

        <!-- Formulario para actualizar una sala existente -->
        <form action="<?= base_url('salas/update/'.$sala['ID_SALA']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el número de la sala -->
                <div class="div1">
                    <label for="NUMERO_SALA" class="form-label">Número de la Sala</label>
                    <input type="text" class="form-control" id="NUMERO_SALA" name="NUMERO_SALA" value="<?= $sala['NUMERO_SALA'] ?>" required>
                </div>

                <!-- Campo para el nombre de la sala -->
                <div class="div2">
                    <label for="NOMBRE_SALA" class="form-label">Nombre de la Sala</label>
                    <input type="text" class="form-control" id="NOMBRE_SALA" name="NOMBRE_SALA" value="<?= $sala['NOMBRE_SALA'] ?>" required>
                </div>

                <!-- Campo para el estado de la sala -->
                <div class="div3">
                    <label for="ESTADO_SALA" class="form-label">Estado de la Sala</label>
                    <select class="form-control" id="ESTADO_SALA" name="ESTADO_SALA" required>
                        <option value="1" <?= $sala['ESTADO_SALA'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $sala['ESTADO_SALA'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

                <!-- Campo para la subunidad de la sala -->
                <div class="div4">
                    <label for="ID_SUBUNIDAD_SALA" class="form-label">SubUnidad</label>
                    <select class="form-control" id="ID_SUBUNIDAD_SALA" name="ID_SUBUNIDAD_SALA" required>
                        <?php foreach ($subunidades as $subunidad): ?>
                            <option value="<?= $subunidad['ID_SUBUNIDAD'] ?>" <?= $sala['ID_SUBUNIDAD_SALA'] == $subunidad['ID_SUBUNIDAD'] ? 'selected' : '' ?>>
                                <?= $subunidad['NOMBRE_SUBUNIDAD'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Sala</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
