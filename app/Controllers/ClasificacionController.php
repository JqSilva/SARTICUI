<?php
namespace App\Controllers;

use App\Models\ClasificacionModel;

class ClasificacionController extends BaseController
{
    protected $clasificacionModel;

    public function __construct()
    {
        $this->clasificacionModel = new ClasificacionModel();
    }

    // GET /clasificaciones - Obtener todas las clasificaciones
    public function index()
    {
        $clasificaciones = $this->clasificacionModel->findAll();

        // Convertir estado_clasificacion a texto
        foreach ($clasificaciones as &$clasificacion) {
            $clasificacion['ESTADO_CLASIFICACION'] = $clasificacion['ESTADO_CLASIFICACION'] == 1 ? 'Activa' : 'Inactiva';
        }

        return $this->renderView('modules/clasificaciones/index', [
            'clasificaciones' => $clasificaciones
        ]);
    }

    // GET /clasificaciones/create - Mostrar formulario
    public function create()
    {
        return $this->renderView('modules/clasificaciones/create');
    }

    // POST /clasificaciones - Crear nueva clasificación
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->clasificacionModel->insert($data)) {
            return redirect()->to(base_url('/clasificaciones'))
                             ->with('message', 'Clasificación creada exitosamente');
        }

        return redirect()->back()->withInput()
                       ->with('errors', $this->clasificacionModel->errors());
    }

    // GET /clasificaciones/edit/{id} - Mostrar formulario para editar
    public function edit($id = null)
    {
        $clasificacion = $this->clasificacionModel->find($id);

        if ($clasificacion) {
            return $this->renderView('modules/clasificaciones/edit', [
                'clasificacion' => $clasificacion
            ]);
        }

        return redirect()->to('/clasificaciones')
                         ->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }

    // POST /clasificaciones/update/{id} - Actualizar clasificación
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->clasificacionModel->find($id)) {
            if ($this->clasificacionModel->update($id, $data)) {
                return redirect()->to('/clasificaciones')
                                 ->with('message', 'Clasificación actualizada exitosamente');
            }

            return redirect()->back()->withInput()
                           ->with('errors', $this->clasificacionModel->errors());
        }

        return redirect()->to('/clasificaciones')
                         ->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }

    // DELETE /clasificaciones/{id} - Eliminar clasificación
    public function delete($id = null)
    {
        if ($this->clasificacionModel->find($id)) {
            if ($this->clasificacionModel->delete($id)) {
                return redirect()->to('/clasificaciones')
                                 ->with('message', 'Clasificación eliminada exitosamente');
            }

            return redirect()->to('/clasificaciones')
                             ->with('error', 'Error al eliminar la clasificación');
        }

        return redirect()->to('/clasificaciones')
                         ->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }
}
