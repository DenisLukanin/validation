<?php 
class Db {
    private $connection;
    private static $instance;
    private $table_name = "history";


    public static function get_instance(): Db {
        if (self::$instance === NULL){

            self::$instance = new self();
        }
        return self::$instance;
    }


    private function __construct(){
        $this->connect();

        if ($this->table_exists()) {
            $this->create_table();
        }
    }
    

    private function connect(){
        $connection = new PDO("mysql:host=localhost;dbname=validate;charset=utf8", "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $connection;
    }
    

    private function table_exists() : bool {
        $request = "SHOW TABLES LIKE '$this->table_name'";
        $statement = $this->connection->query($request);
        return $statement->fetch() == false;
    }


    public function create_table(){
        $reqest = "
            CREATE TABLE `$this->table_name` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
            `validateString` VARCHAR(100) NOT NULL , 
            `status` INT(11) NOT NULL 
        );";
        $result = $this->connection->prepare($reqest);
        $result->execute();
    }


    public function select(){
        $request = "SELECT * FROM $this->table_name";
        $result = $this->connection->prepare($request);
        $result->execute();
        return $result;
    }


    public function insert(array $columns){
        $names_columns = array_keys($columns);

        $names_columns_string = implode(", ", $names_columns);
        $keys_placeholder = implode(", ", array_map(fn ($item) => ":".$item, $names_columns) );
        $request = "insert into $this->table_name ($names_columns_string) value ($keys_placeholder)";
        $stm = $this->connection->prepare($request); 

        foreach ($columns as $key => $value){
            $stm->bindValue($key , $value);
        }

        $stm->execute();
    }
}

?>