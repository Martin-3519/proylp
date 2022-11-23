<?php

namespace App\Http\Controllers;
use App\Http\Response;
use App\Classes\Controlador;
use App\Http\Models\DB;

//getInstance()
//getArray($query, $type = MYSQLI_ASSOC)
//function query($query)

class IngredientesController extends Controlador
{
    private $bd ;
    private $campos;

    function __construct()
    {

        $this->bd = DB::getInstance();
        
        $this->campos = [
            "id",                  
            "nombre_producto",     
            "unidades_medida",     
            "descripcion_producto",
            "marca_producto",      
            "fecha_ingreso",       
            "cantidad",     
        ];
        
    }


    function index()
    {
        $SQL = "SELECT * FROM ingredientes";
        $ingredientesBD = $this->bd->getArray($SQL);

        if ( count($ingredientesBD) == 0)
        {
            $ingredientesBD[] = ["resultado" => "sin datos"];
        }
    
        return ( new Response('Ingredientes', $ingredientesBD));
 
    }

    function form()
    {
        $form = [ "action" => "/ingredientes/buscar",
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


echo "viene del formulario ". $_POST['txtbuscar'];

    $SQL = "SELECT * FROM ingredientes WHERE
    nombre_producto like '%". $_POST["txtbuscar"] . "%' ";

    $ingredientesBD = $this->bd->getArray($SQL);

    if ( count($ingredientesBD) == 0)
    {
        $ingredientesBD[] = ["resultado" => "sin datos"];
    }


    return ( new Response('Ingredientes', $ingredientesBD));
}

function editar($id = '')
{
    if ( empty($id )  )
    {
        return( $this->index());
    }

    

    $SQL = "SELECT * FROM ingredientes WHERE id = $id ";

    $ingredientesBD = $this->bd->getArray($SQL);

    if ( count($ingredientesBD) == 0)
    {
        $ingredientesBD[] = ["resultado" => "sin datos"];
    }else{
        $datos = [ 
            "input" => $ingredientesBD[0] ,
            "action" => "/ingredientes/actualizar/$id"];
        return ( new Response('IngredientesEdit',$datos));
    }

    
    return ( new Response('Ingredientes', $ingredientesBD));

}


function actualizar($id = '')
{
 

    if ( empty( $_POST )  )
    {
        return( $this->index());
    }

    unset( $_POST["guardar"]);

    $clave = empty($id) ?"NULL": $id;        
    
    $SQL = sprintf("REPLACE INTO ingredientes VALUES(%s,'%s');",
    $clave, implode("','", array_values($_POST)));

    var_dump($SQL);
    
     $this->bd->query($SQL);

     return ( $this->index());

}


function nuevo()
{

    $datosvacios = array_fill(0,count($this->campos),'');
    
echo  "<hr>";
    $ingredientesNUEVO =  array_combine($this->campos, $datosvacios);
    

    $datos = [ 
        "input" => $ingredientesNUEVO ,
        "action" => "/ingredientes/actualizar"];
    return ( new Response('IngredientesEdit',$datos));


}

function borrar($id = '')
{

    if ( empty($id))
    {
        return (  $this->index());
    }

    $SQL =  sprintf("DELETE FROM ingredientes WHERE id = '%s'",$id);
    
    echo "$SQL";
    $this->bd->query($SQL);

    return($this->index());
}



}