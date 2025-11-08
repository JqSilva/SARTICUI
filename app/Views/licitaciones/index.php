<!-- app/Views/licitaciones/index.php -->

<!-- Visualización de Licitaciones existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

<!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Listado de Licitaciones</h1>

    <!-- Barra de búsqueda y botón para crear nueva licitacion -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Licitaciones...">
        <a href="<?= base_url('licitaciones/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Licitación
        </a>
    </div>

    <!-- Tabla para visualizar las licitaciones -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaLicitaciones">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID Público</th>
                    <th>Nombre</th>
                    <th>Resolución Exenta</th>
                    <th>Referencia</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Monto</th>
                    <th>Proveedor</th>
                    <th>Insumo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($licitaciones)): ?>
                    <?php foreach ($licitaciones as $licitacion): ?>
                        <tr>
                            <td><?= $licitacion['ID_PUBLICO_LICITACION'] ?></td>
                            <td><?= $licitacion['NOMBRE_LICITACION'] ?></td>
                            <td><?= $licitacion['RESOLUCION_EXENTA'] ?></td>
                            <td><?= $licitacion['REFERENCIA'] ?></td>
                            <td><?= date('d/m/Y', strtotime($licitacion['FECHA_INICIO'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($licitacion['FECHA_FIN'])) ?></td>
                            <td><?= number_format($licitacion['MONTO_LICITADO'], 2) ?> CLP</td>
                            <td><?= $licitacion['PROVEEDOR_NOMBRE'] ?></td>
                            <td><?= $licitacion['INSUMO_NOMBRE'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('licitaciones/edit/'.$licitacion['ID_LICITACION']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar   <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $licitacion['ID_LICITACION'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">No se encontraron licitaciones</td>
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
                ¿Estás seguro de que deseas eliminar esta licitación? Esta acción no se puede deshacer.
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

    // Filtrar Licitaciones en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaLicitaciones tbody tr");

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Manejo de la eliminación de Licitaciones
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var licitacionId = button.getAttribute('data-id');  // Obtener el ID de la licitacion
            confirmDeleteButton.href = "<?= base_url('licitaciones/delete/') ?>" + licitacionId;  // Actualizar el enlace de eliminación
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
