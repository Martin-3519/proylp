<?php

namespace App;
use App\Http\Request;
use App\Http\Response;

class AppInicio{

    private $controlador;
    private $metodo;
    private $parametros;
    private $request;
    private $vista;

    function __construct()
    {
        $this->iniciarApp();
    }

    function iniciarApp()
    {
            $this->request= new Request;
            $this->controlador = ($this->request)->getControlador();
            $this->metodo = ($this->request)->getMetodo();
            $this->vista = ($this->request)->getVista();
            $this->parametros = ($this->request)->getParametros();   
    }

    public function send()
    {
		
        $response = call_user_func_array(   [ new $this->controlador , 
                                            $this->metodo ],
                                            $this->parametros
                                        );    
      
      
      $response->send();

    }
        
}
