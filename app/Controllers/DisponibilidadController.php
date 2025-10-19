<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\DisponibilidadModel;

// Controlador de Disponibilidad

class DisponibilidadController extends ResourceController
{
    protected $modelName = 'App\Models\DisponibilidadModel';
    protected $format = 'json';

    // GET /disponibilidades - Obtener todas las disponibilidades
    public function index()
    {
        $disponibilidades = $this->model->findAll();

        // Convertir estado_disponibilidad a texto
        foreach ($disponibilidades as &$disponibilidad) {
            $disponibilidad['ESTADO_DISPONIBILIDAD'] = $disponibilidad['ESTADO_DISPONIBILIDAD'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las disponibilidades a la vista
        return view('disponibilidades/index', ['disponibilidades' => $disponibilidades]);
    }

    // GET /disponibilidades/create - Mostrar el formulario para crear una disponibilidad
    public function create()
    {
        return view('disponibilidades/create');
    }

    // POST /disponibilidades - Crear una nueva disponibilidad
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/disponibilidades'))->with('message', 'Disponibilidad creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /disponibilidades/edit/{id} - Mostrar el formulario para editar una disponibilidad
    public function edit($id = null)
    {
        $disponibilidad = $this->model->find($id);
        if ($disponibilidad) {
            return view('disponibilidades/edit', ['disponibilidad' => $disponibilidad]);
        }
        return redirect()->to('/disponibilidades')->with('error', 'No se encontró la disponibilidad con ID: ' . $id);
    }

    // POST /disponibilidades/update/{id} - Actualizar una disponibilidad
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Disponibilidad actualizada exitosamente'
                ];
                return redirect()->to('/disponibilidades')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/disponibilidades')->with('error', 'No se encontró la disponibilidad con ID: ' . $id);
    }

    // DELETE /disponibilidades/{id} - Eliminar una disponibilidad
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Disponibilidad eliminada exitosamente'
                ];
                return redirect()->to('/disponibilidades')->with('message', $response['message']);
            }
            return redirect()->to('/disponibilidades')->with('error', 'Error al eliminar la disponibilidad');
        }

        return redirect()->to('/disponibilidades')->with('error', 'No se encontró la disponibilidad con ID: ' . $id);
    }
}


/*
Datos de Prueba
{
    "nombre_disponibilidad": "Dificil",
    "estado_disponibilidad": 1
}

{
    "nombre_disponibilidad": "Facil",
    "estado_disponibilidad": 1
}

{
    "nombre_disponibilidad": "Moderado",
    "estado_disponibilidad": 1
}
*/