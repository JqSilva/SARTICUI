<!-- app/Views/insumossalas/index.php -->

<!-- Visualización de Insumos en Sala Existentes -->

<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <h1 class="text-center mb-4 text-dark">Despacho a Sala</h1>

    <!-- Barra de búsqueda y botón para crear nuevo Insumo en Sala -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Movimiento...">
        <a href="<?= base_url('insumossalas/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Despacho
        </a>
    </div>

    <!-- Tabla para visualizar los Insumos en Sala -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaInsumoSala">
            <thead class="table-dark text-light">
                <tr>
                    <th>Cantidad a Sala</th>
                    <th>Insumo</th>
                    <th>Lote</th>
                    <th>Sala</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($insumossalas)): ?>
                    <?php foreach ($insumossalas as $insumosala): ?>
                        <tr>
                            <td><?= $insumosala['CANTIDAD_INSUMO_SALA'] ?></td>
                            <td><?= $insumosala['NOMBRE_INSUMO'] ?? 'No disponible'?></td>
                            <td><?= $insumosala['ID_LOTE_INSUMO_SALA'] ?></td>
                            <td><?= $insumosala['SALA_NOMBRE'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('insumossalas/edit/'.$insumosala['ID_INSUMO_SALA']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $insumosala['ID_INSUMO_SALA'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron movimientos</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Aviso de Cantidad Superada del Lote -->
        <?php if (session()->getFlashdata('error')): ?>
            <div id="error-message" class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('error-message').style.display = 'none';
                }, 3000); // Oculta el mensaje después de 3 segundos
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('message')): ?>
            <div id="success-message" class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 3000); // Oculta el mensaje después de 3 segundos
            </script>
        <?php endif; ?>
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
                ¿Estás seguro de que deseas eliminar este movimiento? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>

    // Filtrar Insumo en Sala en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaInsumoSala tbody tr");

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Manejo la eliminación de Insumos en Sala
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var insumosalaId = button.getAttribute('data-id');  // Obtener el ID del Movimiento
            confirmDeleteButton.href = "<?= base_url('insumossalas/delete/') ?>" + insumosalaId;  // Actualizar el enlace de eliminación
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
