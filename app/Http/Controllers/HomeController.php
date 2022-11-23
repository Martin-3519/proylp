<?php

namespace App\http\Controllers;
use \App\Classes\Controlador;
use \App\Http\Response;

class  HomeController extends Controlador
{

    public function index()
    {
        
        $dat = [
            "UTU" => "Escuela Técnica las Piedras",
            "Materia" => "PROGRAMACION III",
            "Proyecto" => "By Martin"
            
        ];

        return (new Response("Home", $dat));
    }

}