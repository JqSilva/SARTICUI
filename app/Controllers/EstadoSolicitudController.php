<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\EstadoSolicitudModel;

// Controlador de Estado Solicitud

class EstadoSolicitudController extends ResourceController
{
    protected $modelName = 'App\Models\EstadoSolicitudModel';
    protected $format = 'json';

    // GET /estadossolicitudes - Obtener todos los estados solicitudes
    public function index()
    {
        $estadossolicitudes = $this->model->findAll();

        // Convertir estado_estadosolicitud a texto
        foreach ($estadossolicitudes as &$estadosolicitud) {
            $estadosolicitud['ESTADO_SOLICITUD'] = $estadosolicitud['ESTADO_SOLICITUD'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de los estados solicitudes a la vista
        return view('estadossolicitudes/index', ['estadossolicitudes' => $estadossolicitudes]);
    }

    // GET /estadossolicitudes/create - Mostrar el formulario para crear un estado solicitud
    public function create()
    {
        return view('estadossolicitudes/create');
    }

    // POST /estadossolicitudes - Crear una nuevo estado solicitud
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/estadossolicitudes'))->with('message', 'Estado de Solicitud creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /estadossolicitudes/edit/{id} - Mostrar el formulario para editar un estado solicitud
    public function edit($id = null)
    {
        $estadosolicitud = $this->model->find($id);
        if ($estadosolicitud) {
            return view('estadossolicitudes/edit', ['estadosolicitud' => $estadosolicitud]);
        }
        return redirect()->to('/estadossolicitudes')->with('error', 'No se encontró el estado de solicitud con ID: ' . $id);
    }

    // POST /estadossolicitudes/update/{id} - Actualizar un estado solicitud
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Estado de Solicitud actualizado exitosamente'
                ];
                return redirect()->to('/estadossolicitudes')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/estadossolicitudes')->with('error', 'No se encontró el estado de solicitud con ID: ' . $id);
    }

    // DELETE /estadossolicitudes/{id} - Eliminar un estado solicitud
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Estado de Solicitud eliminado exitosamente'
                ];
                return redirect()->to('/estadossolicitudes')->with('message', $response['message']);
            }
            return redirect()->to('/estadossolicitudes')->with('error', 'Error al eliminar el estado de solicitud');
        }

        return redirect()->to('/estadossolicitudes')->with('error', 'No se encontró el estado de solicitud con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "NOMBRE_ESTADO_SOLICITUD": "Pendiente",
    "ESTADO_SOLICITUD": 0
}

{
    "NOMBRE_ESTADO_SOLICITUD": "En Revisión",
    "ESTADO_SOLICITUD": 0
}

{
    "NOMBRE_ESTADO_SOLICITUD": "Aprobada",
    "ESTADO_SOLICITUD": 0
}

{
    "NOMBRE_ESTADO_SOLICITUD": "Rechazada",
    "ESTADO_SOLICITUD": 0
}

{
    "NOMBRE_ESTADO_SOLICITUD": "Listo para Entrega",
    "ESTADO_SOLICITUD": 0
}

{
    "NOMBRE_ESTADO_SOLICITUD": "Entregado",
    "ESTADO_SOLICITUD": 0
}
*/