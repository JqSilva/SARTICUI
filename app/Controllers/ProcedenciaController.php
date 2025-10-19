<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProcedenciaModel;

// Controlador de Procedencia

class ProcedenciaController extends ResourceController
{
    protected $modelName = 'App\Models\ProcedenciaModel';
    protected $format = 'json';

    // GET /procedencias - Obtener todas las procedencias
    public function index()
    {
        $procedencias = $this->model->findAll();

        // Convertir estado_procedencia a texto
        foreach ($procedencias as &$procedencia) {
            $procedencia['ESTADO_PROCEDENCIA'] = $procedencia['ESTADO_PROCEDENCIA'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las procedencias a la vista
        return view('procedencias/index', ['procedencias' => $procedencias]);
    }

    // GET /procedencias/create - Mostrar el formulario para crear una procedencia
    public function create()
    {
        return view('procedencias/create');
    }

    // POST /procedencias - Crear una nueva procedencia
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/procedencias'))->with('message', 'Procedencia creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /procedencias/edit/{id} - Mostrar el formulario para editar una procedencia
    public function edit($id = null)
    {
        $procedencia = $this->model->find($id);
        if ($procedencia) {
            return view('procedencias/edit', ['procedencia' => $procedencia]);
        }
        return redirect()->to('/procedencias')->with('error', 'No se encontró la procedencia con ID: ' . $id);
    }

    // POST /procedencias/update/{id} - Actualizar una procedencia
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Procedencia actualizada exitosamente'
                ];
                return redirect()->to('/procedencias')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/procedencias')->with('error', 'No se encontró la procedencia con ID: ' . $id);
    }

    // DELETE /procedencias/{id} - Eliminar una procedencia
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Procedencia eliminada exitosamente'
                ];
                return redirect()->to('/procedencias')->with('message', $response['message']);
            }
            return redirect()->to('/procedencias')->with('error', 'Error al eliminar la procedencia');
        }

        return redirect()->to('/procedencias')->with('error', 'No se encontró la procedencia con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "nombre_procedencia": "Abastecimiento",
    "estado_procedencia": 1
}

{
    "nombre_procedencia": "Préstamo",
    "estado_procedencia": 1
}
*/