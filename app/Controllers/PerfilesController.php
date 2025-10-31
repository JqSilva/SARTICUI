<?php
namespace App\Controllers;

use App\Models\PerfilModel;

class PerfilesController extends BaseController
{
    protected $perfilModel;

    public function __construct()
    {
        $this->perfilModel = new PerfilModel();
    }

    /**
     * Renderiza la vista principal según el rol (bodeguero, administrador, etc.)
     */
    private function renderIndex(?string $rolePrefix = null)
    {
        $perfiles = $this->perfilModel->findAll();

        // Si deseas normalizar datos (por ejemplo, estados):
        foreach ($perfiles as &$perfil) {
            $perfil['ESTADO_PERFIL'] = ($perfil['ESTADO_PERFIL'] == 1) ? 'Activo' : 'Inactivo';
        }
        unset($perfil);

        $data = ['perfiles' => $perfiles];

        $view = $rolePrefix
            ? "modules/perfiles/{$rolePrefix}/index"
            : "modules/perfiles/index";

        return $this->renderView($view, $data);
    }

    // GET /perfiles
    public function index()
    {
        return $this->renderIndex();
    }

    // GET /bodeguero/perfiles
    public function indexBodeguero()
    {
        return $this->renderIndex('bodeguero');
    }

    // GET /administrador/perfiles
    public function indexAdmin()
    {
        return $this->renderIndex('administrador');
    }

    // GET /perfiles/create
    public function create()
    {
        return $this->renderView('modules/perfiles/create');
    }

    // POST /perfiles/store
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->perfilModel->insert($data)) {
            return redirect()->to('/perfiles')->with('message', 'Perfil creado exitosamente.');
        }

        return redirect()->back()->withInput()->with('errors', $this->perfilModel->errors());
    }

    // GET /perfiles/edit/{id}
    public function edit($id = null)
    {
        $perfil = $this->perfilModel->find($id);
        if (!$perfil) {
            return redirect()->to('/perfiles')->with('error', 'Perfil no encontrado.');
        }

        return $this->renderView('modules/perfiles/edit', ['perfil' => $perfil]);
    }

    // POST /perfiles/update/{id}
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->perfilModel->update($id, $data)) {
            return redirect()->to('/perfiles')->with('message', 'Perfil actualizado correctamente.');
        }

        return redirect()->back()->withInput()->with('errors', $this->perfilModel->errors());
    }

    // GET /perfiles/delete/{id}
    public function delete($id = null)
    {
        if ($this->perfilModel->delete($id)) {
            return redirect()->to('/perfiles')->with('message', 'Perfil eliminado correctamente.');
        }

        return redirect()->to('/perfiles')->with('error', 'Error al eliminar el perfil.');
    }
}
