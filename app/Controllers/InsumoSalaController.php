<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\InsumoSalaModel;
use App\Models\LoteModel;
use App\Models\SalaModel;
use App\Models\InsumoModel;
use App\Models\BodegaModel;

// Controlador de Insumo en Sala

class InsumoSalaController extends ResourceController
{
    protected $modelName = 'App\Models\InsumoSalaModel';
    protected $format = 'json';

    // GET /insumossalas - Obtener todos los insumos en salas
    public function index()
    {
        // Obtener solo los insumos con cantidad mayor a 0
        $insumossalas = $this->model->where('CANTIDAD_INSUMO_SALA >', 0)->findAll();

        // Obtener los lotes, los insumos y las salas
        $loteModel = new LoteModel();
        $salaModel = new SalaModel();
        $insumoModel = new InsumoModel();

        $lotes = $loteModel->findAll();
        $salas = $salaModel->findAll();
        $insumos = $insumoModel->findAll();

        // Convertir estado_insumo a texto
        foreach ($insumossalas as &$insumosala) {

            // Obtener nombres de lote, insumo y sala
            foreach ($lotes as $lote) {
                if ($insumosala['ID_LOTE_INSUMO_SALA'] == $lote['ID_LOTE']) {
                    $insumosala['CODIGO_INSUMO'] = $lote['CODIGO_PRODUCTO_LOTE'];
                    $insumosala['COD_INSUMO'] = $lote['ID_INSUMO_LOTE'];
                    break;
                }
            }

            foreach ($insumos as $insumo) {
                if (isset($insumosala['COD_INSUMO']) && $insumosala['COD_INSUMO'] == $insumo['ID_INSUMO']) {
                    $insumosala['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                    break;
                }
            }

            foreach ($salas as $sala) {
                if ($insumosala['ID_SALA_INSUMO_SALA'] == $sala['ID_SALA']) {
                    $insumosala['SALA_NOMBRE'] = $sala['NOMBRE_SALA'];
                    break;
                }
            }
        }

        // Pasar los datos a la vista
        return view('insumossalas/index', [
            'insumossalas' => $insumossalas,
            'lotes' => $lotes,
            'salas' => $salas
        ]);
    }

    // GET /insumossalas/create - Mostrar el formulario para crear un insumo en sala
    public function create()
    {
        // Obtener datos de las tablas lote, insumo y sala
        $loteModel = new LoteModel();
        $salaModel = new SalaModel();
        $insumoModel = new InsumoModel();

        $lotes = $loteModel->findAll();
        $salas = $salaModel->findAll();
        $insumos = $insumoModel->findAll();

        // Pasar los datos a la vista
        return view('insumossalas/create', [
            'lotes' => $lotes,
            'salas' => $salas,
            'insumos' => $insumos
        ]);
    }

    // POST /insumossalas - Crear un nuevo insumo en sala
    public function store()
    {
        $data = $this->request->getPost();

        // Obtener la cantidad disponible del lote seleccionado desde BodegaModel
        $bodegaModel = new BodegaModel();
        $insumosEnBodega = $bodegaModel->obtenerInsumosEnBodega();

        // Buscar el lote específico
        $cantidadDisponible = 0;
        foreach ($insumosEnBodega as $lote) {
            if ($lote['ID_LOTE'] == $data['ID_LOTE_INSUMO_SALA']) {
                $cantidadDisponible = (int) $lote['CANTIDAD_DISPONIBLE'];
                break;
            }
        }

        $cantidadSolicitada = (int) $data['CANTIDAD_INSUMO_SALA'];

        if ($cantidadSolicitada > $cantidadDisponible) {
            return redirect()->to(base_url('/insumossalas'))->with('error', 'Cantidad Ingresada supera la Disponible');
        }

        // Si la cantidad es válida, registrar el insumo en sala
        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/insumossalas'))->with('message', 'Insumo registrado correctamente.');
        }

        return redirect()->to(base_url('/insumossalas'))->withInput()->with('errors', $this->model->errors());
    }

    // GET /insumossalas/edit/{id} - Mostrar el formulario para editar un insumo en sala
    public function edit($id = null)
    {
        $insumosala = $this->model->find($id);

        if ($insumosala) {
            // Obtener datos de las tablas Lote, Insumo y Sala
            $loteModel = new LoteModel();
            $salaModel = new SalaModel();
            $insumoModel = new InsumoModel();

            $lotes = $loteModel->findAll();
            $salas = $salaModel->findAll();
            $insumos = $insumoModel->findAll();

            // Pasar los datos a la vista
            return view('insumossalas/edit', [
                'insumosala' => $insumosala,
                'lotes' => $lotes,
                'salas' => $salas,
                'insumos' => $insumos
            ]);
        }
        return redirect()->to('/insumossalas')->with('error', 'No se encontró el insumo con ID: ' . $id);
    }

    // POST /insumossalas/update/{id} - Actualizar un insumo en sala
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Insumo actualizado exitosamente'
                ];
                return redirect()->to('/insumossalas')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/insumossalas')->with('error', 'No se encontró la salida con ID: ' . $id);
    }

    // DELETE /insumossalas/{id} - Eliminar un insumo en sala
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Salida de Bodega eliminada exitosamente'
                ];
                return redirect()->to('/insumossalas')->with('message', $response['message']);
            }
            return redirect()->to('/insumossalas')->with('error', 'Error al eliminar la salida');
        }

        return redirect()->to('/insumossalas')->with('error', 'No se encontró la salida con ID: ' . $id);
    }

}
