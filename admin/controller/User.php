<?php
require_once 'Model.php';
session_start();

class User extends Model{

	//use isValidLoginUser;//trait

	protected $tableName = 'pages';
	protected $table = 'users';
	protected $table_image='image';
	protected $table_meta='meta';


	public function __construct()
    {
        parent::__construct();
    }

	public function AddUser(){
		if(isset($_POST['name']) && isset($_POST['des']) && isset($_FILES['file'])){
			if(empty($_POST['name']) || empty($_POST['des'])){
				echo "Page name and Description cannot be empty";
			}else{
				$name = $_POST['name'];
				$description = $_POST['des'];
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
		 					echo $image_id;
		 				}

		 				$page_field=array(
		 					'name'=>"$name",
		 					'description'=>"$description"
		 				);
		 				$save = $this->save($page_field);

		 				
		 				$page_id=array(
		 					'id'
		 				);
		 				$id_page = $this->pageId($page_id,$name,$description);
		 				$value_page = mysqli_fetch_assoc($id_page);
		 				foreach ($value_page as $key => $id_page) {
		 					echo $id_page;
		 				}

		 				$meta=array(
		 					'page_type'=>'page',
		 					'page_id'=>"$id_page",
		 					'image_id'=>"$image_id"
		 				);

		 				$meta_result = $this->meta_save($meta);
		 				if($meta_result == true){
		 					header('Location:home.php?page=page_manager');
		 				}

		 			}
		 		}

 			}
		}


	public function getuser(){

		$data=array(
			'*'
		);

		$field=$this->allUser($data);
		$rows=array();
		while($row=mysqli_fetch_assoc($field)){
			$rows[]=$row;
		}
		return $rows;
	}

	public function deleteUsers(){
		$id=$_POST['delete-page'];

		$data=array(
			'id'=>"$id"
		);

		$delete = $this->delete($data);

		if($delete == true){
			$delete_meta = $this->delete_meta($id);
			$_SESSION['msg'] = "page deleted";
			header('Location:home.php?page=page_manager');
		}
	}

	public function getUsers($id=""){
		$data=array(
			'*'
		);
		$field = $this->editUser($data,array('id'=>"$id"));
		$rows=[];
		while($row=mysqli_fetch_assoc($field)){
			$rows[]=$row;
		}
		return $rows;
	}

	public function getAdmin($id=""){
		$data=array(
			'*'
		);
		$field = $this->editAdmin($data,array('id'=>"$id"));
		$rows=[];
		while($row=mysqli_fetch_assoc($field)){
			$rows[]=$row;
		}
		return $rows;
	}

	public function updateUser($id){
		$data = [];
		if(isset($_POST['name']) && isset($_POST['des'])){
			if(empty($_POST['name']) || empty($_POST['des'])){
				echo "Page name and Description cannot be empty";
			}else{
				$data['name'] = $_POST['name'];			
				$data['description'] = $_POST['des'];			


				$update = $this->updatePage($data,array('id'=>"$id"));

				if($update == true){
					$_SESSION['msg'] = "page edited";
					header('Location:home.php?page=page_manager');
				}
			}
		}
	}

	public function selectimage(){
		$data=array(
			'id',
			'image'
		);
		$imageName = $this->displayImage($data);
		$rows=[];
		while($row=mysqli_fetch_assoc($imageName)){
			$rows[]=$row;
		}
		return $rows;
	}

	public function addImage(){
		if(isset($_FILES['file'])){
				if($_FILES['file']['size'] == 0){
					echo"File is empty";
				}else{
				$file = $_FILES['file'];

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
	 			}
	 		}
		}
	}


	public function select_image($id){
		if(empty($id)) return false;
		$data=array(
			'image_id'
		);
		$result = $this->view_image($data,$id);
		$rows=[];
		while($row=mysqli_fetch_assoc($result)){
			$rows[]=$row;
		}
		$get_id=[];
		foreach ($rows as $key => $value) {
			$get_id[] = $value['image_id'];
		}
		$images = $this->select_image_of_page($get_id);
		$page_image=[];
		while($row=mysqli_fetch_assoc($images)){
			$page_image[]=$row;
		}
		return $page_image;
	}


	public function isLoginUser(){
		$_SESSION['msg']="ram";

		if(isset($_POST['email']) && isset($_POST['password'])){
			$email=$_POST['email'];
			$password=$_POST['password'];
			$remember=$_POST['remember'];

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
			 		$_SESSION['err_msg']="Invalid user name and password";
			 		header('Location:login.php'); 
			 	}
	 	}
				
	}

	public function deleteImage(){
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

		$delete = $this->delImage($data);

		if($delete == true){
			unlink('../admin/static/images/pageImage/' .$name);
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
		$rows=[];
		while($row=mysqli_fetch_assoc($selectPageid)){
			$rows[]=$row;
		}
		foreach ($rows as $key => $value) {
			$page_id_redirect = $value['page_id'];
		}
		$delete = $this->delImage($data);

		if($delete == true){
			unlink('../admin/static/images/pageImage/' .$name);
			header('Location:home.php?page=view_image&&_uid='.$page_id_redirect);
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
					header('Location:home.php?page=view_image&&_uid='.$id);
				}
		}
	}

	public function admin_manager(){
		$data = array(
			'*'
		);
		$field = $this->admin_manager_display($data);
		$rows=[];
		while($row=mysqli_fetch_assoc($field)){
			$rows[]=$row;
		}
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
			$rows=[];
			while($row=mysqli_fetch_assoc($admin)){
				$rows[]=$row;
			}
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
	// public function getPage(){
	// 	$data=array(
	// 		'id',
	// 		'name',
	// 	);

	// 	$field = $this->dropdown($data);
	// 	$rows=[];
	// 	while($row=mysqli_fetch_assoc($field)){
	// 		$rows[]=$row;
	// 	}
	// 	return $rows;
	// }

	

}
