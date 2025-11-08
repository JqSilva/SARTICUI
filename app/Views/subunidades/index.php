<!-- app/Views/subunidades/index.php -->

<!-- Visualización de SubUnidades Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Listado de Subunidades</h1>

    <!-- Barra de búsqueda y botón para crear nueva subunidad -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar SubUnidad...">
        <a href="<?= base_url('subunidades/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear SubUnidad
        </a>
    </div>

    <!-- Tabla para visualizar las subunidades -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaSubunidad">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($subunidades)): ?>
                    <?php foreach ($subunidades as $subunidad): ?>
                        <tr>
                            <td><?= $subunidad['ID_SUBUNIDAD'] ?></td>
                            <td><?= $subunidad['NOMBRE_SUBUNIDAD'] ?></td>
                            <td><?= $subunidad['RESPONSABLE_SUBUNIDAD'] ?></td>
                            <td><?= $subunidad['ESTADO_SUBUNIDAD'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('subunidades/edit/'.$subunidad['ID_SUBUNIDAD']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $subunidad['ID_SUBUNIDAD'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron subunidades</td>
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
                ¿Estás seguro de que deseas eliminar esta subunidad? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>

    // Filtrar Subunidades en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaSubunidad tbody tr");

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Manejo de la eliminación de Subunidades
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var subunidadId = button.getAttribute('data-id');  // Obtener el ID de la subunidad
            confirmDeleteButton.href = "<?= base_url('subunidades/delete/') ?>" + subunidadId;  // Actualizar el enlace de eliminación
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
