# Sistema de Gestión de Insumos

El Software debe permitir gestionar el inventario de insumos, registrar la entrada y salida de insumos, asociar insumos utilizados a pacientes específicos, vencimiento de insumos, proveedores de insumos y registro de licitaciones. 

## 🚀 Características

- ✅ Control de Acceso. 
- ✅ Catálogo de Insumos.
- ✅ Stock Disponible.
- ✅ Solicitud de Insumos.
- ✅ Inventario.
- ✅ Ingresar Insumos.
- ✅ Movimiento a Sala.
- ✅ Consumo de Insumos.
- ✅ Catálogo del Sistema.

## 🛠️ Tecnologías Utilizadas
- 🖥️ Bootstrap.
- 🔧 CodeIgniter4.
- 🗄️ MySQL.

## 📦 Instalación
### 🔹 Intalación del XAMPP

Para ejecutar el sistema en un entorno local, se recomienda instalar XAMPP siguiendo estos pasos:

1. Descargar XAMPP:
- Dirígete a la página oficial de XAMPP y descarga la versión compatible con tu sistema operativo.

2. Instalar XAMPP:
- Ejecuta el instalador y sigue las instrucciones.
- Asegúrate de seleccionar Apache, MySQL y phpMyAdmin durante la instalación.

3. Iniciar los servicios:
- Abre el Panel de Control de XAMPP.
- Inicia los módulos Apache y MySQL.

### 🔹 Configuración de la Base de Datos

Para ejecutar la base de datos del sistema, sigue estos pasos:

1. Abrir phpMyAdmin:
- En el navegador, accede a http://localhost/phpmyadmin/.

2. Crear la base de datos:
- Haz clic en Nueva en el panel izquierdo.
- Introduce el nombre de la base de datos: inventario_hrt.
- Selecciona la codificación utf8_general_ci y haz clic en Crear.

3. Importar la base de datos:
- En phpMyAdmin, selecciona la base de datos inventario_hrt.
- Ve a la pestaña Importar y selecciona el archivo SQL de la base de datos.
- Haz clic en Continuar para ejecutar la importación.

### 🔹Ejecución del Sistema

1. Descargar o Clonar el repositorio

2. Mover los archivos a la carpeta de XAMPP:
- Copia el proyecto a C:\xampp\htdocs\proyecto (en Windows) o la carpeta correspondiente en Linux/Mac.

3. Configurar el entorno:
- Renombra el archivo .env.example a .env y edítalo para configurar la conexión a la base de datos:
        "database.default.hostname = localhost
        database.default.database = inventario_hrt
        database.default.username = root
        database.default.password =
        database.default.DBDriver = MySQLi"

4. Iniciar el servidor de CodeIgniter:
- "php spark serve"
- Luego, accede a http://localhost:8080/ en tu navegador para utilizar el sistema.



