<?php


namespace App\Views;
use App\Classes\Vista;


class Home extends Vista{
    
    private $cont="";

    function __construct($dt)
     {
        $this->datos = $dt;
     }

    public function render()
    {
        $datos = $this->datos;

        foreach( $datos as $id => $vl )
        {
            $this->cont .= "<div><h3><strong>$id:</strong> $vl</h3></div>";
        }

        return $this->cont;
    }



}