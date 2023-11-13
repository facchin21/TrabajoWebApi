
    <?php
        class db{

            private $host = "localhost";
            private $dbname = "tp-web";
            private $user = "root";
            private $password = "";

            public function connection(){
                try{
                    $PDO = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
                    
                    return $PDO;
                }catch(PDOException $e){
                    return $e->getMessage();
                }
            }
        }

    // function mostrar(){
    //     $db = new PDO('mysql:host=localhost;dbname=tp-web;charset=utf8', 'root', '');
    //     $query = $db->prepare( "select * from transacciones");
    //     $query->execute();
    //     $transacciones = $query->fetchAll(PDO::FETCH_OBJ);
        
    //     foreach($transacciones as $transaccion){
    //         echo $transaccion->canal;
    //     }
    // }
    // mostrar();
    ?>
