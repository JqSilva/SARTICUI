<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PerfilModel;

// Controlador de Perfil

class PerfilController extends ResourceController
{
    protected $modelName = 'App\Models\PerfilModel';
    protected $format = 'json';

    // GET /perfiles - Obtener todos los perfiles
    public function index()
    {
        $perfiles = $this->model->findAll();

        // Convertir estado_perfil a texto
        foreach ($perfiles as &$perfil) {
            $perfil['ESTADO_PERFIL'] = $perfil['ESTADO_PERFIL'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de los perfiles a la vista
        return view('perfiles/index', ['perfiles' => $perfiles]);
    }

    // GET /perfiles/create - Mostrar el formulario para crear un perfil
    public function create()
    {
        return view('perfiles/create');
    }

    // POST /perfiles - Crear un nuevo perfil
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/perfiles'))->with('message', 'Perfil creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /perfiles/edit/{id} - Mostrar el formulario para editar un perfil
    public function edit($id = null)
    {
        $perfil = $this->model->find($id);
        if ($perfil) {
            return view('perfiles/edit', ['perfil' => $perfil]);
        }
        return redirect()->to('/perfiles')->with('error', 'No se encontró el perfil con ID: ' . $id);
    }

    // POST /perfiles/update/{id} - Actualizar un perfil
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Perfil actualizada exitosamente'
                ];
                return redirect()->to('/perfiles')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/perfiles')->with('error', 'No se encontró el perfil con ID: ' . $id);
    }

    // DELETE /perfiles/{id} - Eliminar un perfil
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Perfil eliminada exitosamente'
                ];
                return redirect()->to('/perfiles')->with('message', $response['message']);
            }
            return redirect()->to('/perfiles')->with('error', 'Error al eliminar el perfil');
        }

        return redirect()->to('/perfiles')->with('error', 'No se encontró el perfil con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "nombre_perfil": "Admin",
    "estado_perfil": 1
}
*/