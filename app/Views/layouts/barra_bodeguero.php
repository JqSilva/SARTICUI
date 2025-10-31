<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/tw.css') ?>" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
        /* Estilo personalizado para los botones */
        .btn-custom {
            background-color: white !important;
            color: #6C87D9 !important;
            border: 2px solid #6C87D9 !important;
            border-radius: 10px;
            font-weight: 600 !important;
            transition: all 0.3s ease;
            text-align: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .btn-custom:hover {
            background-color: #6C87D9 !important;
            color: white !important;
        }

        /* Ajustes para la barra lateral */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background: #f8f9fa;
            padding: 15px;
            overflow-y: auto;
            transition: all 0.3s;
        }

        /* Ajuste para el contenido cuando la barra lateral está visible */
        .content-wrapper {
            margin-left: 250px;
            transition: margin-left 0.3s;
        }

        /* Ocultar barra lateral en dispositivos pequeños */
        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                left: -250px;
            }
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Botón de menú para pantallas pequeñas -->
    <nav class="navbar navbar-light bg-light d-lg-none">
        <button class="btn btn-custom ms-3" id="sidebarToggle">
            <i class="bi bi-list"></i> Menú
        </button>
    </nav>

    <div class="d-flex">
        <!-- Barra lateral -->
        <nav class="sidebar" id="sidebar">
            <div class="text-center mb-3">
                <a href="<?= base_url('/') ?>">
                    <img src="https://vao.cl/wp-content/uploads/2018/07/hospital.png" alt="Inicio" class="img-fluid">
                </a>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('/bodeguero') ?>'">🏠 Inicio</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('insumos') ?>'">📦 Catálogo de Insumos</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('solicitudes') ?>'">📝 Solicitud de Insumos Interna</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('bodega') ?>'">📁 Inventario</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('lotes') ?>'">📥 Ingresar Insumos</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('insumossalas') ?>'">🏥 Despacho a Sala</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('catalogosistema') ?>'">⚙️ Generar Maestro</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-custom w-100 mb-2" onclick="window.location.href='<?= base_url('logout') ?>'">Cerrar sesión</button>
                </li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <main class="content-wrapper w-100">
            <div class="container-fluid py-3">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <script>
        // Script para mostrar y ocultar el menú lateral en móviles
        document.getElementById("sidebarToggle").addEventListener("click", function () {
            let sidebar = document.getElementById("sidebar");
            let contentWrapper = document.querySelector(".content-wrapper");

            if (sidebar.style.left === "-250px" || sidebar.style.left === "") {
                sidebar.style.left = "0";
                contentWrapper.style.marginLeft = "250px";
            } else {
                sidebar.style.left = "-250px";
                contentWrapper.style.marginLeft = "0";
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
