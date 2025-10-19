<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuarioModel;
use App\Models\PerfilModel;
use App\Models\EstamentoModel;

// Controlador de Usuario

class UsuarioController extends ResourceController
{
    protected $modelName = 'App\Models\UsuarioModel';
    protected $format = 'json';

    // GET /usuarios - Obtener todos los usuarios
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = $this->model->findAll();

        // Obtener los perfiles
        $perfilModel = new PerfilModel();
        $perfiles = $perfilModel->findAll();

        // Obtener los estamentos
        $estamentoModel = new EstamentoModel();
        $estamentos = $estamentoModel->findAll();

        // Convertir estado_usuario a texto
        foreach ($usuarios as &$usuario) {
            // Obtener nombres de perfil
            foreach ($perfiles as $perfil) {
                if ($usuario['ID_PERFIL_USUARIO'] == $perfil['ID_PERFIL']) {
                    $usuario['PERFIL_NOMBRE'] = $perfil['NOMBRE_PERFIL'];
                    break;
                }
            }

            foreach ($estamentos as $estamento) {
                if ($usuario['ID_ESTAMENTO_USUARIO'] == $estamento['ID_ESTAMENTO']) {
                    $usuario['ESTAMENTO_NOMBRE'] = $estamento['NOMBRE_ESTAMENTO'];
                    break;
                }
            }
        }

        // Pasar los datos a la vista
        return view('usuarios/index', [
            'usuarios' => $usuarios,
            'perfiles' => $perfiles,
            'estamentos' => $estamentos
        ]);
    }

    // GET /usuarios/create - Mostrar el formulario para crear un usuario
    public function create()
    {
        // Obtener datos de la tabla perfil
        $perfilModel = new PerfilModel();
        $perfiles = $perfilModel->findAll();

        // Obtener datos de la tabla estamento
        $estamentoModel = new EstamentoModel();
        $estamentos = $estamentoModel->findAll();

        // Pasar los datos a la vista
        return view('usuarios/create', [
            'perfiles' => $perfiles,
            'estamentos' => $estamentos
        ]);
    }

    // POST /usuarios - Crear un nuevo usuario
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/usuarios'))->with('message', 'Usuario creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /usuarios/edit/{id} - Mostrar el formulario para editar un usuario
    public function edit($id = null)
    {
        $usuario = $this->model->find($id);

        if ($usuario) {
            // Obtener datos de la tabla de perfil
            $perfilModel = new PerfilModel();
            $perfiles = $perfilModel->findAll();

            // Obtener datos de la tabla de estamento
            $estamentoModel = new EstamentoModel();
            $estamentos = $estamentoModel->findAll();

            // Pasar los datos a la vista
            return view('usuarios/edit', [
                'usuario' => $usuario,
                'perfiles' => $perfiles,
                'estamentos' => $estamentos
            ]);
        }
        return redirect()->to('/usuarios')->with('error', 'No se encontró el usuario con ID: ' . $id);
    }

    // POST /usuarios/update/{id} - Actualizar un usuario
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Usuario actualizado exitosamente'
                ];
                return redirect()->to('/usuarios')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/usuarios')->with('error', 'No se encontró el usuario con ID: ' . $id);
    }

    // DELETE /usuarios/{id} - Eliminar un usuario
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Usuario eliminado exitosamente'
                ];
                return redirect()->to('/usuarios')->with('message', $response['message']);
            }
            return redirect()->to('/usuarios')->with('error', 'Error al eliminar el usuario');
        }

        return redirect()->to('/usuarios')->with('error', 'No se encontró el usuario con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "id_usuario": 20570463,
    "contrasena": "123456"
}
*/