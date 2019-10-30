<?php
error_reporting(E_ALL);
class Conectar{
	private $datos= array(
                "driver"    =>"mysqli",
                "host"      =>"localhost",
                "user"      =>"root",
                "pass"      =>"",
                "database"  =>"verificon",
                "charset"   =>"utf8"
                );
	private $con;
   
    public function __construct() {
        
     $this->con=new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['database']);
    

    	if (mysqli_connect_errno()) {
     		printf("Conexión fallida: %s\n", mysqli_connect_error());
     	exit();
     	}
    }
     
      public function consultaRetorno($query){
             $this->con->set_charset( 'utf8' );
			$datos=$this->con->query($query);
			return $datos;
	}   
	public function consultasimple($query){
		$datos=$this->con->query($query);
      

	}    
        public function consultainsert($query){
        $datos=$this->con->query($query);
         return $id= mysqli_insert_id($this->con);
        //Sreturn $id
       // mysqli_insert_id

    }  

}

?>