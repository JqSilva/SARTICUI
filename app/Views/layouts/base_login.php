<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title><?= esc($title ?? 'Prueba Login') ?></title>
  <link href="<?= base_url('assets/css/tw.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .eye-icon { transition: transform .2s ease, opacity .2s ease; }
    .eye-icon:hover { transform: scale(1.1); opacity: .8; }
  </style>
  <?= $this->renderSection('head') ?>
</head>
<body class="tw-min-h-screen tw-flex tw-items-center tw-justify-center tw-bg-[#9ab5d9]">
  <?= $this->renderSection('content') ?>
  <?= $this->renderSection('scripts') ?>
</body>
</html>
