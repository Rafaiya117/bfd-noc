 <?php
 
class Database{
  private $conn = null;
  
    public function connect(){
      global $config;
      if($this->conn == null){
        try {
            $this->conn = new PDO("mysql:host={$config['db_host']};
            dbname={$config['db_name']}", $config['db_username'],$config['db_pass'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            page_blocking_message('Database Connection Error', 'We apologize for the inconvenience. 
        There seems to be an issue with the database connection. 
        Please contact our technical support team or system administrator to resolve the problem.');
            
            exit();
        }
    }
      
    //   $this->conn = new PDO("mysql:host={$config['db_host']};
    //   dbname={$config['db_name']}", $config['db_username'],$config['db_pass'],
    //   array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    //   $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  function __construct(){}
  function __destruct(){
      $this->conn = null;
  }
  public function prep_sql($sql){
    $this->connect();
      return $this->conn->prepare($sql);;
  }

  public function run_prep_sql($stmt, ...$parameters){
    $this->connect();
      $last_id = null;
      try {
       

  if (empty($parameters)) {
    $parameters = [];
  }

  $stmt->execute($parameters);
  $last_id = $this->conn->lastInsertId();
      }catch (PDOException $e) {
          echo 'Error: ', $e->getMessage();
      }
      return $last_id;
  } 
  
 
  public function action($sql, ...$parameters){
    $this->connect();
      $last_id = null;
      try {
          $stmt = $this->conn->prepare($sql);

  if (empty($parameters)) {
    $parameters = [];
  }

  $stmt->execute($parameters);
  $last_id = $this->conn->lastInsertId();
      }catch (PDOException $e) {
          echo 'Error: ', $e->getMessage();
      }
      return $last_id;
  } 

  function select($sql, ...$parameters) {
    $this->connect();
      $result = [];
      try {
          
          $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $stmt = $this->conn->prepare($sql);
  
          if (empty($parameters)) {
              $parameters = [];
          }
  
          $stmt->execute($parameters);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      } catch (PDOException $e) {
          echo 'Error: ', $e->getMessage();
          // var_dump($stmt->queryString);
          var_dump($parameters);
  
      }
      return $result;
  }

}




