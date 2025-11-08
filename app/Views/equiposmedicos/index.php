<!-- app/Views/equiposmedicos/index.php -->

<!-- Visualización de Equipos Médicos Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipo Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #9AB5D9;">

<!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <div class="container mt-5">
        <h1 class="mb-4">Listado de Equipos Médicos</h1>

        <!-- Barra de búsqueda y botón para crear nuevo equipo medico -->
        <div class="mb-4 d-flex justify-content-between">
            <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Equipos Médicos...">
            <a href="<?= base_url('equiposmedicos/create') ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Crear Equipo Médico</a>
        </div>

        <!-- Tabla para visualizar los equipos medicos -->
        <table class="table table-bordered table-light" id="tablaEquiposMedicos">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Número de Serie</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Valor por Hora</th>
                    <th>Vida Útil</th>
                    <th>Fecha de Adquisición</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($equiposmedicos)): ?>
                    <?php foreach ($equiposmedicos as $equipomedico): ?>
                        <tr>
                            <td><?= $equipomedico['ID_EQUIPO_MEDICO'] ?></td>
                            <td><?= $equipomedico['NUM_SERIE_EQUIPO'] ?></td>
                            <td><?= $equipomedico['NOMBRE_EQUIPO'] ?></td>
                            <td><?= $equipomedico['MARCA_EQUIPO'] ?></td>
                            <td><?= number_format($equipomedico['VALOR_HORA']) ?> CLP</td>
                            <td><?= $equipomedico['VIDA_UTIL_EQUIPO'] ?></td>
                            <td><?= $equipomedico['FECHA_ADQUISICION_EQUIPO'] ?></td>
                            <td><?= $equipomedico['ESTADO_EQUIPO'] ?></td>
                            <td><?= $equipomedico['OBSERVACION_EQUIPO'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('equiposmedicos/edit/'.$equipomedico['ID_EQUIPO_MEDICO']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>   <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $equipomedico['ID_EQUIPO_MEDICO'] ?>">
                                    <i class="bi bi-x-circle"></i>   <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No se encontraron equipos médicos</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Script para filtrar equipos medicos en la tabla -->
    <script>
        document.getElementById("buscador").addEventListener("keyup", function() {
            var filtro = this.value.toUpperCase();
            var filas = document.querySelectorAll("#tablaEquiposMedicos tbody tr");

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
                    ¿Estás seguro de que deseas eliminar este equipo médico? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la eliminación de equipo medico -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');

            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;  // Botón que activó el modal
                var equipomedicoId = button.getAttribute('data-id');  // Obtener el ID de el equipo medico
                confirmDeleteButton.href = "<?= base_url('equiposmedicos/delete/') ?>" + equipomedicoId;  // Actualizar el enlace de eliminación
            });
        });
    </script>
</body>
</html>

<?= $this->endSection() ?>
