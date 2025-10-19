<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProcedimientoModel;

// Controlador de Procedimiento

class ProcedimientoController extends ResourceController
{
    protected $modelName = 'App\Models\ProcedimientoModel';
    protected $format = 'json';

    // GET /procedimientos - Obtener todos los procedimientos
    public function index()
    {
        $procedimientos = $this->model->findAll();

        // Convertir estado_procedimiento a texto
        foreach ($procedimientos as &$procedimiento) {
            $procedimiento['ESTADO_PROCEDIMIENTO'] = $procedimiento['ESTADO_PROCEDIMIENTO'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de los procedimientos a la vista
        return view('procedimientos/index', ['procedimientos' => $procedimientos]);
    }

    // GET /procedimientos/create - Mostrar el formulario para crear un procedimiento
    public function create()
    {
        return view('procedimientos/create');
    }

    // POST /procedimientos - Crear un nuevo procedimiento
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/procedimientos'))->with('message', 'Procedimiento creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /procedimientos/edit/{id} - Mostrar el formulario para editar un procedimiento
    public function edit($id = null)
    {
        $procedimiento = $this->model->find($id);
        if ($procedimiento) {
            return view('procedimientos/edit', ['procedimiento' => $procedimiento]);
        }
        return redirect()->to('/procedimientos')->with('error', 'No se encontró el procedimiento con ID: ' . $id);
    }

    // POST /procedimientos/update/{id} - Actualizar un procedimiento
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Procedimiento actualizado exitosamente'
                ];
                return redirect()->to('/procedimientos')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/procedimientos')->with('error', 'No se encontró el procedimiento con ID: ' . $id);
    }

    // DELETE /procedimientos/{id} - Eliminar un procedimiento
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Procedimiento eliminado exitosamente'
                ];
                return redirect()->to('/procedimientos')->with('message', $response['message']);
            }
            return redirect()->to('/procedimientos')->with('error', 'Error al eliminar el procedimiento');
        }

        return redirect()->to('/procedimientos')->with('error', 'No se encontró el procedimiento con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "ID_PROCEDIMIENTO": 1010795,
    "NOMBRE_PROCEDIMIENTO": "Biopsia Hepatica",
    "ESTADO_PROCEDIMIENTO": 1
}

{
    "ID_PROCEDIMIENTO": 1901006,
    "NOMBRE_PROCEDIMIENTO": "Biopsia Renal",
    "ESTADO_PROCEDIMIENTO": 1
}
*/