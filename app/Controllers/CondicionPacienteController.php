<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CondicionPacienteModel;

// Controlador de Condición del Paciente

class CondicionPacienteController extends ResourceController
{
    protected $modelName = 'App\Models\CondicionPacienteModel';
    protected $format = 'json';

    // GET /condicionespacientes - Obtener todas las condiciones de pacientes
    public function index()
    {
        $condicionespacientes = $this->model->findAll();

        // Convertir estado_condicion_paciente a texto
        foreach ($condicionespacientes as &$condicionpaciente) {
            $condicionpaciente['ESTADO_CONDICION_PACIENTE'] = $condicionpaciente['ESTADO_CONDICION_PACIENTE'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las condiciones de pacientes a la vista
        return view('condicionespacientes/index', ['condicionespacientes' => $condicionespacientes]);
    }

    // GET /condicionespacientes/create - Mostrar el formulario para crear una condicion de paciente
    public function create()
    {
        return view('condicionespacientes/create');
    }

    // POST /condicionespacientes - Crear una nueva condicion de paciente
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/condicionespacientes'))->with('message', 'Condición del Paciente creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /condicionespacientes/edit/{id} - Mostrar el formulario para editar una condicion de paciente
    public function edit($id = null)
    {
        $condicionpaciente = $this->model->find($id);
        if ($condicionpaciente) {
            return view('condicionespacientes/edit', ['condicionpaciente' => $condicionpaciente]);
        }
        return redirect()->to('/condicionespacientes')->with('error', 'No se encontró la condición del paciente con ID: ' . $id);
    }

    // POST /condicionespacientes/update/{id} - Actualizar una condicion de paciente
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Condición del Paciente actualizada exitosamente'
                ];
                return redirect()->to('/condicionespacientes')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/condicionespacientes')->with('error', 'No se encontró la condición de paciente con ID: ' . $id);
    }

    // DELETE /condicionespacientes/{id} - Eliminar una condicion de paciente
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Condición del Paciente eliminada exitosamente'
                ];
                return redirect()->to('/condicionespacientes')->with('message', $response['message']);
            }
            return redirect()->to('/condicionespacientes')->with('error', 'Error al eliminar la condición del paciente');
        }

        return redirect()->to('/condicionespacientes')->with('error', 'No se encontró la condición de paciente con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "NOMBRE_CONDICION_PACIENTE": "Muerto",
    "ESTADO_CONDICION_PACIENTE": 1
}

{
    "NOMBRE_CONDICION_PACIENTE": "Vivo",
    "ESTADO_CONDICION_PACIENTE": 1
}
*/