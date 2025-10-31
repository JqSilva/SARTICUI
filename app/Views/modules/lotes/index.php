<!-- app/Views/lotes/index.php -->

<!-- Visualizar los Lotes existentes -->

<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <a href="<?= base_url('relacionlotes') ?>" class="btn btn-light">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </a>

    <h1 class="text-center mb-4 text-dark">Ingreso de Insumos</h1>

    <!-- Filtro de ordenación por fecha de vencimiento -->
    <form method="GET" action="<?= base_url('lotes') ?>" class="mb-3 d-flex align-items-center">
        <label for="orden" class="form-label">Ordenar por fecha de vencimiento:</label>
        <select name="orden" id="orden" class="form-select w-auto me-2">
            <option value="asc" <?= ($orden == 'asc') ? 'selected' : '' ?>>Más Próxima</option>
            <option value="desc" <?= ($orden == 'desc') ? 'selected' : '' ?>>Más Lejana</option>
        </select>
        <button type="submit" class="btn btn-danger">Aplicar</button>
    </form>

    <!-- Botón para crear nuevo lote -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="<?= base_url('lotes/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Lote
        </a>
    </div>

    <!-- Tabla para visualizar los lotes -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered text-center align-middle">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID Lote</th>
                    <th>Marca</th>
                    <th>Código de Barras</th>
                    <th>Unidad</th>
                    <th>Cantidad Total</th>
                    <th>Costo Unitario</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Insumo</th>
                    <th>Proveedor</th>
                    <th>Procedencia</th>
                    <th>Tipo de Compra</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($lotes)): ?>
                    <?php foreach ($lotes as $lote): ?>
                        <tr>
                            <td><?= esc($lote['ID_LOTE']) ?></td>
                            <td><?= esc($lote['MARCA_LOTE']) ?></td>
                            <td><?= esc($lote['CODIGO_PRODUCTO_LOTE']) ?></td>
                            <td><?= esc($lote['UNIDAD_ABAS_LOTE']) ?></td>
                            <td><?= esc($lote['CANTIDAD_TOTAL_LOTE']) ?></td>
                            <td><?= number_format(esc($lote['COSTO_UNITARIO_LOTE'])) ?> CLP</td>
                            <td><?= date('d/m/Y', strtotime($lote['FECHA_VENCIMIENTO'])) ?></td>
                            <td><?= esc($lote['INSUMO_NOMBRE']) ?></td>
                            <td><?= esc($lote['PROVEEDOR_NOMBRE']) ?></td>
                            <td><?= esc($lote['PROCEDENCIA_NOMBRE']) ?></td>
                            <td><?= esc($lote['TIPO_COMPRA_NOMBRE']) ?></td>
                            <td><?= esc($lote['OBSERVACION_LOTE']) ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('lotes/edit/'.$lote['ID_LOTE']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $lote['ID_LOTE'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="13" class="text-center">No se encontraron lotes</td>
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
                ¿Estás seguro de que deseas eliminar este lote? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar la eliminación de lotes -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var loteId = button.getAttribute('data-id');  // Obtener el ID del lote
            confirmDeleteButton.href = "<?= base_url('lotes/delete/') ?>" + loteId;  // Actualizar el enlace de eliminación
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
