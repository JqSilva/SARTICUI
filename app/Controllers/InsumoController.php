<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InsumoModel;
use App\Models\DisponibilidadModel;
use App\Models\ClasificacionModel;

class InsumoController extends ResourceController
{
    protected $modelName = 'App\Models\InsumoModel';
    protected $format = 'json';

    /**
     * POC: compone los datos comunes y resuelve la vista según el prefijo de rol.
     * Ejemplos de $rolePrefix: 'bodeguero', 'administrador' (debe coincidir con tu carpeta en Views)
     */
    private function renderIndex(?string $rolePrefix = null)
    {
        // Datos base
        $insumos = $this->model->findAll();

        $clasificacionModel = new ClasificacionModel();
        $disponibilidadModel = new DisponibilidadModel();

        $clasificaciones = $clasificacionModel->findAll();
        $disponibilidades = $disponibilidadModel->findAll();

        // Mapas para lookups rápidos
        $mapClas = [];
        foreach ($clasificaciones as $c) {
            $mapClas[$c['ID_CLASIFICACION']] = $c['NOMBRE_CLASIFICACION'];
        }

        $mapDisp = [];
        foreach ($disponibilidades as $d) {
            $mapDisp[$d['ID_DISPONIBILIDAD']] = $d['NOMBRE_DISPONIBILIDAD'];
        }

        // Normalización de campos
        foreach ($insumos as &$insumo) {
            $insumo['ESTADO_INSUMO']        = ($insumo['ESTADO_INSUMO'] == 1) ? 'Activa' : 'Inactiva';
            $insumo['CLASIFICACION_NOMBRE'] = $mapClas[$insumo['ID_CLASIFICACION_INSUMO']] ?? '—';
            $insumo['DISPONIBILIDAD_NOMBRE']= $mapDisp[$insumo['ID_DISPONIBILIDAD_INSUMO']] ?? '—';
        }
        unset($insumo); // por referencia

        $data = [
            'insumos'         => $insumos,
            'clasificaciones' => $clasificaciones,
            'disponibilidades'=> $disponibilidades,
        ];

        // Si viene prefijo de rol, intenta esa vista; si no, usa la genérica
        $view = $rolePrefix ? ($rolePrefix . '/insumos/index') : 'insumos/index';
        return view($view, $data);
    }

    // Ruta genérica (fallback): GET /insumos
    public function index()
    {
        return $this->renderIndex(null);
    }

    // Ruta para bodeguero: GET /bodeguero/insumos
    public function indexBodeguero()
    {
        return $this->renderIndex('bodeguero');
    }

    // Ruta para administrador: GET /admin/insumos (o /administrador/insumos si así lo defines)
    // OJO: asegúrate que la carpeta sea "app/Views/administrador/insumos/index.php"
    public function indexAdmin()
    {
        return $this->renderIndex('administrador');
    }

    // GET /insumos/create - Mostrar formulario de creación (genérico)
    public function create()
    {
        $clasificacionModel = new ClasificacionModel();
        $disponibilidadModel = new DisponibilidadModel();

        $clasificaciones = $clasificacionModel->findAll();
        $disponibilidades = $disponibilidadModel->findAll();

        return view('insumos/create', [
            'clasificaciones' => $clasificaciones,
            'disponibilidades'=> $disponibilidades
        ]);
    }

    // POST /insumos - Crear un nuevo insumo
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/insumos'))
                ->with('message', 'Insumo creado exitosamente');
        }

        return redirect()->back()
            ->withInput()
            ->with('errors', $this->model->errors());
    }

    // GET /insumos/edit/{id} - Mostrar formulario de edición
    public function edit($id = null)
    {
        $insumo = $this->model->find($id);

        if (!$insumo) {
            return redirect()->to('/insumos')
                ->with('error', 'No se encontró el insumo con ID: ' . $id);
        }

        $clasificacionModel = new ClasificacionModel();
        $disponibilidadModel = new DisponibilidadModel();

        $clasificaciones = $clasificacionModel->findAll();
        $disponibilidades = $disponibilidadModel->findAll();

        return view('insumos/edit', [
            'insumo'          => $insumo,
            'clasificaciones' => $clasificaciones,
            'disponibilidades'=> $disponibilidades
        ]);
    }

    // POST /insumos/update/{id} - Actualizar un insumo
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if (!$this->model->find($id)) {
            return redirect()->to('/insumos')
                ->with('error', 'No se encontró el insumo con ID: ' . $id);
        }

        if ($this->model->update($id, $data)) {
            return redirect()->to('/insumos')
                ->with('message', 'Insumo actualizado exitosamente');
        }

        return redirect()->back()
            ->withInput()
            ->with('errors', $this->model->errors());
    }

    // DELETE /insumos/{id} - Eliminar un insumo
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return redirect()->to('/insumos')
                ->with('error', 'No se encontró el insumo con ID: ' . $id);
        }

        if ($this->model->delete($id)) {
            return redirect()->to('/insumos')
                ->with('message', 'Insumo eliminado exitosamente');
        }

        return redirect()->to('/insumos')
            ->with('error', 'Error al eliminar el insumo');
    }
}

/*
Datos de Prueba
{
    "codigo_abas": 24567890,
    "nombre_insumo": "Alcohol",
    "cantidad_insumo": "50",
    "estado_insumo": 1,
    "clasificacion_insumo": 1,
    "disponibilidad_insumo": 1
}
*/
