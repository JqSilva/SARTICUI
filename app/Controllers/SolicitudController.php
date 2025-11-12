<?php
namespace App\Controllers;

use App\Models\SolicitudModel;
use App\Models\UsuarioModel;
use App\Models\SalaModel;
use App\Models\EstadoSolicitudModel;
use App\Models\DetalleSolicitudModel;
use App\Models\InsumoModel;

class SolicitudController extends BaseController
{
    protected $solicitudModel;
    protected $usuarioModel;
    protected $salaModel;
    protected $estadoModel;
    protected $detalleModel;
    protected $insumoModel;

    public function __construct()
    {
        $this->solicitudModel = new SolicitudModel();
        $this->usuarioModel = new UsuarioModel();
        $this->salaModel = new SalaModel();
        $this->estadoModel = new EstadoSolicitudModel();
        $this->detalleModel = new DetalleSolicitudModel();
        $this->insumoModel = new InsumoModel();
    }

    // Listado de solicitudes
    public function index()
    {
        $mes = $this->request->getGet('mes');
        $anio = $this->request->getGet('anio');

        // Nombres de meses en español (para el selector)
        $meses_es = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        // Construcción de la consulta con filtros opcionales
        $query = $this->solicitudModel->select('*');
        if (!empty($mes)) {
            $query->where('MONTH(FECHA_SOLICITUD)', $mes);
        }
        if (!empty($anio)) {
            $query->where('YEAR(FECHA_SOLICITUD)', $anio);
        }

        $solicitudes = $query->findAll();

        $usuarios = $this->usuarioModel->findAll();
        $salas = $this->salaModel->findAll();
        $estados = $this->estadoModel->findAll();

        foreach ($solicitudes as &$s) {
            $s['USUARIO_NOMBRE'] = $this->findValue($usuarios, 'ID_USUARIO', $s['ID_USUARIO_SOLICITUD'], 'NOMBRE_USUARIO');
            $s['SALA_NOMBRE'] = $this->findValue($salas, 'ID_SALA', $s['ID_SALA_SOLICITUD'], 'NOMBRE_SALA');
            $s['ESTADO_SOLICITUD_NOMBRE'] = $this->findValue($estados, 'ID_ESTADO_SOLICITUD', $s['ID_ESTADO_SOLICITUD_INS'], 'NOMBRE_ESTADO_SOLICITUD');
        }

        $data = [
            'solicitudes' => $solicitudes,
            'usuarios' => $usuarios,
            'salas' => $salas,
            'estadossolicitudes' => $estados,
            'mes' => $mes,
            'anio' => $anio,
            'meses_es' => $meses_es,
            'titulo' => 'Gestión de Solicitudes'
        ];

        return $this->renderView('modules/solicitudes/index', $data);
    }


    // Crear solicitud
    public function create()
    {
        $data = [
            'usuarios' => $this->usuarioModel->findAll(),
            'salas' => $this->salaModel->findAll(),
            'estadossolicitudes' => $this->estadoModel->findAll(),
            'insumos' => $this->insumoModel->findAll(),
            'titulo' => 'Nueva Solicitud'
        ];

        return $this->renderView('modules/solicitudes/create', $data);
    }

    // Guardar solicitud
    public function store()
    {
        $data = $this->request->getPost();

        $solicitudData = [
            'ID_USUARIO_SOLICITUD' => $data['ID_USUARIO_SOLICITUD'],
            'ID_SALA_SOLICITUD' => $data['ID_SALA_SOLICITUD'],
            'ID_ESTADO_SOLICITUD_INS' => $data['ID_ESTADO_SOLICITUD_INS']
        ];

        if ($this->solicitudModel->insert($solicitudData)) {
            $solicitudId = $this->solicitudModel->getInsertID();
            $detalleData = [];

            foreach ($data['insumos'] as $insumo) {
                $detalleData[] = [
                    'ID_SOLICITUD_DE' => $solicitudId,
                    'ID_INSUMO_DE' => $insumo['ID_INSUMO_DE'],
                    'CANTIDAD' => $insumo['CANTIDAD']
                ];
            }

            $this->detalleModel->insertBatch($detalleData);

            // Registrar trazabilidad (una entrada por solicitud)
            $trazabilidad = new \App\Controllers\TrazabilidadAccionController();
            $trazabilidad->registrarAccion(
                session('id'),
                $detalleData[0]['ID_INSUMO_DE'] ?? null,
                array_sum(array_column($detalleData, 'CANTIDAD')),
                'Creación de Solicitud Interna'
            );

            return redirect()->to('/solicitudes')->with('message', 'Solicitud creada exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al crear la solicitud');
    }

    // Editar solicitud
    public function edit($id = null)
    {
        $solicitud = $this->solicitudModel->find($id);
        if (!$solicitud) {
            return redirect()->to('/solicitudes')->with('error', 'No se encontró la solicitud.');
        }

        $data = [
            'solicitud' => $solicitud,
            'usuarios' => $this->usuarioModel->findAll(),
            'salas' => $this->salaModel->findAll(),
            'estadossolicitudes' => $this->estadoModel->findAll(),
            'titulo' => 'Editar Solicitud'
        ];

        return $this->renderView('modules/solicitudes/edit', $data);
    }

    // Actualizar solicitud
    public function update($id = null)
    {
        $data = $this->request->getPost();
        if ($this->solicitudModel->update($id, $data)) {
            $trazabilidad = new \App\Controllers\TrazabilidadAccionController();
            $trazabilidad->registrarAccion(
                session('id'),
                null,
                0,
                'Actualización de Solicitud'
            );
            return redirect()->to('/solicitudes')->with('message', 'Solicitud actualizada exitosamente');
        }
        return redirect()->back()->withInput()->with('error', 'Error al actualizar la solicitud');
    }

    // Auxiliar para nombres relacionados
    private function findValue($array, $keyMatch, $valueMatch, $keyReturn)
    {
        foreach ($array as $row) {
            if ($row[$keyMatch] == $valueMatch) {
                return $row[$keyReturn];
            }
        }
        return null;
    }
}
