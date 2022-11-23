<?php

namespace App\Http\Controllers;
use App\Http\Response;
use App\Classes\Controlador;
use App\Http\Models\DB;

//getInstance()
//getArray($query, $type = MYSQLI_ASSOC)
//function query($query)

class PersonasController extends Controlador
{
    private $bd ;
    private $campos;

    function __construct()
    {

        $this->bd = DB::getInstance();
        
        $this->campos = [
            "usuario",                  
            "clave",     
            "fecha",     
            "descripcion",
        ];
        
    }


    function index()
    {
        $SQL = "SELECT * FROM personas";
        $personasBD = $this->bd->getArray($SQL);

        if ( count($personasBD) == 0)
        {
            $personasBD[] = ["resultado" => "sin datos"];
        }
    
        return ( new Response('personas', $personasBD));
 
    }

    function form()
    {
        $form = [ "action" => "/personas/buscar",
                 "text" => "txtbuscar" , 
                 "submit" => "buscar"];
        
        return ( new Response('Form',$form));

    }

function buscar()
{
    if ( empty($_POST))
    {
        return( $this->index());
    }




    $SQL = "SELECT * FROM personas WHERE
    nombre_producto like '%". $_POST["txtbuscar"] . "%' ";

    $personasBD = $this->bd->getArray($SQL);

    if ( count($personasBD) == 0)
    {
        $personasBD[] = ["resultado" => "sin datos"];
    }


    return ( new Response('personas', $personasBD));
}

function editar($idUser = '')
{
    if ( empty($idUser )  )
    {
        return( $this->index());
    }

    

    $SQL = "SELECT * FROM personas WHERE idUser = $idUser ";

    $personasBD = $this->bd->getArray($SQL);

    if ( count($personasBD) == 0)
    {
        $personasBD[] = ["resultado" => "sin datos"];
    }else{
        $datos = [ 
            "input" => $personasBD[0] ,
            "action" => "/personas/actualizar/$idUser"];
        return ( new Response('PersonasEdit',$datos));
    }

    
    return ( new Response('personas', $personasBD));

}


function actualizar($idUser = '')
{
 

    if ( empty( $_POST )  )
    {
        return( $this->index());
    }

    unset( $_POST["guardar"]);

    $clave = empty($idUser) ?"NULL": $idUser;        
    
    $SQL = sprintf("REPLACE INTO personas VALUES(%s,'%s');",
    $clave, implode("','", array_values($_POST)));

    var_dump($SQL);
    
     $this->bd->query($SQL);

     return ( $this->index());

}


function nuevo()
{

    $datosvacios = array_fill(0,count($this->campos),'');
    
echo  "<hr>";
    $personasNUEVO =  array_combine($this->campos, $datosvacios);
    

    $datos = [ 
        "input" => $personasNUEVO ,
        "action" => "/personas/actualizar"];
    return ( new Response('PersonasEdit',$datos));


}

function borrar($idUser = '')
{

    if ( empty($idUser))
    {
        return (  $this->index());
    }

    $SQL =  sprintf("DELETE FROM personas WHERE idUser = '%s'",$idUser);
    
    echo "$SQL";
    $this->bd->query($SQL);

    return($this->index());
}



}