<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SolicitudModel;
use App\Models\UsuarioModel;
use App\Models\SalaModel;
use App\Models\EstadoSolicitudModel;
use App\Models\DetalleSolicitudModel;
use App\Models\InsumoModel;

// Controlador de Solicitud

class SolicitudController extends ResourceController
{
    protected $modelName = 'App\Models\SolicitudModel';
    protected $format = 'json';

    // GET /solicitudes - Obtener todas las solicitudes con filtro opcional por mes y año
    public function index()
    {
        $solicitudModel = new SolicitudModel();

        // Obtener los parámetros del filtro
        $mes = $this->request->getGet('mes');
        $anio = $this->request->getGet('anio');

        // Construcción de la consulta con filtros
        $query = $solicitudModel->select('*');

        if (!empty($mes)) {
            $query->where('MONTH(FECHA_SOLICITUD)', $mes);
        }

        if (!empty($anio)) {
            $query->where('YEAR(FECHA_SOLICITUD)', $anio);
        }

        // Obtener solicitudes filtradas
        $solicitudes = $query->findAll();

        // Modelos para obtener información relacionada
        $usuarioModel = new UsuarioModel();
        $salaModel = new SalaModel();
        $estadosolicitudModel = new EstadoSolicitudModel();
        $detalleSolicitudModel = new DetalleSolicitudModel();
        $insumoModel = new InsumoModel();

        $usuarios = $usuarioModel->findAll();
        $salas = $salaModel->findAll();
        $estadossolicitudes = $estadosolicitudModel->findAll();

        foreach ($solicitudes as &$solicitud) {
            // Obtener nombres de usuario, sala y estado
            foreach ($usuarios as $usuario) {
                if ($solicitud['ID_USUARIO_SOLICITUD'] == $usuario['ID_USUARIO']) {
                    $solicitud['USUARIO_NOMBRE'] = $usuario['NOMBRE_USUARIO'];
                    break;
                }
            }

            foreach ($salas as $sala) {
                if ($solicitud['ID_SALA_SOLICITUD'] == $sala['ID_SALA']) {
                    $solicitud['SALA_NOMBRE'] = $sala['NOMBRE_SALA'];
                    break;
                }
            }

            foreach ($estadossolicitudes as $estadosolicitud) {
                if ($solicitud['ID_ESTADO_SOLICITUD_INS'] == $estadosolicitud['ID_ESTADO_SOLICITUD']) {
                    $solicitud['ESTADO_SOLICITUD_NOMBRE'] = $estadosolicitud['NOMBRE_ESTADO_SOLICITUD'];
                    break;
                }
            }

            // Obtener detalles de la solicitud
            $detalles = $detalleSolicitudModel->where('ID_SOLICITUD_DE', $solicitud['ID_SOLICITUD'])->findAll();

            // Agregar nombres de insumos
            foreach ($detalles as &$detalle) {
                $insumo = $insumoModel->find($detalle['ID_INSUMO_DE']);
                $detalle['NOMBRE_INSUMO'] = $insumo ? $insumo['NOMBRE_INSUMO'] : 'Desconocido';
            }

            $solicitud['DETALLES'] = $detalles;
        }

        // Pasar los datos a la vista
        return view('solicitudes/index', [
            'solicitudes' => $solicitudes,
            'usuarios' => $usuarios,
            'salas' => $salas,
            'estadossolicitudes' => $estadossolicitudes,
            'mes' => $mes,  // Para que el formulario recuerde la selección
            'anio' => $anio
        ]);
    }

    // GET /solicitudes/create - Mostrar el formulario para crear una solicitud
    public function create()
    {
        // Obtener datos de las tablas usuarios, salas y estado solicitud
        $usuarioModel = new UsuarioModel();
        $salaModel = new SalaModel();
        $estadosolicitudModel = new EstadoSolicitudModel();
        $insumoModel = new InsumoModel();

        $usuarios = $usuarioModel->findAll();
        $salas = $salaModel->findAll();
        $estadossolicitudes = $estadosolicitudModel->findAll();
        $insumos = $insumoModel->findAll();

        // Pasar los datos a la vista
        return view('solicitudes/create', [
            'usuarios' => $usuarios,
            'salas' => $salas,
            'estadossolicitudes' => $estadossolicitudes,
            'insumos' => $insumos
        ]);
    }

