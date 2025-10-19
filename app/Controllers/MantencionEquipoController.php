<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MantencionEquipoModel;
use App\Models\EquipoMedicoModel;
use App\Models\TipoMantencionModel;

// Controlador de Mantencion de Equipo

class MantencionEquipoController extends ResourceController
{
    protected $modelName = 'App\Models\MantencionEquipoModel';
    protected $format = 'json';

    // GET /mantencionesequipos - Obtener todas las mantenciones de equipos
    public function index()
    {
        // Obtener todas las mantenciones de equipos
        $mantencionesequipos = $this->model->findAll();

        // Obtener las tipos de mantenciones y equipos medicos
        $tipomantencionModel = new TipoMantencionModel();
        $equipomedicoModel = new EquipoMedicoModel();
        $tiposmantenciones = $tipomantencionModel->findAll();
        $equiposmedicos = $equipomedicoModel->findAll();

        // Convertir estado_mantencionequipo a texto
        foreach ($mantencionesequipos as &$mantencionequipo) {
            $mantencionequipo['PROXIMA_MANTENCION'] = date('Y-m', strtotime($mantencionequipo['PROXIMA_MANTENCION']));

            // Obtener nombres de tipo de mantención y equipo medico
            foreach ($tiposmantenciones as $tipomantencion) {
                if ($mantencionequipo['ID_TIPO_MANTENCION_ME'] == $tipomantencion['ID_TIPO_MANTENCION']) {
                    $mantencionequipo['TIPO_MANTENCION_NOMBRE'] = $tipomantencion['NOMBRE_TIPO_MANTENCION'];
                    break;
                }
            }

            foreach ($equiposmedicos as $equipomedico) {
                if ($mantencionequipo['ID_EQUIPO_MEDICO_ME'] == $equipomedico['ID_EQUIPO_MEDICO']) {
                    $mantencionequipo['EQUIPO_NOMBRE'] = $equipomedico['NOMBRE_EQUIPO'];
                    break;
                }
            }
        }

        // Pasar los datos a la vista
        return view('mantencionesequipos/index', [
            'mantencionesequipos' => $mantencionesequipos,
            'tiposmantenciones' => $tiposmantenciones,
            'equiposmedicos' => $equiposmedicos
        ]);
    }

    // GET /mantencionesequipos/create - Mostrar el formulario para crear una mantencion de equipo
    public function create()
    {
        // Obtener datos de las tablas tipo de mantencion y equipo medico
        $tipomantencionModel = new TipoMantencionModel();
        $equipomedicoModel = new EquipoMedicoModel();

        $tiposmantenciones = $tipomantencionModel->findAll();
        $equiposmedicos = $equipomedicoModel->findAll();

        // Pasar los datos a la vista
        return view('mantencionesequipos/create', [
            'tiposmantenciones' => $tiposmantenciones,
            'equiposmedicos' => $equiposmedicos
        ]);
    }

    // POST /mantencionesequipos - Crear una nueva mantencion de equipo
    public function store()
    {
        $data = $this->request->getPost();

        if (!empty($data['PROXIMA_MANTENCION'])) {
            $data['PROXIMA_MANTENCION'] = date('Y-m-01', strtotime($data['PROXIMA_MANTENCION']));
        }

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/mantencionesequipos'))->with('message', 'Mantención de Equipo creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /mantencionesequipos/edit/{id} - Mostrar el formulario para editar un mantencionequipo
    public function edit($id = null)
    {
        $mantencionequipo = $this->model->find($id);

        if ($mantencionequipo) {
            // Obtener datos de las tablas TipoMantencion y EquipoMedico
            $tipomantencionModel = new TipoMantencionModel();
            $equipomedicoModel = new EquipoMedicoModel();

            $tiposmantenciones = $tipomantencionModel->findAll();
            $equiposmedicos = $equipomedicoModel->findAll();

            // Pasar los datos a la vista
            return view('mantencionesequipos/edit', [
                'mantencionequipo' => $mantencionequipo,
                'tiposmantenciones' => $tiposmantenciones,
                'equiposmedicos' => $equiposmedicos
            ]);
        }
        return redirect()->to('/mantencionesequipos')->with('error', 'No se encontró la mantencion de equipo con ID: ' . $id);
    }

    // POST /mantencionesequipos/update/{id} - Actualizar un mantencionequipo
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if (!empty($data['PROXIMA_MANTENCION'])) {
            $data['PROXIMA_MANTENCION'] = date('Y-m-01', strtotime($data['PROXIMA_MANTENCION']));
        }

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Mantencion de Equipo actualizada exitosamente'
                ];
                return redirect()->to('/mantencionesequipos')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/mantencionesequipos')->with('error', 'No se encontró la mantencion de equipo con ID: ' . $id);
    }

    // DELETE /mantencionesequipos/{id} - Eliminar una mantencion de equipo
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Mantencion de Equipo eliminada exitosamente'
                ];
                return redirect()->to('/mantencionesequipos')->with('message', $response['message']);
            }
            return redirect()->to('/mantencionesequipos')->with('error', 'Error al eliminar la mantencion de equipo');
        }

        return redirect()->to('/mantencionesequipos')->with('error', 'No se encontró la mantencion de equipo con ID: ' . $id);
    }
}



/*
Datos de Prueba
{
    "ID_EQUIPO_MEDICO_ME": 1,
    "ID_TIPO_MANTENCION_ME": 1,
    "FECHA_MANTENCION": "13-02-2025",
    "DESCRIPCION_MANTENCION": "",
    "PROXIMA_MANTENCION": "23-08-2025",
    "RESPONSABLE_MANTENCION": "Paulette Varas",
    "COSTO_MANTENCION": 38000
}
*/