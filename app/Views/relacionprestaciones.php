<!-- app/Views/relacionmantenciones.php -->

<!-- Visualizar lo Relacionado con Prestaciones -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relacionado con Prestaciones</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #9AB5D9;">

<!-- Botón para regresar a la vista anterior -->
<a href="<?= base_url('catalogosistema') ?>" class="btn btn-light">
    <i class="bi bi-arrow-left-circle"></i> Volver
</a>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Relacionado con Prestaciones</h1>
        <div class="row justify-content-center">
            <!-- Tarjeta de Procedimientos -->
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Procedimiento</h5>
                        <p class="card-text">Gestionar los procedimientos registrados.</p>
                        <a href="<?= base_url('procedimientos') ?>" class="btn btn-primary">Ir a Procedimiento</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Condición del Paciente -->
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Condición del Paciente</h5>
                        <p class="card-text">Gestionar las condiciones de pacientes registradas.</p>
                        <a href="<?= base_url('condicionespacientes') ?>" class="btn btn-primary">Ir a Condición</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Prestación -->
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Prestación</h5>
                        <p class="card-text">Gestionar las prestaciones registradas.</p>
                        <a href="<?= base_url('prestaciones') ?>" class="btn btn-primary">Ir a Prestaciones</a>
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
