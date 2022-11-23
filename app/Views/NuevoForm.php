<?php


namespace App\Views;
use \App\Classes\Vista;

class NuevoForm extends Vista
{

    function __construct($dt)
    {
       $this->datos = $dt;
    }

    function render()
    {

    $forms = "<form action='/nuevo/buscar' method='POST'/>,'<input name='Buscar' type='text'>,<input type='submit' name='boton' value='Buscar'>";
    $forms .="<div>";

    if(isset($this->datos["datos"]))
    {
        $forms .="<ul>";
        foreach($this->datos["datos"] as $item)
        {
            $forms .="<li>".$item[0]." ".$item[1]."</li>";

        }
        $forms .="</ul>";
    }

    return($forms);

    }

}






    