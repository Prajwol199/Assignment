<?php 
require_once __dir__.'/DatabaseController.php';

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


	public function getPage(){
		$data=array(
			'*'
		);

		$field=$this->allUser($data);
		$rows = $this->fetch($field);
		return $rows;
	}

	public function deletePages(){
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

	public function getPages($id=""){
		$data=array(
			'*'
		);
		$field = $this->editUser($data,array('id'=>"$id"));
		$rows = $this->fetch($field);
		return $rows;
	}

	public function updatePages($id){
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
}