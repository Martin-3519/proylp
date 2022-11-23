<?php

namespace App\Views;
use App\Classes\Vista;


class PersonasEdit extends Vista
{

    function __construct($dt)
    {
        $this->datos = $dt;
    }


    function render()
    {

       $formulario = sprintf( "<form action = '%s'  
       method = 'post'>",  $this->datos['action'] )  ;
  
      

       foreach( $this->datos['input'] as $clave => $valor )
       {
          
           $activo =  $clave == 'id'?'disabled':'';

           $formulario .= sprintf('
           <label>%s</label>
           <input type = text  name = "%s" value="%s" %s > ',
            $clave,$clave, $valor,$activo);

       }
       $formulario .= "<input type=submit name=guardar value=guardar>";
       $formulario .= '</form>';
       
       return($formulario);
     }

    }

