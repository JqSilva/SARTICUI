<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\EstamentoModel;

// Controlador de Estamento

class EstamentoController extends ResourceController
{
    protected $modelName = 'App\Models\EstamentoModel';
    protected $format = 'json';

    // GET /estamentos - Obtener todos los estamentos
    public function index()
    {
        $estamentos = $this->model->findAll();

        // Convertir estado_estamento a texto
        foreach ($estamentos as &$estamento) {
            $estamento['ESTADO_ESTAMENTO'] = $estamento['ESTADO_ESTAMENTO'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las estamentos a la vista
        return view('estamentos/index', ['estamentos' => $estamentos]);
    }

    // GET /estamentos/create - Mostrar el formulario para crear un estamento
    public function create()
    {
        return view('estamentos/create');
    }

    // POST /estamentos - Crear un nuevo estamento
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/estamentos'))->with('message', 'Estamento creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /estamentos/edit/{id} - Mostrar el formulario para editar un estamento
    public function edit($id = null)
    {
        $estamento = $this->model->find($id);
        if ($estamento) {
            return view('estamentos/edit', ['estamento' => $estamento]);
        }
        return redirect()->to('/estamentos')->with('error', 'No se encontró el estamento con ID: ' . $id);
    }

    // POST /estamentos/update/{id} - Actualizar un estamento
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Estamento actualizado exitosamente'
                ];
                return redirect()->to('/estamentos')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/estamentos')->with('error', 'No se encontró el estamento con ID: ' . $id);
    }

    // DELETE /estamentos/{id} - Eliminar un estamento
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Estamento eliminado exitosamente'
                ];
                return redirect()->to('/estamentos')->with('message', $response['message']);
            }
            return redirect()->to('/estamentos')->with('error', 'Error al eliminar el estamento');
        }

        return redirect()->to('/estamentos')->with('error', 'No se encontró el estamento con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "NOMBRE_ESTAMENTO": "Tecnólogo Médico",
    "SUELDO_HORA_ESTAMENTO": 12000,
    "ESTADO_ESTAMENTO": 1
}

{
    "NOMBRE_ESTAMENTO": "Médico",
    "SUELDO_HORA_ESTAMENTO": 35000,
    "ESTADO_ESTAMENTO": 1
}
*/