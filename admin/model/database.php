<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'phpassignment');

class Database{

    public static $_instantiate = '';

    public function __construct(){
        $this->connection();
    }


    public function connection(){
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $con;
    }

    public static function instantiate(){
        if (!self::$_instantiate) {
            return self::$_instantiate = new Database();

        }
        return self::$_instantiate;
    }

    //  public function clean( &$data ){
    //     foreach( $data as $key => $value ){
    //         if( is_array( $value ) ){
    //             clean( $data[ $key ] );
    //         }else{
    //             $temp = trim($value);
    //             $temp = mysqli_real_escape_string($this->connection(),$value );
    //             $data[ $key ] = $temp;
    //         }
    //     }
    // }

    public function insert($tableName = "", $data = array()){
         # INSERT INTO TABLENAME SET name = 'hello', age='3';
        if( is_array( $data ) && count( $data ) > 0 ){
            // $this->clean($data);
            $sql = 'INSERT INTO ' . $tableName . ' SET ';

            foreach( $data as $field => $value ){
                $sql .= $field . '= "' . $value . '",';
            }
            $sql = rtrim( $sql, ',' );
            $result = mysqli_query($this->connection(),$sql);
            return $result;
        }
        return false;
    }

    public function delete($tableName="",$data){
        if( is_array( $data ) && count( $data ) > 0 ){
            $sql = 'DELETE FROM ' . $tableName. ' WHERE ';  
            foreach ($data as $field => $value){
                $sql .= $field. '="' .$value .'",';

                $sql = rtrim($sql,',');
                $result = mysqli_query($this->connection(),$sql);
                return $result;
            }        
        }
        return false;
    }

    public function update($tableName="",$data="",$criteria=""){
        if( is_array( $data ) && count( $data ) > 0 ){
            $sql = 'UPDATE ' . $tableName. ' SET ';

            foreach ($data as $field => $value){
                $sql .=$field .'="'.$value . '",';
            }
            $sql = rtrim( $sql,',');

            $sql .=' WHERE ';

            foreach ($criteria as $field => $value){
                $sql .=$field .'="'.$value . '"AND';
            }
            $sql = rtrim( $sql,'AND');
            $result = mysqli_query($this->connection(),$sql);
            return $result;
        }
        return false;
    }

    public function select($tableName = '',$data="",$criteria=""){
        if( is_array( $data ) && count( $data ) > 0 ){
            $sql="SELECT ";
            foreach ($data as $value) {
                $sql .=$value . ',';
            }
            $sql= rtrim( $sql,',');
            $sql.=' FROM '. $tableName;
            if (!empty($criteria)) {
                 $sql.=' WHERE ';
                foreach ($criteria as $key => $value) {
                    $sql .=$key.'="' .$value. '" AND ';                     
                }
                $sql = substr($sql,0,-4);
            }
            $result= mysqli_query($this->connection(),$sql);
            return $result;               
        }
        return false;
    }

    public function selectImage($tableName='',$data=''){
        if(is_array($data) && count($data)>0){
            $sql = "SELECT id,image,crop FROM $tableName WHERE";
            foreach ($data as $key => $value) {
                $sql .= ' id="' .$value. '" OR';
            }
            $sql = rtrim($sql,'OR');
            $result= mysqli_query($this->connection(),$sql);
            return $result;
        }
        return false;
    }

    public function select_recent_post($tableName){
        $sql = "SELECT * FROM (
                        SELECT * FROM $tableName WHERE isactive = 1 ORDER BY id DESC LIMIT 4 
                        ) as r ORDER BY id";
        $result= mysqli_query($this->connection(),$sql);
        return $result;
    }

    public function select_page_bar($tableName,$data=''){
        $sql = "SELECT COUNT( * ) AS pagination FROM $tableName";
        if (!empty($data)) {
             $sql.=' WHERE ';
            foreach ($data as $key => $value) {
                $sql .=$key.'="' .$value. '" AND ';                     
            }
            $sql = substr($sql,0,-4);
        }
        $result = mysqli_query($this->connection(),$sql);
        return $result;
    }

        public function pagination($tableName,$offset,$limit,$criteria=''){
        $sql = "SELECT * FROM (
                        SELECT * FROM $tableName";
                        if (!empty($criteria)) {
                            $sql.=' WHERE ';
                            foreach ($criteria as $key => $value) {
                                $sql .=$key.'="' .$value. '" AND ';                     
                            }
                            $sql = substr($sql,0,-4);
                        }
                        $sql .=" ORDER BY id LIMIT $offset,$limit 
                        ) as r ORDER BY id";
        $result= mysqli_query($this->connection(),$sql);
        return $result;
    }
}