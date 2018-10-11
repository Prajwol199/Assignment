<?php

require_once __dir__.'/../model/database.php';

class DatabaseController{
	protected $tableName;
	protected $table;
    protected $table_image;
    protected $table_meta;
    private $db = null;    

    //call to db
    public function __construct(){
        $this->db = Database::instantiate();

    }

    public function save($data = array()){
    	if (empty($data)) return false;
    	return $this->db->insert($this->tableName, $data);
    }

    public function imageId($data,$newName){
        if (empty($data)) return false;
        return $this->db->select($this->table_image,$data,array('image'=>"$newName"));
    }

    public function pageId($data,$name,$description){
        if(empty($data)) return false;
        return $this->db->select($this->tableName,$data,array('name'=>"$name",'description'=>"$description"));
    }

    public function meta_save($data){
        if (empty($data)) return false;
        return $this->db->insert($this->table_meta,$data);
    }

    public function allUser($data=array()){
        if (empty($data)) return false;
    	return $this->db->select($this->tableName,$data);
    }

    public function delete($data=array()){
        if (empty($data)) return false;
    	return $this->db->delete($this->tableName,$data);
    }

    public function delImage($data){
        if(empty($data)) return false;
        return $this->db->delete($this->table_image,$data);
    }

    public function updatePage($data,$array){
        if (empty($data)) return false;
        return $this->db->update($this->tableName,$data,$array);
    }

    public function delete_meta($id){
        if(empty($id)) return false;
        return $this->db->delete($this->table_meta,array('page_id'=>"$id"));
    }

    public function dropdown($data){
        if (empty($data)) return false;
        return $this->db->select($this->tableName,$data);
    }

    public function loginSelect($data,$field){
        if (empty($data)) return false;
        return $this->db->select($this->table,$data,$field);
    }

    public function imagesInsert($data){
        if (empty($data)) return false;
        return $this->db->insert($this->table_image,$data);
    }

    public function displayImage($data){
        if(empty($data)) return false;
        return $this->db->select($this->table_image,$data);
    }

    //code for image in image manager
    public function selectId($data,$id){
        if(empty($data)) return false;
        return $this->db->select($this->tableName,$data,array('id'=>"$id"));
    }

    public function view_image($data,$id){
        if(empty($data)) return false;
        return $this->db->select($this->table_meta,$data,array('page_id'=>"$id"));
    }

    public function select_image_of_page($data){
        if(empty($data)) return false;
        return $this->db->selectImage($this->table_image,$data);
    }

    public function selectNameOfImage ($data,$id){
        if(empty($data)) return false;
        return $this->db->select($this->table_image,$data,array('id'=>"$id"));
    }

    public function editUser($data,$array){
         if (empty($data)) return false;
    	return $this->db->select($this->tableName,$data,$array);
    }
    public function editAdmin($data,$array){
        if(empty($data) && empty($array)) return false;
        return $this->db->select($this->table,$data,$array);
    }

    public function admin_manager_display($data){
        if(empty($data)) return false;
        return $this->db->select($this->table,$data);
    }
    public function select_oldPassword($data,$id){
        if(empty($data)) return false;
        return $this->db->select($this->table,$data,array('id'=>"$id"));
    }

    public function update_password($data,$id){
        if(empty($data)) return false;
        return $this->db->update($this->table,$data,array('id'=>"$id"));
    }

    public function select_pageID($data,$id){
      if(empty($data)) return false;  
      return $this->db->select($this->table_meta,$data,array('image_id'=>"$id"));
    }
}