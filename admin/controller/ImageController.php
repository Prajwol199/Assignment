<?php 
require_once 'Model.php';

class ImageController extends Model{
	protected $tableName = 'pages';
	protected $table = 'users';
	protected $table_image='image';
	protected $table_meta='meta';

	public function __construct()
    {
        parent::__construct();
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

}