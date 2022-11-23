<?php

namespace App\Views;
use App\Classes\Vista;


class Personas extends Vista
{

    function __construct($dt)
    {
        $this->datos = $dt;
    }


    function render()
    {
        $tabla =  '<table border=1>';

        foreach( $this->datos as $clave => $valor )
        {
            $tabla .= '<tr><td>'. implode("</td><td>", array_values($valor)) . '</td></tr>';
        }
        $tabla .= "</table>";
        
        return($tabla);

    }


    
}