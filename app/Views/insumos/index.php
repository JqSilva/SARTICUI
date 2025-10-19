<!-- app/Views/insumos/index.php -->

<!-- Visualización de Insumos Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <a href="<?= base_url('relacioninsumos') ?>" class="btn btn-light">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </a>

    <h1 class="text-center mb-4 text-dark">Catálogo de Insumos</h1>

    <!-- Barra de búsqueda y botón para crear nuevo insumo -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Insumos...">
        <a href="<?= base_url('insumos/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Insumo
        </a>
    </div>

    <!-- Tabla para visualizar los insumos -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaInsumos">
            <thead class="table-dark text-light">
                <tr>
                    <th>Código ABAS</th>
                    <th>Nombre</th>
                    <th>Clasificación</th>
                    <th>Disponibilidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($insumos)): ?>
                    <?php foreach ($insumos as $insumo): ?>
                        <tr>
                            <td><?= $insumo['CODIGO_ABAS_INSUMO'] ?></td>
                            <td><?= $insumo['NOMBRE_INSUMO'] ?></td>
                            <td><?= $insumo['CLASIFICACION_NOMBRE'] ?></td>
                            <td><?= $insumo['DISPONIBILIDAD_NOMBRE'] ?></td>
                            <td><?= $insumo['ESTADO_INSUMO'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('insumos/edit/'.$insumo['ID_INSUMO']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $insumo['ID_INSUMO'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron insumos</td>
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
                ¿Estás seguro de que deseas eliminar este insumo? Esta acción no se puede deshacer.
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

    //Filtrar Insumos en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaInsumos tbody tr");

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Manejo de la eliminación de Insumo
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var insumoId = button.getAttribute('data-id');  // Obtener el ID del insumo
            confirmDeleteButton.href = "<?= base_url('insumos/delete/') ?>" + insumoId;  // Actualizar el enlace de eliminación
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
