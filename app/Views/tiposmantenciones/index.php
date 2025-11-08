<!-- app/Views/tiposmantenciones/index.php -->

<!-- Visualización los Tipos de Mantenciones Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>
<body style="background-color: #9AB5D9;">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Mantención</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <div class="container mt-5">
        <h1 class="mb-4">Listado de Tipos de Mantenciones</h1>

        <!-- Barra de búsqueda y botón para crear nuevo tipo de mantención -->
        <div class="mb-4 d-flex justify-content-between">
            <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Tipos de Mantenciones...">
            <a href="<?= base_url('tiposmantenciones/create') ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Crear Tipo de Mantención</a>
        </div>

        <!-- Tabla para visualizar los tipos de mantenciones -->
        <table class="table table-bordered table-light" id="tablaTiposMantenciones">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tiposmantenciones)): ?>
                    <?php foreach ($tiposmantenciones as $tipomantencion): ?>
                        <tr>
                            <td><?= $tipomantencion['ID_TIPO_MANTENCION'] ?></td>
                            <td><?= $tipomantencion['NOMBRE_TIPO_MANTENCION'] ?></td>
                            <td><?= $tipomantencion['ESTADO_TIPO_MANTENCION'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('tiposmantenciones/edit/'.$tipomantencion['ID_TIPO_MANTENCION']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>   <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $tipomantencion['ID_TIPO_MANTENCION'] ?>">
                                    <i class="bi bi-x-circle"></i>   <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron tipos de mantenciones</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Script para filtrar tipos de mantenciones en la tabla -->
    <script>
        document.getElementById("buscador").addEventListener("keyup", function() {
            var filtro = this.value.toUpperCase();
            var filas = document.querySelectorAll("#tablaTiposMantenciones tbody tr");

            filas.forEach(function(fila) {
                var textoFila = fila.innerText.toUpperCase();
                if (textoFila.includes(filtro)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este tipo de mantención? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la eliminación de Tipo de Mantención -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');

            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;  // Botón que activó el modal
                var tipomantencionId = button.getAttribute('data-id');  // Obtener el ID del tipo de mantencion
                confirmDeleteButton.href = "<?= base_url('tiposmantenciones/delete/') ?>" + tipomantencionId;  // Actualizar el enlace de eliminación
            });
        });
    </script>
</body>
</html>

<?= $this->endSection() ?>
