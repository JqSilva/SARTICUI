<!-- app/Views/solicitudes/create.php -->

<!-- Vista para la creación de una nueva Solicitud -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud Interna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Librería para alertas -->

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(1, auto);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
        }

        .div2 {
            grid-column-start: 3;
            grid-row-start: 1;
        }

        .div3 {
            grid-column-start: 4;
            grid-row-start: 1;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Solicitud</h1>

        <!-- Formulario para crear una nueva solicitud -->
        <form action="<?= base_url('solicitudes/store') ?>" method="POST">
            <div class="parent">
                <!-- Fecha (Oculta ya que MySQL gestiona la fecha automáticamente) -->
                <input type="hidden" name="FECHA_SOLICITUD" value="<?= date('Y-m-d H:i:s') ?>">

                <!-- Campo para el Usuario de la Solicitud -->
                <div class="div1">
                    <label for="ID_USUARIO_SOLICITUD" class="form-label">Usuario</label>
                    <select class="form-control" id="ID_USUARIO_SOLICITUD" name="ID_USUARIO_SOLICITUD" required>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['ID_USUARIO'] ?>"><?= $usuario['NOMBRE_USUARIO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Campo para la Sala de la Solicitud-->
                <div class="div2">
                    <label for="ID_SALA_SOLICITUD" class="form-label">Sala</label>
                    <select class="form-control" id="ID_SALA_SOLICITUD" name="ID_SALA_SOLICITUD" required>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= $sala['ID_SALA'] ?>"><?= $sala['NOMBRE_SALA'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Campo para el Estado de la Solicitud -->
                <div class="div3">
                    <label for="ID_ESTADO_SOLICITUD_INS" class="form-label">Estado</label>
                    <select class="form-control" id="ID_ESTADO_SOLICITUD_INS" name="ID_ESTADO_SOLICITUD_INS" required>
                        <?php foreach ($estadossolicitudes as $estadosolicitud): ?>
                            <option value="<?= $estadosolicitud['ID_ESTADO_SOLICITUD'] ?>"><?= $estadosolicitud['NOMBRE_ESTADO_SOLICITUD'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Campo para los Insumos y Cantidades -->
            <div id="insumos-container">
                <div class="mb-3 insumo-row">
                    <label for="insumo_1" class="form-label">Insumo</label>
                    <select class="form-control" id="insumo_1" name="insumos[0][ID_INSUMO_DE]" required>
                        <!-- Aquí deberías cargar los insumos disponibles (similar a usuarios, salas, etc.) -->
                        <?php foreach ($insumos as $insumo): ?>
                            <option value="<?= $insumo['ID_INSUMO'] ?>"><?= $insumo['NOMBRE_INSUMO'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="cantidad_1" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad_1" name="insumos[0][CANTIDAD]" required min="1">
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="button" class="btn btn-secondary" id="add-insumo">Agregar Insumo</button>
            <button type="submit" class="btn btn-primary">Crear Solicitud</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" id="cancelar-btn">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let insumoIndex = 1;

        // Agregar nuevo insumo
        document.getElementById('add-insumo').addEventListener('click', function () {
            let newRow = document.createElement('div');
            newRow.classList.add('mb-3', 'insumo-row');
            newRow.innerHTML = `
                <label for="insumo_${insumoIndex}" class="form-label">Insumo</label>
                <select class="form-control" id="insumo_${insumoIndex}" name="insumos[${insumoIndex}][ID_INSUMO_DE]" required>
                    <?php foreach ($insumos as $insumo): ?>
                        <option value="<?= $insumo['ID_INSUMO'] ?>"><?= $insumo['NOMBRE_INSUMO'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="cantidad_${insumoIndex}" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad_${insumoIndex}" name="insumos[${insumoIndex}][CANTIDAD]" required min="1">
            `;
            document.getElementById('insumos-container').appendChild(newRow);
            insumoIndex++;
        });

        // Confirmación antes de cancelar
        document.getElementById('cancelar-btn').addEventListener('click', function () {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Los cambios no se guardarán.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('solicitudes') ?>"; // Redirige a la lista de solicitudes
                }
            });
        });
    </script>
</body>
</html>

<?= $this->endSection() ?>
