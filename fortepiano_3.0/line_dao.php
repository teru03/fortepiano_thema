<?php
final class line_dao {

    private $db = null;
    private $username;
    private $password;
    private $dbname;
    private $hostname;

    function __construct($user,$pass,$name,$hostname) {
        $this->username = $user;
        $this->password = $pass;
        $this->dbname = $name;
        $this->hostname = $hostname;
    }
  
    public function __destruct() {
        // close db connection
        $this->db = null;
    }

   public function select($sql) {
        $stmt = $this->getDb()->query($sql);
        if( !$stmt ){
            $this->errthrow();
        }
        return $stmt;
    }

   public function connect() {
        if ($this->db === null) {
            try {
                $dsnstr = 'mysql:dbname='.$this->dbname.';host='.$this->hostname;
                $this->db = new PDO($dsnstr, $this->username, $this->password);
            } catch (PDOException $ex) {
                throw new Exception('DB connection error: ' . $ex->getMessage());
            }
        }
        return;
    }
       
    public function getEditPermission(){
        //ユーザー権限を確認する予定
        return true;
    }
            
   public function lock($table) {
        $this->getDb()->beginTransaction();
        $sql = "lock table ".$table." nowait";
        $stmt = $this->getDb()->query($sql);
        if( !$stmt ){
            $this->errthrow();
        }
        return;
    }

   public function commit() {
        try{
            $stmt = $this->getDb()->commit();
            if(!$stmt){
                $this->errthrow();
            }
        }
        catch(PDOException $ex){
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
    }

   public function rollback() {
        $stmt = $this->getDb()->rollBack();
        if(!$stmt){
            $this->errthrow();
        }
        return;
    }

   public function prepare($sql) {
       $stmt = $this->getDb()->prepare($sql);
        if( !$stmt ){
            $this->errthrow();
        }
        
       return $stmt;
    }

   public function execute($stmt,$ary) {
       $ret = $stmt->execute($ary);
       
       return $ret;
    }
        
   public function insert($sql) {
       $stmt = $this->getDb()->query($sql);
        if( !$stmt ){
            $this->errthrow();
        }
        
        $recidlist = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $recidlist[] = $row['rec_id'];
        }
        $stmt = null;
        return $recidlist;
    }

   public function update($sql) {
        $cnt = 0;
        $stmt = $this->getDb()->query($sql);
        if( $stmt ){
            $cnt = $stmt->rowCount();
            $stmt = null;
        }
        else{
            $this->errthrow();
        }
        return $cnt;
    }
    
   public function delete($sql) {
        $stmt = $this->getDb()->query($sql);
        if( !$stmt ){
            $this->errthrow();
        }
        
        $recidlist = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $recidlist[] = strval($row['rec_id']);
        }
        $stmt = null;
        return $recidlist;
    }

   private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        try {
            $dsnstr = 'pgsql:dbname='.$this->dbname.';host='.$this->hostname.';port=3306';
            $this->db = new PDO($dsnstr, $this->username, $this->password);
        } catch (PDOException $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }
    
    private function errthrow(){
        $errorInfo = $this->getDb()->errorInfo();
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }
    
}

$fp = null;
function line_log( $message ){
    global $fp;
    
    $message = date( "Y/m/d" , time() )." ".$message;
    
    fwrite( $fp, $message, strlen($message) );
}

function vdump($obj){
    ob_start();
    var_dump($obj);
    $dump = ob_get_contents();
    ob_end_clean();
    return $dump;
}
?>
