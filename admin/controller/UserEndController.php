<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';


class UserEndController extends Database{

	protected $table='pages';
	protected $table_meta='meta';
	protected $table_image='image';
	protected $table_country='countries';

	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

	public function select_page(){
		$data = array(
			'id',
			'name',
			'slug'
		);
		$result = $this->select($this->table,$data,array('parent_id'=>'-1'));
		$pages = $this->fetch($result);
		return $pages;
	}

	public function page_info(){
		global $server_root;
		$id = $_GET['id'];
		$slug = $_GET['slug'];
		$error_data = array(
			'id',
			'slug'
		);
		$error_criteria = array(
			'id'=>"$id",
			'slug'=>"$slug"
		);
		$isId = $this->select($this->table,$error_data,$error_criteria);
		$fetch_isId = $this->fetch($isId);
		$count_found_id = count($fetch_isId);
		if($count_found_id == 1){
			$data = array(
				'*'
			);
		$criteria = array(
			'id'=>"$id"
		);
		$result = $this->select($this->table,$data,$criteria);
		$page_info = $this->fetch($result);
		return $page_info;
		}else{
			$redirect_path = $server_root.'index.php';				
			header("Location:$redirect_path");
		}
	}
	public function try(){

	}

	public function select_image(){
		$id = $_GET['id'];

		$data = array(
			'image_id'
		);
		$criteria = array(
			'page_id'=>"$id"
		);
		$result = $this->select($this->table_meta,$data,$criteria);
		$rows = $this->fetch($result);
		$get_id=[];
		foreach ($rows as $key => $value) {
			$get_id[] = $value['image_id'];
		}
		$images = $this->selectImage($this->table_image,$get_id);
		$page_image = $this->fetch($images);
		return $page_image;
	}

	public function dropdown_child($id){
		$data = array(
			'id',
			'name',
			'slug'
		);
		$criteria = array(
			'parent_id'=>"$id"
		);
		$result = $this->select($this->table,$data,$criteria);
		$sub_page = $this->fetch($result);
		return $sub_page;
	}

	public function select_country(){
		$data = array(
			'*'
		);
		$country = $this->select($this->table_country,$data);
		$fetch_country = $this->fetch($country);
		return $fetch_country;
	}
}



