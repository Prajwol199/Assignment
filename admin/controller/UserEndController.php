<?php
require_once __dir__.'/../model/database.php';

class UserEndController extends Database{

	protected $table='pages';
	protected $table_meta='meta';
	protected $table_image='image';

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
			'name'
		);
		$result = $this->select($this->table,$data);
		$pages = $this->fetch($result);
		return $pages;
	}

	public function page_info(){
		$id = $_GET['id'];
		$data = array(
			'*'
		);
		$criteria = array(
			'id'=>"$id"
		);

		$result = $this->select($this->table,$data,$criteria);
		$page_info = $this->fetch($result);
		return $page_info;
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
}



