<?php


namespace App\Views;
use \App\Classes\Vista;

class Nuevo extends Vista
{

    function __construct($dt)
    {
       $this->datos = $dt;
    }

function render()
{
//for

        $html = "<h1>Nombre ". $this->datos[1][0] . " Apellido ".$this->datos[1][1] . "</h1>";

    return( $html);


        //if ($ea[0] == "Martin") {
        
        //echo ("Encontramos al pibe Martin");
    //}


}


}


    