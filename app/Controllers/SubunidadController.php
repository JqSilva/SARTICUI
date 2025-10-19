<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SubunidadModel;

// Controlador de SubUnidad

class SubunidadController extends ResourceController
{
    protected $modelName = 'App\Models\SubunidadModel';
    protected $format = 'json';

    // GET /subunidades - Obtener todas las subunidades
    public function index()
    {
        $subunidades = $this->model->findAll();

        // Convertir estado_subunidad a texto
        foreach ($subunidades as &$subunidad) {
            $subunidad['ESTADO_SUBUNIDAD'] = $subunidad['ESTADO_SUBUNIDAD'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las subunidades a la vista
        return view('subunidades/index', ['subunidades' => $subunidades]);
    }

    // GET /subunidades/create - Mostrar el formulario para crear una subunidad
    public function create()
    {
        return view('subunidades/create');
    }

    // POST /subunidades - Crear una nueva subunidad
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/subunidades'))->with('message', 'SubUnidad creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /subunidades/edit/{id} - Mostrar el formulario para editar una subunidad
    public function edit($id = null)
    {
        $subunidad = $this->model->find($id);
        if ($subunidad) {
            return view('subunidades/edit', ['subunidad' => $subunidad]);
        }
        return redirect()->to('/subunidades')->with('error', 'No se encontró la subunidad con ID: ' . $id);
    }

    // POST /subunidades/update/{id} - Actualizar una subunidad
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Clasificación actualizada exitosamente'
                ];
                return redirect()->to('/subunidades')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/subunidades')->with('error', 'No se encontró la subunidad con ID: ' . $id);
    }

    // DELETE /subunidades/{id} - Eliminar una subunidad
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Clasificación eliminada exitosamente'
                ];
                return redirect()->to('/subunidades')->with('message', $response['message']);
            }
            return redirect()->to('/subunidades')->with('error', 'Error al eliminar la subunidad');
        }

        return redirect()->to('/subunidades')->with('error', 'No se encontró la subunidad con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "nombre_subnidad": "Rayos Osteopulmonar",
    "responsable": "Christian Delgado",
    "estado_subnidad": 1
}

{
    "nombre_subnidad": "Resonador Magnetico",
    "responsable": "Felipe Olivares",
    "estado_subnidad": 1
}
*/