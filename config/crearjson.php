<?php
$arr_clientes = array(  'key'=> '5DCC67393750523CD165F17E1EFADD21', 
                        'usuario'=> 'SNBXUSR01', 
                        'psw'=> 'SECRETO',
                        'id_branch'=> '01SNBXBRNCH',
                        'id_company'=>'SNBX');
//Creamos el JSON
$json_string = json_encode($arr_clientes);
$file = 'config.json';
file_put_contents($file, $json_string);


?>