<?php

namespace App\Views;
use App\Classes\Vista;


class Form extends Vista
{

    function __construct($dt)
    {
        $this->datos = $dt;
    }


    function render()
    {

        $formulario = sprintf( "<form action = '%s'  
        method = 'post'>",  $this->datos['action'] )  ;
        
        
        array_shift($this->datos);

        foreach( $this->datos as $clave => $valor )
        {

            $formulario .= sprintf('<input type = %s  name = %s> ',
             $clave, $valor);

        }
        $formulario .= '</form>';
        
        return($formulario);

    }


}