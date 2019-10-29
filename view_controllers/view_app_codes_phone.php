<?php
/**
 * 
 */
class view_app_codes_phone
{



	public function table($data){
		$table='
		<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>col1</th>
                <th>col2</th>
                <th>col3</th>
                <th>fecha de registro</th>
                <th></th>

            </tr>
        </thead>
        <tbody>';

        while ($fila=mysqli_fetch_array($data)){
        $table.='
            <tr    >
                <td id="col1'.$fila[0].'"> '.$fila[0].'</td>
                <td id="col2'.$fila[0].'">'.$fila[1].'</td>
                <td id="col3'.$fila[0].'">'.$fila[2].'</td>
                <td id="col4'.$fila[0].'">'.$fila['fecha_register'].'</td>
                <td > ';

            

         $table.='            
                </td>
            </tr>';
         }
         $table.=' 
        </tbody>
        <tfoot>
            <tr>
                <th>col1</th>
                <th>col2</th>
                <th>col3</th>
                <th>fecha de registro</th>
                <th></th>


            </tr>
        </tfoot>
    </table>
   
    <script type="text/javascript">
   $(document).ready(function() {
   $(\'#example\').DataTable( {
    responsive:true        
} );       
        
} ); 

    </script> ';
    

return $table;



	}
}



?>