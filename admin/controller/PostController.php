<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';

class PostController extends Database{
	protected $table_post = 'post';
	protected $table_image = 'image';
	protected $table_meta = 'meta';
	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

	public function add_post(){
		global $server_root;
		$title = $_POST['title'];
		$content = $_POST['content'];
		$seo_title = $_POST['seo-title'];
		$meta_title = $_POST['meta-title'];
		$meta_keyword = $_POST['meta-keyword'];

		if(!empty($title) && !empty($content) && !empty($seo_title) && !empty($meta_keyword)){
			$data = array(
				'title'=>"$title",
				'content'=>"$content",	
				'seo_title'=>"$seo_title",
				'meta_title'=>"$meta_title",
				'meta_keyword'=>"$meta_keyword",
				'isactive'=>"1"
			);
			if($this->insert($this->table_post,$data)){
				$condition = array(
					'title'=>"$title",
					'seo_title'=>"$seo_title",
					'meta_title'=>"$meta_title",
					'meta_keyword'=>"$meta_keyword"
				);
				$select_id = $this->select($this->table_post,array('id'),$condition);
				$fetch_id = $this->fetch($select_id);
				foreach ($fetch_id as $key => $value) {
					$post_id = $value['id'];
				}
			}

			$imagePath='../admin/static/images/pageImage/';
		 	$cropimagePath='../admin/static/images/cropImage/';
			for($i = 0; $i < count($_FILES['uploadfile']['name']); $i++){
				$filetmp = $_FILES["uploadfile"]["tmp_name"][$i];
				$filename = $_FILES["uploadfile"]["name"][$i];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$name = md5(time() . rand());
	 			$newName = $name.'.'.$ext; echo "<br>";
				if(!move_uploaded_file($filetmp,$imagePath.$newName)){
					echo "Not moved";
				}
				if($ext == 'PNG'){
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
					if($this->insert($this->table_image,$data)){
						$select_image_id = $this->select($this->table_image,array('id'),array('image'=>"$newName"));
						$value = mysqli_fetch_assoc($select_image_id);
		 				foreach ($value as $key => $image_id) {
		 					$image_id;
		 				}
					}
					$meta=array(
		 					'page_type'=>'post',
		 					'page_id'=>"$post_id",
		 					'image_id'=>"$image_id"
		 				);
					$insert = $this->insert($this->table_meta,$meta);
				}
			}
			if($insert == true){
				header('Location:'.$server_root.'admin/home/post-manager');
			}else{
				echo "Post not added";
			}
		}else{
			echo "Fields cannot be empty";
		}
	}

	public function select_post($id){
		$select_all_post = $this->select($this->table_post,array('*'),['id'=>"$id"]);
		$all_post = $this->fetch($select_all_post);
		return $all_post;
	}

	public function delete_post(){
		global $server_root;
		$id = $_POST['delete-post'];

		if($this->delete($this->table_post,array('id'=>"$id"))){
			$delete_meta = $this->delete($this->table_meta,array('page_id'=>"$id"));
			header('Location:'.$server_root.'admin/home/post-manager');
		}else{
			echo "Not deleted";
		}
	}

	public function edit_post(){
		global $server_root;
		$id = $_GET['id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$seo_title = $_POST['seo-title'];
		$meta_title = $_POST['meta-title'];
		$meta_keyword = $_POST['meta-keyword'];

		if(!empty($title) && !empty($content) && !empty($seo_title) && !empty($meta_title) &&!empty($meta_keyword)){
			$data = array(
				'title'=>"$title",
				'content'=>"$content",
				'seo_title'=>"$seo_title",
				'meta_title'=>"meta_title",
				'meta_keyword'=>"$meta_keyword"
			);
			if($this->update($this->table_post,$data,array('id'=>"$id"))){
				header('Location:'.$server_root.'admin/home/post-manager');
			}
		}else{
			echo "Fields cannot be empty";
		}
	}

	public function select_post_image($id){
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

	public function delete_view_post(){
		global $server_root;
		$page_id = $_GET['id'];
		$id = $_POST['delete-image'];

		$data=array(
			'id'=>"$id"
			);
		$field = array(
			'image',
			'crop'
		);
		$select = $this->select($this->table_image,$field,array('id'=>"$id"));
		$imgName = $this->fetch($select);
		foreach ($imgName as $key => $value) {
			$name = $value['image'];
			$cropName = $value['crop'];
		}

		if($this->delete($this->table_image,array('id'=>"$id"))){
			unlink('../admin/static/images/postImage/' .$name);
			unlink('../admin/static/images/postCropImage/' .$cropName);
			$redirect_path = $server_root.'admin/home/view-post-image/'.$page_id;			
			header("Location:$redirect_path");
		}else{
			echo "Not deleted";
		}
	}

	public function add_post_image(){
		global $server_root;
		$page_id = $_GET['id'];

		$imagePath='../admin/static/images/pageImage/';
	 	$cropimagePath='../admin/static/images/cropImage/';
		for($i = 0; $i < count($_FILES['uploadfile']['name']); $i++){
			$filetmp = $_FILES["uploadfile"]["tmp_name"][$i];
			$filename = $_FILES["uploadfile"]["name"][$i];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$name = md5(time() . rand());
 			$newName = $name.'.'.$ext; echo "<br>";
			if(!move_uploaded_file($filetmp,$imagePath.$newName)){
				echo "Not moved";
			}
			if($ext == 'PNG'){
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
				if($this->insert($this->table_image,$data)){
					$select_image_id = $this->select($this->table_image,array('id'),array('image'=>"$newName"));
					$value = mysqli_fetch_assoc($select_image_id);
	 				foreach ($value as $key => $image_id) {
	 					$image_id;
	 				}
				}
				$meta=array(
	 					'page_type'=>'post',
	 					'page_id'=>"$page_id",
	 					'image_id'=>"$image_id"
	 				);
				$insert = $this->insert($this->table_meta,$meta);
			}
		}
		if($insert == true){
			$redirect_path = $server_root.'admin/home/view-post-image/'.$page_id;			
			header("Location:$redirect_path");
		}else{
			echo "Post not added";
		}
	}

	public function deactive_post(){
		global $server_root;
		$id = $_POST['deactive'];
		$data = array(
			'isactive'=>'0'
		);
		if($this->update($this->table_post,$data,array('id'=>"$id"))){
			$redirect_path = $server_root.'admin/home/post-manager';			
			header("Location:$redirect_path");
		}else{
			echo "Error !";
		}
	}

	public function active_post(){
		global $server_root;
		$id = $_POST['active'];
		$data = array(
			'isactive'=>'1'
		);
		if($this->update($this->table_post,$data,array('id'=>"$id"))){
			$redirect_path = $server_root.'admin/home/post-manager';			
			header("Location:$redirect_path");	
		}else{
			echo "Error !";
		}
	}
}