<?php
require_once __dir__.'/DatabaseController.php';
session_start();

class User extends DatabaseController{

	protected $tableName = 'pages';
	protected $table = 'users';
	protected $table_image='image';
	protected $table_meta='meta';


	public function __construct(){
        parent::__construct();
    }

    public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

	public function getAdmin($id=""){
		$data=array(
			'*'
		);
		$field = $this->editAdmin($data,array('id'=>"$id"));
		$rows = $this->fetch($field);
		return $rows;
	}

	public function select_image($id){
		if(empty($id)) return false;
		$data=array(
			'image_id'
		);
		$result = $this->view_image($data,$id);
		$rows = $this->fetch($result);
		$get_id=[];
		foreach ($rows as $key => $value) {
			$get_id[] = $value['image_id'];
		}
		$images = $this->select_image_of_page($get_id);
		$page_image = $this->fetch($images);
		return $page_image;
	}

	public function isLoginUser(){
		if(isset($_POST['email']) && isset($_POST['password'])){
			$email=$_POST['email'];
			$password=$_POST['password'];
			if(isset($_POST['remember'])){
				$remember=$_POST['remember'];
			}
			$data=array(
		 		'*'
		 		);
		 	$field=array(
		 		'email'=>"$email",
		 		'password'=>"$password"
		 	);
		 	$login = $this->loginSelect($data,$field);

		 	if((mysqli_num_rows($login))==1){
		 		if($remember == '1' || $remember == 'on'){
                	$hour = time() + 3600 * 24 * 30;
                	setcookie('email', $email, $hour);
                	setcookie('password', $password, $hour);
            	}
            	$_SESSION['login']="login";
            	$_SESSION['user']="user";
		 		header('Location:index.php');
		 	}else{
		 		echo "Invalid email and password";
		 	}
	 	}				
	}

	public function deleteImg_page(){
		$id = $_POST['delete-image'];

		$data=array(
			'id'=>"$id"
			);
		$field = array(
			'image'
		);
		$select = $this->selectNameOfImage($field,$id);
		$imgName=mysqli_fetch_assoc($select);
		foreach ($imgName as $key => $value) {
			$name = $value;
		}
		$page_id=array(
			'page_id'
		);
		$selectPageid = $this->select_pageID($page_id,$id);
		$rows = $this->fetch($selectPageid);
		foreach ($rows as $key => $value) {
			$page_id_redirect = $value['page_id'];
		}
		$delete = $this->delImage($data);

		if($delete == true){
			unlink('../admin/static/images/pageImage/' .$name);
			header('Location:home.php?page=view_image&id='.$page_id_redirect);
		}
	}


	public function addPageImage(){
		if(isset($_FILES['file']) && isset($_POST['addPageImage'])){
			$id=$_POST['addPageImage'];
			$file=$_FILES['file'];

			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
 			$newName = md5(time() . rand()) . '.' . $ext;
 			$tmpName = $file['tmp_name'];


 			$imagePath='../admin/static/images/pageImage/';
 			if(!move_uploaded_file($tmpName,$imagePath. $newName)){
 				echo "Image not saved";
			}
			if(!empty($newName)){
 				$data=array(
 					'image'=>"$newName"
 				);
 				$this->imagesInsert($data);
 				$data=array(
							'id'
							);
 				$result = $this->imageId($data,$newName);
 				$value = mysqli_fetch_assoc($result);
 				foreach ($value as $key => $image_id) {
 				}
 			}
 			$meta=array(
				'page_type'=>'page',
				'page_id'=>"$id",
				'image_id'=>"$image_id"
	 			);

			$meta_result = $this->meta_save($meta);
			if($meta_result == true){
				header('Location:home.php?page=view_image&id='.$id);
			}
		}
	}

	public function admin_manager(){
		$data = array(
			'*'
		);
		$field = $this->admin_manager_display($data);
		$rows = $this->fetch($field);
		return $rows;
	}
	public function changePassword(){
		if(empty($_POST['opassword']) || empty($_POST['npassword'])){
			$id=$_POST['edit-admin'];
			echo "Old password and New password cannot be empty";
		}else{
			$id=$_POST['edit-admin'];
			$oldPass=$_POST['opassword'];
			$newpass = $_POST['npassword'];

			$data=array(
				'password'
			);
			$admin = $this->select_oldPassword($data,$id);
			$rows = $this->fetch($admin);
			foreach ($rows as $key => $value) {
				$oldpassword =  $value['password'];
			}
			if($oldpassword <> $oldPass){
				echo "Old password doesnot matched";

			}
			if($oldpassword == $oldPass){
				$data=array(
					'password'=>"$newpass"
				);
				
				if($this->update_password($data,$id)){
					echo "password upated";
				}
			}
		}
	}
}
