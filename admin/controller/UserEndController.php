<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';


class UserEndController extends Database{

	protected $table='pages';
	protected $table_meta='meta';
	protected $table_image='image';
	protected $table_country='countries';
	protected $table_suscriber='subscriber';
	protected $table_post = 'post';
	protected $table_slider = 'slider';

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
			$redirect_path = $server_root;				
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
			'page_id'=>"$id",
			'page_type'=>'page'
		);
		$result = $this->select($this->table_meta,$data,$criteria);
		$rows = $this->fetch($result);
		if(count($rows) > 0){
			$get_id=[];
			foreach ($rows as $key => $value) {
				$get_id[] = $value['image_id'];
			}
			$images = $this->selectImage($this->table_image,$get_id);
			$page_image = $this->fetch($images);
			return $page_image;
		}
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

	public function suscriber_me(){
		global $server_root;
		$email = $_POST['email'];
		$data = array('email');
		$email_db = $this->select($this->table_suscriber,$data,array('email'=>"$email"));
		$fetch_email = $this->fetch($email_db);
		if(count($fetch_email) > 0 ){
			$message = 'You have already subscribed';
			return $message;
		}else{
			$data = array(
				'email'=>"$email"
			);
			if($this->insert($this->table_suscriber,$data)){
		    	$_SESSION['subscribe']="subscribe";
		    	header('Location:'.$server_root.'user/success');
			}			
		}
	}

	public function recent_post(){
		$recent_post_db = $this->select_recent_post($this->table_post);
		$recent_3_post = $this->fetch($recent_post_db);
		return $recent_3_post;
	}


	public function select_image_recent($id){
		$condition = array(
			'page_id'=>"$id",
			'page_type'=>'post'
		);
		$meta_image_id = $this->select($this->table_meta,array('image_id'),$condition);
		$fetch_image_id = $this->fetch($meta_image_id);
		foreach ($fetch_image_id as $key => $value) {
			$id = $value['image_id'];
		}

		$select_image = $this->select($this->table_image,array('*'),array('id'=>"$id"));
		$fetch_image = $this->fetch($select_image);
		return $fetch_image;
	}

	public function select_post_info(){
		global $server_root;
		$id = $_GET['id'];
		$error_data = array(
			'id',
		);
		$error_criteria = array(
			'id'=>"$id",
		);
		$isId = $this->select($this->table_post,$error_data,$error_criteria);
		$fetch_isId = $this->fetch($isId);
		$count_found_id = count($fetch_isId);
		if($count_found_id == 1){
			$data = array(
				'*'
			);
		$criteria = array(
			'id'=>"$id"
		);
		$result = $this->select($this->table_post,$data,$criteria);
		$page_info = $this->fetch($result);
		return $page_info;
		}else{
			$redirect_path = $server_root;				
			header("Location:http://localhost/cms");
		}
	}

	public function select_image_post(){
		$id = $_GET['id'];

		$data = array(
			'image_id'
		);
		$criteria = array(
			'page_id'=>"$id",
			'page_type'=>'post'
		);
		$result = $this->select($this->table_meta,$data,$criteria);
		$rows = $this->fetch($result);
		if(count($rows) > 0){
			$get_id=[];
			foreach ($rows as $key => $value) {
				$get_id[] = $value['image_id'];
			}
			$images = $this->selectImage($this->table_image,$get_id);
			$page_image = $this->fetch($images);
			return $page_image;
		}
	}

	public function select_slider(){
		$select_slider_db = $this->select($this->table_slider,array('*'));
		$fetch_slider = $this->fetch($select_slider_db);
		return $fetch_slider;
	}

	public function select_footer_page(){
		$data = ['*'];
		$condition = ['parent_id'=>'-2'];
		$footer_db = $this->select($this->table,$data,$condition);
		$fetch_footer = $this->fetch($footer_db);
		return $fetch_footer;
	}
}