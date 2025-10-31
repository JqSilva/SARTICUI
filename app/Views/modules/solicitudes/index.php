<!-- app/Views/solicitudes/index.php -->

<!-- Visualización de Solicitudes Existentes -->

<?= $this->extend($layout) ?>


<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <a href="<?= base_url('relacionsolicitudes') ?>" class="btn btn-light">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </a>

    <h1 class="text-center mb-4 text-dark">Solicitud de Insumos Interna</h1>

    <?php
    // Definición de los nombres de los meses en español
    $meses_es = [
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
        5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
        9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    ];
    ?>

    <!-- Formulario para filtrar solicitudes por mes y año -->
    <form method="GET" action="<?= base_url('solicitudes') ?>" class="mb-4">
        <div class="row">
            <!-- Selector de mes -->
            <div class="col-md-3">
                <label for="mes" class="form-label">Filtrar por mes:</label>
                <select name="mes" id="mes" class="form-select">
                    <option value="">Todos</option>
                    <?php foreach ($meses_es as $num => $nombre): ?>
                        <option value="<?= $num ?>" <?= ($mes == $num) ? 'selected' : '' ?>><?= $nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Selector de año -->
            <div class="col-md-3">
                <label for="anio" class="form-label">Filtrar por año:</label>
                <select name="anio" id="anio" class="form-select">
                    <option value="">Todos</option>
                    <?php
                    $año_actual = date("Y");
                    for ($i = $año_actual; $i >= ($año_actual - 5); $i--): ?>
                        <option value="<?= $i ?>" <?= ($anio == $i) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Botones para aplicar o limpiar filtros -->
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-secondary me-2">Aplicar Filtro</button>
                <a href="<?= base_url('solicitudes') ?>" class="btn btn-light">Limpiar</a>
            </div>
        </div>
    </form>

    <div class="mb-4">
        <a href="<?= base_url('solicitudes/create') ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Crear Solicitud</a>
    </div>

    <!-- Tabla para visualizar las solicitudes -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark text-light">
                <tr>
                    <th>Fecha de Solicitud</th>
                    <th>Usuario</th>
                    <th>Sala</th>
                    <th>Estado</th>
                    <th>Insumos y Cantidades</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($solicitudes)): ?>
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <tr>
                            <td><?= $solicitud['FECHA_SOLICITUD'] ?></td>
                            <td><?= $solicitud['USUARIO_NOMBRE'] ?></td>
                            <td><?= $solicitud['SALA_NOMBRE'] ?></td>
                            <td><?= $solicitud['ESTADO_SOLICITUD_NOMBRE'] ?></td>
                            <td>
                                <?php if (!empty($solicitud['DETALLES'])): ?>
                                    <ul>
                                        <?php foreach ($solicitud['DETALLES'] as $detalle): ?>
                                            <li>
                                                <?= $detalle['CANTIDAD'] ?> x <?= $detalle['NOMBRE_INSUMO'] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span>No hay insumos</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('solicitudes/edit/'.$solicitud['ID_SOLICITUD']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $solicitud['ID_SOLICITUD'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron solicitudes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta solicitud? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar la eliminación de Solicitudes -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var solicitudId = button.getAttribute('data-id');  // Obtener el ID de la solicitud
            confirmDeleteButton.href = "<?= base_url('solicitudes/delete/') ?>" + solicitudId;  // Actualizar el enlace de eliminación
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-color: #9AB5D9;
    }

    .table th {
        background-color: #343a40 !important;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-outline-secondary {
        border-radius: 8px;
    }

    .modal-content {
        border-radius: 8px;
    }
</style>

<?= $this->endSection() ?>
