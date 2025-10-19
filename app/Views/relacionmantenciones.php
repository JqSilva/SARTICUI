<!-- app/Views/relacionmantenciones.php -->

<!-- Visualizar lo Relacionado con Mantenciones -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relacionado con Mantenciones</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #9AB5D9;">

<!-- Botón para regresar a la vista anterior -->
<a href="<?= base_url('catalogosistema') ?>" class="btn btn-light">
    <i class="bi bi-arrow-left-circle"></i> Volver
</a>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Relacionado con Mantenciones</h1>
        <div class="row justify-content-center">
            <!-- Tarjeta de Equipos Médicos -->
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Equipos Médicos</h5>
                        <p class="card-text">Gestionar los equipos médicos registrados.</p>
                        <a href="<?= base_url('equiposmedicos') ?>" class="btn btn-primary">Ir a Equipos</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Tipo de Mantenciones -->
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Tipo de Mantención</h5>
                        <p class="card-text">Gestionar los tipos de mantenciones registradas.</p>
                        <a href="<?= base_url('tiposmantenciones') ?>" class="btn btn-primary">Ir a Tipo de Mantención</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Mantenciones de Equipos -->
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Mantención de Equipo</h5>
                        <p class="card-text">Gestionar las mantenciones de equipos registrados.</p>
                        <a href="<?= base_url('mantencionesequipos') ?>" class="btn btn-primary">Ir a Mantenciones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
