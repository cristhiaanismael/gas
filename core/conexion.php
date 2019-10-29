<?php
error_reporting(E_ALL);
class Conectar{
	private $datos= array(
                "driver"    =>"mysqli",
                "host"      =>"localhost",
                "user"      =>"user_marvifet",
                "pass"      =>"marvifet1234@GAS2493?",
                "database"  =>"marvifet",
                "charset"   =>"utf8"
                );
	private $con;
   
    public function __construct() {
        
         $this->con=new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['database']);

    	if (mysqli_connect_errno()) {
     		printf("Conexión fallida: %s\n", mysqli_connect_error());
         	exit();
     	}
       //
    }
     
      public function consultaRetorno($query){
        self::debugue($query);
        $this->con->set_charset( 'utf8' );
		$datos=$this->con->query($query);
		return $datos;
	}   
	public function consultasimple($query){
        self::debugue($query);
		$datos=$this->con->query($query);
	}    
    public function consultainsert($query){
        self::debugue($query);
        $datos=$this->con->query($query);
         return $id= mysqli_insert_id($this->con);
        //Sreturn $id
       // mysqli_insert_id
    }
    public function debugue($query){
        if(isset($_REQUEST['test'])){
            $test=$_REQUEST['test'];
            $length=strlen($test);  
            $codigo=substr($test, 1,$length);
            if($codigo==psw_dev){
                echo $query.'<br>';
            }
        }

    }  

}

?>