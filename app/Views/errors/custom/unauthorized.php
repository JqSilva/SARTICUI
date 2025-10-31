<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acceso no autorizado</title>
  <link href="<?= base_url('assets/css/tw.css') ?>" rel="stylesheet">
</head>
<body class="tw-bg-gray-100 tw-h-screen tw-flex tw-items-center tw-justify-center">
  <div class="tw-bg-white tw-rounded-2xl tw-shadow-lg tw-p-10 tw-text-center">
    <h1 class="tw-text-3xl tw-font-bold tw-text-red-600 mb-3">🚫 Acceso denegado</h1>
    <p class="tw-text-gray-700 mb-6">No tienes permisos para acceder a esta sección.</p>
    <a href="<?= base_url('/') ?>" class="tw-bg-[#0f398b] tw-text-white tw-py-2 tw-px-4 tw-rounded">Volver al inicio</a>
  </div>
</body>
</html>