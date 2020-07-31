
<?php

class Conexion {
 
    // Local 
    private $driver = "mysql";
    private $host = "localhost";
    private $port = 3306;
    private $user = "root";
    private $pass = "";
    private $dbName =  "participemos";
    private $charset = "utf8";

    protected $pdo ;
    private $contTransacciones = 0;

    public $usuarioConectado = "";

    public function __construct(){

		try {
            // var_dump("voy a construir la conexion");

            // if(func_num_args()>0){
            //     //uso la conexion que me pasaron
            //     $this->pdo = func_get_arg(0);
            // } else {
                // var_dump("voy a construir el PDO");

                $pdo = new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbName};charset={$this->charset}",$this->user,$this->pass);
                // var_dump("ya construi el pdo");

                if($pdo){
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
                    
                    $this->pdo = $pdo;
                } else {
                    // var_dump("error al creare la conexion");
                    throw new Exception("error en la conexion la creación de la conexión");
                }              
            // }
			
            
        } catch (PDOException $err){
            throw $err;
        } catch (Error $err){
            throw $err;
        } catch (Exception $ex){
            throw $ex;
        }
    
    }
    
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }

    public function beginTrans(){
        return true;

            if($this->contTransacciones == 0){
                if(!$this->pdo->beginTransaction()){                    
                    return false;
                }
            }
            $this->contTransacciones +=1;
            // var_dump("comienza transaccion:",$this->contTransacciones);
            return true;
    }

    public function commitTrans(){
        return true;

        if($this->contTransacciones == 1){
            if(!$this->pdo->commit()){
                return false;
            }
        }
        $this->contTransacciones -=1;
        // var_dump("confirma transaccion:",$this->contTransacciones);
        return true;
    }

    public function rollbackTrans(){
        return true;

        if(!$this->pdo->rollBack()){
            return false;
        }
        $this->contTransacciones =0;
        // var_dump("va para atras transaccion:",$this->contTransacciones);
        return true;
        
    }


   
    // private function conex(){

    //     try {
    //         $pdo = new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbName};charset={$this->charset}",$this->user,$this->pass);

    //         if($pdo){
    //           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //           return $pdo;
    //         } else {
    //             throw new Exception("error en la conexion la creación de la conexión");
    //         }

    //     } catch (PDOException $err){
    //         throw $err;
    //     } catch (Error $err){
    //         throw $err;
    //     } catch (Exception $ex){
    //         throw $ex;
    //     }

    // }

  

}


?>
