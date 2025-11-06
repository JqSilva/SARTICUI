<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acceso no autorizado</title>
  <link href="<?= base_url('assets/css/tw.css') ?>" rel="stylesheet">
</head>
<body class="tw-bg-[#9ab5d9] tw-h-screen tw-flex tw-items-center tw-justify-center">
  <div class="tw-bg-white tw-rounded-2xl tw-shadow-lg tw-flex tw-flex-col tw-p-10 tw-text-center tw-gap-6">
    <h1 class="tw-text-3xl tw-font-bold tw-text-red-600 mb-3">Acceso denegado</h1>
    <p class="tw-text-slate-600 tw-text-lg">No tienes permiso para acceder a esta página.</p>

    <div class="tw-flex tw-justify-center tw-items-center tw-bg-white">
      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="2.75" r="2.25"/><circle cx="10.25" cy="10.25" r="3.25"/><path d="m7.95 12.55l4.6-4.6M6 6.61A4.49 4.49 0 0 0 .5 11v1.5h4"/></g></svg>
    </div>
    <a href="<?= base_url('/') ?>" class="tw-inline-block tw-mt-4 tw-px-6 tw-py-2 tw-bg-[#0f398b] tw-text-white tw-rounded-lg hover:tw-bg-[#1347ae] tw-transition-colors">
      Volver al inicio    
    </a>

  </div>
</body>
</html>