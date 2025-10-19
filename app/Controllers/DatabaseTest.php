<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class DatabaseTest extends Controller
{
    public function index()
    {
        try {
            // Conecta con la base de datos
            $db = Database::connect();

            // Verifica si la conexión fue exitosa
            if ($db !== false && $db->table('insumo')->countAllResults() !== false) {
                echo "Conexión exitosa a la base de datos.";
            } else {
                echo "Error al conectar con la base de datos.";
            }
        } catch (\Exception $e) {
            // Muestra el error si ocurre algo
            echo "Error al conectar con la base de datos: " . $e->getMessage();
        }
    }
}
