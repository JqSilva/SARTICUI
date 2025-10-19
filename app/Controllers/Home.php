<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function catalogoSistema()
    {
        // Cargar la vista Relacionado al Catalogo del Sistema
        return view('catalogosistema');
    }

    public function relacionInsumos()
    {
        // Cargar la vista Relacionado a Insumos
        return view('relacioninsumos');
    }

    public function relacionLotes()
    {
        // Cargar la vista Relacionado a Lotes
        return view('relacionlotes');
    }

    public function relacionUsuarios()
    {
        // Cargar la vista Relacionado a Lotes
        return view('relacionusuarios');
    }

    public function relacionSubunidades()
    {
        // Cargar la vista Relacionado a Subunidades
        return view('relacionsubunidades');
    }

    public function relacionSolicitudes()
    {
        // Cargar la vista Relacionado a Subunidades
        return view('relacionsolicitudes');
    }

    public function relacionMantenciones()
    {
        // Cargar la vista Relacionado a Mantenciones
        return view('relacionmantenciones');
    }

    public function relacionPrestaciones()
    {
        // Cargar la vista Relacionado a Prestaciones
        return view('relacionprestaciones');
    }
}
