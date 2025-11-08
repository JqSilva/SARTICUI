<!-- app/Views/clasificaciones/index.php -->

<!-- Visualización de Clasificaciones Existentes -->

<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Listado de Clasificaciones</h1>

    <!-- Barra de búsqueda y botón para crear nueva clasificación -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Clasificaciones...">
        <a href="<?= base_url('clasificaciones/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Clasificación
        </a>
    </div>

    <!-- Tabla para visualizar las clasificaciones -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaClasificaciones">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Días de Post-Apertura</th>
                    <th>Contenido Base</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($clasificaciones)): ?>
                    <?php foreach ($clasificaciones as $clasificacion): ?>
                        <tr>
                            <td><?= esc($clasificacion['ID_CLASIFICACION']) ?></td>
                            <td><?= esc($clasificacion['NOMBRE_CLASIFICACION']) ?></td>
                            <td><?= esc($clasificacion['DIAS_ABERTURA_CLASIFICACION']) ?></td>
                            <td><?= esc($clasificacion['UNIDAD_CONTENIDO_CLASIFICACION']) ?></td>
                            <td><?= esc($clasificacion['ESTADO_CLASIFICACION']) ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('clasificaciones/edit/'.$clasificacion['ID_CLASIFICACION']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $clasificacion['ID_CLASIFICACION'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No se encontraron clasificaciones</td>
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
                ¿Estás seguro de que deseas eliminar esta clasificación? Esta acción no se puede deshacer.
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

    // Filtrar Clasificaciones en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        let filtro = this.value.toUpperCase();
        let filas = document.querySelectorAll("#tablaClasificaciones tbody tr");

        filas.forEach(fila => {
            fila.style.display = fila.innerText.toUpperCase().includes(filtro) ? "" : "none";
        });
    });


    // Manejo de la eliminación de Clasificaciones
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var clasificacionId = button.getAttribute('data-id');  // Obtener el ID de la clasificacion
            confirmDeleteButton.href = "<?= base_url('clasificaciones/delete/') ?>" + clasificacionId;  // Actualizar el enlace de eliminación
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
