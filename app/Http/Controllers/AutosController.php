<?php

namespace App\Http\Controllers;
use App\Http\Response;
use App\Classes\Controlador;
use App\Http\Models\DB;

//getInstance()
//getArray($query, $type = MYSQLI_ASSOC)
//function query($query)

class AutosController extends Controlador
{
    private $bd ;
    private $campos;

    function __construct()
    {

        $this->bd = DB::getInstance();
        
        $this->campos = [
            "nombre_auto",                  
            "marca_auto",     
            "descripcion_auto",     
            "fecha_ingreso",
            "stock",
        ];
        
    }

}


