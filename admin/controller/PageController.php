<?php 
require_once __dir__.'/DatabaseController.php';
require_once __dir__.'/setting.php';

class PageController extends DatabaseController{
	protected $tableName = 'pages';
	protected $table = 'users';
	protected $table_image='image';
	protected $table_meta='meta';

	public function __construct()
    {
        parent::__construct();
    }
    public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

    public function AddPage(){
    	global $server_root;
    	$name = $_POST['name'];
    	$parent_id = $_POST['page'];
    	$slug = $_POST['slug'];

    	$data = array(
    		'*'
    	);
    	$criteria = array(
    		'name'=>$name
    	);
    	$condition = array(
    		'slug'=>$slug
    	);
    	$select_name = $this->name_check($data,$criteria);
    	$select_slug = $this->name_check($data,$condition);
    	$db_slug = $this->fetch($select_slug);
    	$db_name = $this->fetch($select_name);
    	$a= count($db_slug);
    	if($a > 0){
    		$newSlug = $slug.'-'.$a;
    	}else{
	    	$count = count($db_name);
	    	if($count == 0){
	    		$newSlug = $slug;
	    	}else{
	    		$newSlug = $slug.'-'.($count);
	    	}
    	}
		if(isset($_POST['name']) && isset($_POST['des']) && isset($_FILES['file'])){
			if(empty($_POST['name']) || empty($_POST['des'])){
				echo "Page name and Description cannot be empty";
			}else{
				$pageName = $_POST['name'];
				$description = $_POST['des'];
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
	 					'name'=>"$pageName",
	 					'description'=>"$description",
	 					'parent_id'=>"$parent_id",
	 					'slug'=>"$newSlug"
	 				);
	 				$save = $this->save($page_field);

	 				
	 				$page_id=array(
	 					'id'
	 				);
	 				$id_page = $this->pageId($page_id,$pageName,$description);
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
	 					$redirect_path = $server_root.'admin/home/page_manager';				
						header("Location:$redirect_path");
	 				}
	 			}
	 		}
 		}
	}

	public function getPage(){
		$data=array(
			'*'
		);

		$field=$this->allUser($data);
		$rows = $this->fetch($field);
		return $rows;
	}

	public function deletePages(){
		global $server_root;
		$id=$_POST['delete-page'];

		$data=array(
			'id'=>"$id"
		);

		$delete = $this->delete($data);

		if($delete == true){
			$delete_meta = $this->delete_meta($id);
			$_SESSION['msg'] = "page deleted";
			$redirect_path = $server_root.'admin/home/page_manager';				
			header("Location:$redirect_path");
		}
	}

	public function getPages($id=""){
		$data=array(
			'*'
		);
		$field = $this->editUser($data,array('id'=>"$id"));
		$rows = $this->fetch($field);
		return $rows;
	}

	public function updatePages($id){
		global $server_root;
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
					$redirect_path = $server_root.'admin/home/page_manager';				
					header("Location:$redirect_path");
				}
			}
		}
	}

	public function select_page(){
		$data = array(
			'id',
			'name'
		);
		$criteria = array(
			'parent_id'=>"-1"
		);
		$result = $this->dropdown_page($data,$criteria);
		$pages = $this->fetch($result);
		return $pages;
	}	
}