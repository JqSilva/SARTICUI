<!-- app/Views/solicitudes/edit.php -->

<!-- Vista para la edición de una Solicitud -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud Interna</title>
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
        }

        .div2 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Solicitud</h1>

        <!-- Formulario para actualizar una solicitud existente -->
        <form action="<?= base_url('solicitudes/update/'.$solicitud['ID_SOLICITUD']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el Usuario de la Solicitud -->
                <div class="div1">
                    <label for="ID_USUARIO_SOLICITUD" class="form-label">Clasificación del Solicitud</label>
                    <select class="form-control" id="ID_USUARIO_SOLICITUD" name="ID_USUARIO_SOLICITUD" required>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['ID_USUARIO'] ?>" <?= $solicitud['ID_USUARIO_SOLICITUD'] == $usuario['ID_USUARIO'] ? 'selected' : '' ?>>
                                <?= $usuario['NOMBRE_USUARIO'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la Sala de la Solicitud -->
                <div class="div2">
                    <label for="ID_SALA_SOLICITUD" class="form-label">Clasificación del Solicitud</label>
                    <select class="form-control" id="ID_SALA_SOLICITUD" name="ID_SALA_SOLICITUD" required>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= $sala['ID_SALA'] ?>" <?= $solicitud['ID_SALA_SOLICITUD'] == $sala['ID_SALA'] ? 'selected' : '' ?>>
                                <?= $sala['NOMBRE_SALA'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Campo para el Estado de la Solicitud -->
            <div class="mb-3">
                <label for="ID_ESTADO_SOLICITUD_INS" class="form-label">Disponibilidad del Solicitud</label>
                <select class="form-control" id="ID_ESTADO_SOLICITUD_INS" name="ID_ESTADO_SOLICITUD_INS" required>
                    <?php foreach ($estadossolicitudes as $estadosolicitud): ?>
                        <option value="<?= $estadosolicitud['ID_ESTADO_SOLICITUD'] ?>" <?= $solicitud['ID_ESTADO_SOLICITUD_INS'] == $estadosolicitud['ID_ESTADO_SOLICITUD'] ? 'selected' : '' ?>>
                            <?= $estadosolicitud['NOMBRE_ESTADO_SOLICITUD'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
