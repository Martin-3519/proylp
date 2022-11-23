<?php

namespace App\Http\Controllers;
use \App\Classes\Controlador;
use \App\Http\Response;

class NuevoController extends Controlador
{
    private $archivo = "estudiantes.txt";

    function index()
    {
  
    $art = sprintf(__DIR__ . "/../Models/%s", $this->archivo);

    $txt = file($art);
    
    foreach ($txt as $val ) {
 
        $eg = explode (":",$val);
        
        $sanz[] = [ $eg[0], $eg[1]];


        //var_dump($eg[0]++);
    
    }
    return (new response("Nuevo",$sanz));

}
//-------------------------------------------------------------------------------------------------//
        function form()
        {
       
        $f=["text" => "Buscar" ,"submit" => "Enviar" ,"action" => "Buscar"];

        //$this -> $f;
        //var_dump($f);

    
        return (new response("NuevoForm",$f));
        }
        

        function buscar()
        {
           
            if(isset($_POST))
            {
                $art = sprintf(__DIR__ . "/../Models/%s", $this->archivo);

                $txt = file($art);
                $buscar=$_POST["Buscar"];
                foreach ($txt as $val ) {
             
                    $eg = explode (":",$val);
                    $encontreNombre=stripos($eg[0],$buscar);
                    $encontreApellido=stripos($eg[1],$buscar);
                    if($encontreNombre!==false || $encontreApellido!==false)
                    {
                        $sanz[] = [ $eg[0], $eg[1]];
                    }
            
                    //var_dump($eg[0]++);
                
                }
               
                $f=["text" => "Buscar" ,"submit" => "Enviar" ,"action" => "Buscar","datos"=>$sanz];
            }
            else{
                $f=["text" => "Buscar" ,"submit" => "Enviar" ,"action" => "Buscar"];
            }
            echo "";
            
        
            //var_dump($_POST['Buscar']);

       
    
        return (new response("NuevoForm",$f));
        }
        
        
        }


        
        

      




    