    // POST /solicitudes - Crear una nueva solicitud
    public function store()
    {
        $data = $this->request->getPost();

        // Validar los datos antes de insertarlos
        // Crear los datos para la tabla SOLICITUD
        $solicitudData = [
            'ID_USUARIO_SOLICITUD' => $data['ID_USUARIO_SOLICITUD'],
            'ID_SALA_SOLICITUD' => $data['ID_SALA_SOLICITUD'],
            'ID_ESTADO_SOLICITUD_INS' => $data['ID_ESTADO_SOLICITUD_INS']
        ];

        // Insertar la solicitud
        if ($this->model->insert($solicitudData)) {
            // Obtener el ID de la solicitud recién insertada
            $solicitudId = $this->model->getInsertID();

            // Ahora manejar los detalles (insumos y cantidades)
            $detalleSolicitudModel = new DetalleSolicitudModel();
            $insumos = $data['insumos'];  // Suponiendo que 'insumos' es un array de insumos con sus cantidades

            // Preparar los datos para la tabla DETALLE_SOLICITUD
            $detalleData = [];
            foreach ($insumos as $insumo) {
                $detalleData[] = [
                    'ID_SOLICITUD_DE' => $solicitudId,
                    'ID_INSUMO_DE' => $insumo['ID_INSUMO_DE'],
                    'CANTIDAD' => $insumo['CANTIDAD'],
                ];
            }

            // Insertar los detalles de los insumos
            if ($detalleSolicitudModel->insertBatch($detalleData)) {
                // Redirigir con un mensaje de éxito
                return redirect()->to(base_url('/solicitudes'))->with('message', 'Solicitud creada exitosamente');
            } else {
                // Si ocurre un error con los detalles
                return redirect()->back()->withInput()->with('errors', $detalleSolicitudModel->errors());
            }
        }

        // Si ocurre un error con la solicitud principal
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /solicitudes/edit/{id} - Mostrar el formulario para editar una solicitud
    public function edit($id = null)
    {
        $solicitud = $this->model->find($id);

        if ($solicitud) {
            // Obtener datos de las tablas EstadoSolicitud, Salas y Usuarios
            $usuarioModel = new UsuarioModel();
            $salaModel = new SalaModel();
            $estadosolicitudModel = new EstadoSolicitudModel();

            $usuarios = $usuarioModel->findAll();
            $salas = $salaModel->findAll();
            $estadossolicitudes = $estadosolicitudModel->findAll();

            // Pasar los datos a la vista
            return view('solicitudes/edit', [
                'solicitud' => $solicitud,
                'usuarios' => $usuarios,
                'salas' => $salas,
                'estadossolicitudes' => $estadossolicitudes
            ]);
        }
        return redirect()->to('/solicitudes')->with('error', 'No se encontró la solicitud con ID: ' . $id);
    }

    // POST /solicitudes/update/{id} - Actualizar una solicitud
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Solicitud actualizada exitosamente'
                ];
                return redirect()->to('/solicitudes')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/solicitudes')->with('error', 'No se encontró la solicitud con ID: ' . $id);
    }

    // DELETE /solicitudes/{id} - Eliminar una solicitud
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Solicitud eliminada exitosamente'
                ];
                return redirect()->to('/solicitudes')->with('message', $response['message']);
            }
            return redirect()->to('/solicitudes')->with('error', 'Error al eliminar la solicitud');
        }

        return redirect()->to('/solicitudes')->with('error', 'No se encontró la solicitud con ID: ' . $id);
    }

}

/*
Datos de Prueba
{
    "id_pedido_solicitud": 1,
    "id_sala_solicitud": 1,
    "responsable_solicitud": 12345678
}
*/