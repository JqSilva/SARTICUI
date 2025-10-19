<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PacienteModel;

// Controlador de Paciente

class PacienteController extends ResourceController
{
    protected $modelName = 'App\Models\PacienteModel';
    protected $format = 'json';

    // GET /pacientes - Obtener todos los pacientes
    public function index()
    {
        $pacientes = $this->model->findAll();

        // Pasar los datos de las pacientes a la vista
        return view('pacientes/index', ['pacientes' => $pacientes]);
    }

    // GET /pacientes/create - Mostrar el formulario para crear un paciente
    public function create()
    {
        return view('pacientes/create');
    }

    // POST /pacientes - Crear un nuevo paciente
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/pacientes'))->with('message', 'Paciente creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /pacientes/edit/{id} - Mostrar el formulario para editar un paciente
    public function edit($id = null)
    {
        $paciente = $this->model->find($id);
        if ($paciente) {
            return view('pacientes/edit', ['paciente' => $paciente]);
        }
        return redirect()->to('/pacientes')->with('error', 'No se encontró la paciente con ID: ' . $id);
    }

    // POST /pacientes/update/{id} - Actualizar un paciente
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Clasificación actualizada exitosamente'
                ];
                return redirect()->to('/pacientes')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/pacientes')->with('error', 'No se encontró la paciente con ID: ' . $id);
    }

    // DELETE /pacientes/{id} - Eliminar un paciente
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Clasificación eliminada exitosamente'
                ];
                return redirect()->to('/pacientes')->with('message', $response['message']);
            }
            return redirect()->to('/pacientes')->with('error', 'Error al eliminar la paciente');
        }

        return redirect()->to('/pacientes')->with('error', 'No se encontró la paciente con ID: ' . $id);
    }
}


/*
Datos de Prueba
{
    "num_ficha": 123456,
    "rut_paciente": 20570463,
    "pri_nombre": "Felipe",
    "seg_nombre": "Ignacio",
    "pri_apellido": "Olivares",
    "seg_apellido": "Saavedra",
    "fecha_nacimiento": "2025-11-09",
    "edad_paciente": 25,
    "contacto_telefono": 987220796,
    "correo_paciente": "felipe.olivares@alu.ucm.cl",
    "diagnostico": "Algo que no sé",
    "comuna_paciente": "Algun lugar ",
    "observacion_paciente": "No hay",
    "id_procedencia_paciente": 2,
    "id_previcion_paciente": 2
}
*/