<?php

require_once __dir__.'/../model/database.php';
class ajaxData extends Database{
    protected $table_states='states';

    public function select_country(){
        $data = array(
            '*'
        );
        var_dump($data);

        $criteria = array(
            'country_id'=>$_POST['country_id']
        );
        $query = $this->select($this->table_states,$data,$criteria);

         $rowCount = $query->num_rows;    
        //State option list
        if($rowCount > 0){
            echo '<option value="">Select state</option>';
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
            }
        }else{
            echo '<option value="">State not available</option>';
        }
    }
}

$counrty = new ajaxData();
$counrty->select_country();

// Database credentials
// $dbHost     = 'localhost';
// $dbUsername = 'root';
// $dbPassword = '';
// $dbName     = 'phpassignment';

// //Connect and select the database
// $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// if ($db->connect_error) {
//     die("Connection failed: " . $db->connect_error);
// }
// if(!empty($_POST["country_id"])){
//     //Fetch all state data
//     $query = $db->query("SELECT * FROM states WHERE country_id = ".$_POST['country_id']);
    
//     //Count total number of rows
//     $rowCount = $query->num_rows;
    
//     //State option list
//     if($rowCount > 0){
//         echo '<option value="">Select state</option>';
//         while($row = $query->fetch_assoc()){ 
//             echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
//         }
//     }else{
//         echo '<option value="">State not available</option>';
//     }
// }
// elseif(!empty($_POST["state_id"])){
//     //Fetch all city data
//     $query = $db->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']);
    
//     //Count total number of rows
//     $rowCount = $query->num_rows;
    
//     //City option list
//     if($rowCount > 0){
//         echo '<option value="">Select city</option>';
//         while($row = $query->fetch_assoc()){ 
//             echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
//         }
//     }
//     else{
//         echo '<option value="">City not available</option>';
//     }
// }
 