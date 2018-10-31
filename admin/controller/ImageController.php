<?php 
require_once __dir__.'/DatabaseController.php';

class ImageController extends DatabaseController{
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

	public function addImage(){
		if(isset($_FILES['file'])){
			if($_FILES['file']['size'] == 0){
				echo"File is empty";
			}else{
				$file = $_FILES['file'];

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

				if(!empty($newName) && !empty($cropName)){
	 				$data=array(
	 					'image'=>"$newName",
	 					'crop'=>"$cropName"
	 				);
	 				$this->imagesInsert($data);
	 			}
	 		}
		}
	}

	public function selectimage(){
		$data=array(
			'id',
			'image',
			'crop'
		);
		$imageName = $this->displayImage($data);
		$rows = $this->fetch($imageName);
		return $rows;
	}

	public function deleteImage(){
		$id = $_POST['delete-image'];

		$data=array(
			'id'=>"$id"
			);
		$field = array(
			'image',
			'crop'
		);
		$select = $this->selectNameOfImage($field,$id);
		$imgName=$this->fetch($select);
		foreach ($imgName as $key => $value) {
			$name = $value['image'];
			$cropName = $value['crop'];
		}
		$delete = $this->delImage($data);

		if($delete == true){
			unlink('../admin/static/images/pageImage/' .$name);
			unlink('../admin/static/images/cropImage/'.$cropName);
		}
	}
}