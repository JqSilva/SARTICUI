<?= $this->extend($layout) ?>

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

<body class="tw-min-h-screen tw-bg-[#9ab5d9]">

  <div class="tw-flex tw-flex-col tw-items-center tw-min-h-screen tw-px-6 tw-pt-16 tw-pb-10">

    <!-- Encabezado -->
    <div class="tw-text-center tw-mb-16">
      <h1 class="tw-text-5xl md:tw-text-6xl tw-font-extrabold tw-text-[#0f172a] tw-tracking-tight tw-mb-3">
        Panel de Bodeguero
      </h1>
      <p class="tw-text-2xl tw-font-semibold tw-text-[#334155]">
        Bienvenido, 
        <span class="tw-font-bold tw-text-[#1d4ed8]">
          <?= ucfirst(strtolower(esc(session('nombre')))) ?>.
        </span>
      </p>
      <div class="tw-w-32 tw-h-[4px] tw-bg-[#1d4ed8] tw-rounded-full tw-mx-auto tw-mt-6"></div>
    </div>

    <!-- Grid de tarjetas -->
    <div class="container tw-max-w-6xl">
      <div class="row justify-content-center">
        <?php
        $cards = [
          ['title' => 'Catálogo de Insumos', 'icon' => 'bi-bandaid', 'link' => 'insumos'],
          ['title' => 'Stock Disponible', 'icon' => 'bi-archive', 'link' => 'stock'],
          ['title' => 'Solicitud de Insumos Interna', 'icon' => 'bi-basket', 'link' => 'solicitudes'],
          ['title' => 'Inventario', 'icon' => 'bi-card-checklist', 'link' => 'bodega'],
          ['title' => 'Ingresar Insumos', 'icon' => 'bi-ui-checks-grid', 'link' => 'lotes'],
          ['title' => 'Despacho a Sala', 'icon' => 'bi-arrow-left-right', 'link' => 'insumossalas'],
          ['title' => 'Consumo de Insumos', 'icon' => 'bi-heart-pulse', 'link' => 'usospacientes'],
          ['title' => 'Catálogo del Sistema', 'icon' => 'bi-file-medical', 'link' => 'catalogosistema']
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

</body>

<?= $this->endSection() ?>
