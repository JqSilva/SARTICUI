<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\EquipoMedicoModel;

// Controlador de Equipo Médico

class EquipoMedicoController extends ResourceController
{
    protected $modelName = 'App\Models\EquipoMedicoModel';
    protected $format = 'json';

    // GET /equiposmedicos - Obtener todos los equipos medicos
    public function index()
    {
        $equiposmedicos = $this->model->findAll();

        // Convertir estado_equipo a texto
        foreach ($equiposmedicos as &$equipomedico) {
            $equipomedico['ESTADO_EQUIPO'] = $equipomedico['ESTADO_EQUIPO'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de los equipos medicos a la vista
        return view('equiposmedicos/index', ['equiposmedicos' => $equiposmedicos]);
    }

    // GET /equiposmedicos/create - Mostrar el formulario para crear un equipo medico
    public function create()
    {
        return view('equiposmedicos/create');
    }

    // POST /equiposmedicos - Crear un nuevo equipo medico
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/equiposmedicos'))->with('message', 'Equipo Médico creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /equiposmedicos/edit/{id} - Mostrar el formulario para editar un equipo medico
    public function edit($id = null)
    {
        $equipomedico = $this->model->find($id);
        if ($equipomedico) {
            return view('equiposmedicos/edit', ['equipomedico' => $equipomedico]);
        }
        return redirect()->to('/equiposmedicos')->with('error', 'No se encontró el equipo médico con ID: ' . $id);
    }

    // POST /equiposmedicos/update/{id} - Actualizar un equipo medico
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Equipo Médico actualizado exitosamente'
                ];
                return redirect()->to('/equiposmedicos')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/equiposmedicos')->with('error', 'No se encontró el equipo médico con ID: ' . $id);
    }

    // DELETE /equiposmedicos/{id} - Eliminar un equipo medico
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Equipo Médico eliminado exitosamente'
                ];
                return redirect()->to('/equiposmedicos')->with('message', $response['message']);
            }
            return redirect()->to('/equiposmedicos')->with('error', 'Error al eliminar el equipo médico');
        }

        return redirect()->to('/equiposmedicos')->with('error', 'No se encontró el equipo médico con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "NUM_SERIE_EQUIPO": "HDIE1827B3",
    "NOMBRE_EQUIPO": "Desfibrilador",
    "MARCA_EQUIPO": "Mindray",
    "VALOR_HORA": 0,
    "VIDA_UTIL_EQUIPO": 5,
    "FECHA_ADQUISICION_EQUIPO": "13-02-2025",
    "ESTADO_EQUIPO": 1,
    "OBSERVACION_EQUIPO": ""
}
*/