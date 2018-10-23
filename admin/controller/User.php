<?php
require_once __dir__.'/DatabaseController.php';
require_once __dir__.'/phpmailer.php';
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
			$encrypt = md5($password);
			if(isset($_POST['remember'])){
				$remember=$_POST['remember'];
			}
			$data=array(
		 		'*'
		 		);
		 	$field=array(
		 		'email'=>"$email",
		 		'password'=>"$encrypt"
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
 			$name = md5(time() . rand());
 			$newName =$name.'.'.$ext;
 			$tmpName = $file['tmp_name'];

 			$imagePath='../admin/static/images/pageImage/';
 			$cropimagePath='../admin/static/images/cropImage/';
 			if(!move_uploaded_file($tmpName,$imagePath. $newName)){
 				echo "Image not saved";
			}
			if($ext == 'PNG' || $ext == 'png'){
				$cropName = $name.'-thumbnail.'.$ext;
 				$im = imagecreatefrompng($imagePath.$newName);
 				// $size = min(imagesx($im), imagesy($im));
 				$sizeH='250';
 				$sizeW='250';
				$im2 = imagecrop($im, ['x' => 150, 'y' => 150, 'width' => $sizeW, 'height' => $sizeH]);
					if ($im2 !== FALSE) {							
					    $img = imagepng($im2, $cropimagePath.$cropName);
				    	imagedestroy($im2);
					}					
 			}else if ($ext == 'jpg'){
					$cropName = $name.'-thumbnail.'.$ext;
 				$im = imagecreatefromjpeg($imagePath.$newName);
 				$sizeH='250';
 				$sizeW='250';
				$im2 = imagecrop($im, ['x' => 150, 'y' => 150, 'width' => $sizeW, 'height' => $sizeH]);
					if ($im2 !== FALSE) {							
					    $img = imagejpeg($im2, $cropimagePath.$cropName);
				    	imagedestroy($im2);
					}
	 			}else{
	 				echo "Invalid extension";
	 			}

			if(!empty($newName)){
 				$data=array(
 					'image'=>"$newName",
 					'crop'=>"$cropName"
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
			$oldencrypt = md5($oldPass);
			$newpass = $_POST['npassword'];
			$newencrypt = md5($newpass);

			$data=array(
				'password'
			);
			$admin = $this->select_oldPassword($data,$id);
			$rows = $this->fetch($admin);
			foreach ($rows as $key => $value) {
				$oldpassword =  $value['password'];
			}
			if($oldpassword <> $oldencrypt){
				echo "Old password doesnot matched";

			}
			if($oldpassword == $oldencrypt){
				$data=array(
					'password'=>"$newencrypt"
				);
				
				if($this->update_password($data,$id)){
					echo "password upated";
				}
			}
		}
	}
}
