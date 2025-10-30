<?= $this->extend('layouts/barra_bodeguero') ?>

<?= $this->section('content') ?>

<style>
    .custom-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
        height: 180px; /* Altura fija para todas las tarjetas */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        background-color: #e0e7ff;
    }

    .custom-card i {
        color: #4a69bd;
        font-size: 2rem;
        transition: color 0.2s ease;
    }

    .custom-card:hover i {
        color: #1e3799;
    }

    .custom-container {
        max-width: 1200px;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .card-title {
        font-size: 1rem; /* Tamaño uniforme para los títulos */
        margin-top: 8px;
    }
</style>

<body style="background-color: #9AB5D9;">
<p>Bienvenido, <?= esc(session('nombre')) ?>.</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2"></div>

        <div class="container mt-4 page-background custom-container">
            <h1 class="text-center mb-4">vista perfil bodeguero</h1>
            <div class="row justify-content-center">
                <?php
                $cards = [
                    ['title' => 'Catálogo de Insumos', 'icon' => 'bi-bandaid', 'link' => 'bodeguero/insumos'],
                    //['title' => 'Stock Disponible', 'icon' => 'bi-archive', 'link' => 'stock'],
                    ['title' => 'Solicitud de Insumos Interna', 'icon' => 'bi-basket', 'link' => 'bodeguero/solicitudes'],
                    ['title' => 'Inventario', 'icon' => 'bi-card-checklist', 'link' => 'bodeguero/bodega'],
                    ['title' => 'Ingresar Insumos', 'icon' => 'bi-ui-checks-grid', 'link' => 'bodeguero/lotes'],
                    ['title' => 'Despacho a Sala', 'icon' => 'bi-arrow-left-right', 'link' => 'bodeguero/insumossalas'],
                    ['title' => 'Generar Maestro', 'icon' => 'bi-arrow-left-right', 'link' => 'bodeguero/perfiles']

                    //['title' => 'Consumo de Insumos', 'icon' => 'bi-heart-pulse', 'link' => 'usospacientes'],
                    //['title' => 'Catálogo del Sistema', 'icon' => 'bi-file-medical', 'link' => 'catalogosistema']
                ];
                ?>

                <?php foreach ($cards as $card): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <a href="<?= base_url($card['link']) ?>" class="text-decoration-none">
                            <div class="card text-center shadow custom-card">
                                <div class="card-body">
                                    <i class="bi <?= $card['icon'] ?>"></i>
                                    <h5 class="card-title"><?= $card['title'] ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>

<?= $this->endSection() ?>
<a href="<?= base_url('logout') ?>" class="tw-text-red-500">Cerrar sesión</a>