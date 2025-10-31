<!-- app/Views/modules/solicitudes/create.php -->

<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Crear Solicitud</h1>

    <!-- Formulario para crear una nueva solicitud -->
    <form action="<?= base_url('solicitudes/store') ?>" method="POST">
        <div class="parent mb-4">
            <input type="hidden" name="FECHA_SOLICITUD" value="<?= date('Y-m-d H:i:s') ?>">

            <!-- Usuario -->
            <div class="div1">
                <label for="ID_USUARIO_SOLICITUD" class="form-label">Usuario</label>
                <select class="form-control" id="ID_USUARIO_SOLICITUD" name="ID_USUARIO_SOLICITUD" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['ID_USUARIO'] ?>"><?= esc($usuario['NOMBRE_USUARIO']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Sala -->
            <div class="div2">
                <label for="ID_SALA_SOLICITUD" class="form-label">Sala</label>
                <select class="form-control" id="ID_SALA_SOLICITUD" name="ID_SALA_SOLICITUD" required>
                    <?php foreach ($salas as $sala): ?>
                        <option value="<?= $sala['ID_SALA'] ?>"><?= esc($sala['NOMBRE_SALA']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Estado -->
            <div class="div3">
                <label for="ID_ESTADO_SOLICITUD_INS" class="form-label">Estado</label>
                <select class="form-control" id="ID_ESTADO_SOLICITUD_INS" name="ID_ESTADO_SOLICITUD_INS" required>
                    <?php foreach ($estadossolicitudes as $estadosolicitud): ?>
                        <option value="<?= $estadosolicitud['ID_ESTADO_SOLICITUD'] ?>">
                            <?= esc($estadosolicitud['NOMBRE_ESTADO_SOLICITUD']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Insumos -->
        <div id="insumos-container" class="mb-4">
            <div class="mb-3 insumo-row">
                <label for="insumo_1" class="form-label">Insumo</label>
                <select class="form-control" id="insumo_1" name="insumos[0][ID_INSUMO_DE]" required>
                    <?php foreach ($insumos as $insumo): ?>
                        <option value="<?= $insumo['ID_INSUMO'] ?>"><?= esc($insumo['NOMBRE_INSUMO']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="cantidad_1" class="form-label mt-2">Cantidad</label>
                <input type="number" class="form-control" id="cantidad_1" name="insumos[0][CANTIDAD]" required min="1">
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary" id="add-insumo">Agregar Insumo</button>
            <button type="submit" class="btn btn-primary">Crear Solicitud</button>
            <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
            <button type="button" class="btn btn-danger" id="cancelar-btn">Cancelar</button>
        </div>
    </form>
</div>

<!-- Estilos y scripts -->
<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }
    .div1 { grid-column: span 2; }
    .div2 { grid-column: 3; }
    .div3 { grid-column: 4; }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <option value="<?= $insumo['ID_INSUMO'] ?>"><?= esc($insumo['NOMBRE_INSUMO']) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="cantidad_${insumoIndex}" class="form-label mt-2">Cantidad</label>
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
                window.location.href = "<?= base_url('solicitudes') ?>";
            }
        });
    });
</script>

<?= $this->endSection() ?>
