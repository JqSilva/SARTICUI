<?php
namespace App\Controllers;

use App\Models\InsumoModel;
use App\Models\ClasificacionModel;
use App\Models\DisponibilidadModel;

class InsumoController extends BaseController
{
    protected $insumoModel;
    protected $clasificacionModel;
    protected $disponibilidadModel;

    public function __construct()
    {
        $this->insumoModel = new InsumoModel();
        $this->clasificacionModel = new ClasificacionModel();
        $this->disponibilidadModel = new DisponibilidadModel();
    }

    /**
     * POC: compone los datos comunes y resuelve la vista según el prefijo de rol.
     * Ejemplos de $rolePrefix: 'bodeguero', 'administrador'
     */
    private function renderIndex(?string $rolePrefix = null)
    {
        // Datos base
        $insumos = $this->insumoModel->findAll();
        $clasificaciones = $this->clasificacionModel->findAll();
        $disponibilidades = $this->disponibilidadModel->findAll();

        // Mapas para búsqueda rápida
        $mapClas = [];
        foreach ($clasificaciones as $c) {
            $mapClas[$c['ID_CLASIFICACION']] = $c['NOMBRE_CLASIFICACION'];
        }

        $mapDisp = [];
        foreach ($disponibilidades as $d) {
            $mapDisp[$d['ID_DISPONIBILIDAD']] = $d['NOMBRE_DISPONIBILIDAD'];
        }

        // Normalizar campos legibles
        foreach ($insumos as &$insumo) {
            $insumo['ESTADO_INSUMO'] = ($insumo['ESTADO_INSUMO'] == 1) ? 'Activo' : 'Inactivo';
            $insumo['CLASIFICACION_NOMBRE'] = $mapClas[$insumo['ID_CLASIFICACION_INSUMO']] ?? '—';
            $insumo['DISPONIBILIDAD_NOMBRE'] = $mapDisp[$insumo['ID_DISPONIBILIDAD_INSUMO']] ?? '—';
        }
        unset($insumo);

        $data = [
            'insumos'         => $insumos,
            'clasificaciones' => $clasificaciones,
            'disponibilidades'=> $disponibilidades,
        ];

        // Detectar vista por rol
        $view = $rolePrefix
            ? "modules/insumos/{$rolePrefix}/index"
            : "modules/insumos/index";

        return $this->renderView($view, $data);
    }

    // Ruta general: GET /insumos
    public function index()
    {
        return $this->renderIndex();
    }

    // Ruta por rol bodeguero
    public function indexBodeguero()
    {
        return $this->renderIndex('bodeguero');
    }

    // Ruta por rol administrador
    public function indexAdmin()
    {
        return $this->renderIndex('administrador');
    }

    // GET /insumos/create
    public function create()
    {
        return $this->renderView('modules/insumos/create', [
            'clasificaciones'  => $this->clasificacionModel->findAll(),
            'disponibilidades' => $this->disponibilidadModel->findAll()
        ]);
    }

    // POST /insumos/store
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->insumoModel->insert($data)) {
            return redirect()->to('/insumos')->with('message', 'Insumo creado exitosamente');
        }

        return redirect()->back()->withInput()->with('errors', $this->insumoModel->errors());
    }

    // GET /insumos/edit/{id}
    public function edit($id = null)
    {
        $insumo = $this->insumoModel->find($id);
        if (!$insumo) {
            return redirect()->to('/insumos')->with('error', 'No se encontró el insumo con ID: ' . $id);
        }

        return $this->renderView('modules/insumos/edit', [
            'insumo'           => $insumo,
            'clasificaciones'  => $this->clasificacionModel->findAll(),
            'disponibilidades' => $this->disponibilidadModel->findAll()
        ]);
    }

    // POST /insumos/update/{id}
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->insumoModel->update($id, $data)) {
            return redirect()->to('/insumos')->with('message', 'Insumo actualizado exitosamente');
        }

        return redirect()->back()->withInput()->with('errors', $this->insumoModel->errors());
    }

    // GET /insumos/delete/{id}
    public function delete($id = null)
    {
        if ($this->insumoModel->delete($id)) {
            return redirect()->to('/insumos')->with('message', 'Insumo eliminado exitosamente');
        }
        return redirect()->to('/insumos')->with('error', 'Error al eliminar el insumo');
    }
}
