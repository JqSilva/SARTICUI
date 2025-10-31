<!-- app/Views/modules/solicitudes/edit.php -->

<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Solicitud</h1>

    <!-- Formulario para actualizar una solicitud existente -->
    <form action="<?= base_url('solicitudes/update/' . $solicitud['ID_SOLICITUD']) ?>" method="POST">
        <div class="parent mb-4">
            <!-- Usuario -->
            <div class="div1">
                <label for="ID_USUARIO_SOLICITUD" class="form-label">Usuario</label>
                <select class="form-control" id="ID_USUARIO_SOLICITUD" name="ID_USUARIO_SOLICITUD" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['ID_USUARIO'] ?>"
                            <?= $solicitud['ID_USUARIO_SOLICITUD'] == $usuario['ID_USUARIO'] ? 'selected' : '' ?>>
                            <?= esc($usuario['NOMBRE_USUARIO']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Sala -->
            <div class="div2">
                <label for="ID_SALA_SOLICITUD" class="form-label">Sala</label>
                <select class="form-control" id="ID_SALA_SOLICITUD" name="ID_SALA_SOLICITUD" required>
                    <?php foreach ($salas as $sala): ?>
                        <option value="<?= $sala['ID_SALA'] ?>"
                            <?= $solicitud['ID_SALA_SOLICITUD'] == $sala['ID_SALA'] ? 'selected' : '' ?>>
                            <?= esc($sala['NOMBRE_SALA']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Estado -->
        <div class="mb-4">
            <label for="ID_ESTADO_SOLICITUD_INS" class="form-label">Estado de la Solicitud</label>
            <select class="form-control" id="ID_ESTADO_SOLICITUD_INS" name="ID_ESTADO_SOLICITUD_INS" required>
                <?php foreach ($estadossolicitudes as $estadosolicitud): ?>
                    <option value="<?= $estadosolicitud['ID_ESTADO_SOLICITUD'] ?>"
                        <?= $solicitud['ID_ESTADO_SOLICITUD_INS'] == $estadosolicitud['ID_ESTADO_SOLICITUD'] ? 'selected' : '' ?>>
                        <?= esc($estadosolicitud['NOMBRE_ESTADO_SOLICITUD']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Botones -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
            <button type="button" class="btn btn-danger" id="cancelar-btn">Cancelar</button>
        </div>
    </form>
</div>

<!-- Estilos -->
<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }
    .div1 {
        grid-column: span 2;
    }
    .div2 {
        grid-column: span 2;
        grid-column-start: 3;
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Confirmación antes de cancelar
    document.getElementById('cancelar-btn').addEventListener('click', function () {
        Swal.fire({
            title: "¿Cancelar cambios?",
            text: "Los datos modificados no se guardarán.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, salir",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('solicitudes') ?>";
            }
        });
    });
</script>

<?= $this->endSection() ?>
