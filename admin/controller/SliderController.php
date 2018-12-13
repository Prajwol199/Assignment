<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';

class SliderController extends Database{

	protected $table_slider = 'slider';

	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

	public function add_slider(){
		global $server_root;
		$title       = $_POST['title'];
		$description = $_POST['description'];

		$file=$_FILES['file'];

		$ext       = pathinfo($file['name'], PATHINFO_EXTENSION);
		$name      = md5(time() . rand());
		$newName   = $name.'.'.$ext;
		$tmpName   = $file['tmp_name'];
		$imagePath = '../admin/static/images/sliderImage/';
		if(move_uploaded_file($tmpName,$imagePath. $newName)){
			$data = array(
				'title'       => "$title",
				'description' => "$description",
				'image'       => "$newName"
			);
			if($this->insert($this->table_slider,$data)){
				header('Location:'.$server_root.'admin/home/slider-manager');
			}
		}else{
			echo "Error !";
		}
	}

	public function select_slider(){
		$select_slider_db = $this->select($this->table_slider,array('*'));
		$fetch_slider     = $this->fetch($select_slider_db);
		return $fetch_slider;
	}

	public function delete_slider(){
		global $server_root;
		$id = $_POST['delete-slider'];

		$select_image_unlink = $this->select($this->table_slider,array('image'),array('id'=>"$id"));
		$fetch_unlink = $this->fetch($select_image_unlink);
		foreach ($fetch_unlink as $key => $value) {
			$img_name = $value['image'];
		}
		if($this->delete($this->table_slider,array('id'=>"$id"))){
			unlink('../admin/static/images/sliderImage/' .$img_name);
			header('Location:'.$server_root.'admin/home/slider-manager');
		}else{
			echo "Not deleted";
		}
	}

	public function value_display($id){
		$select_all_slider = $this->select($this->table_slider,array('*'),['id'=>"$id"]);
		$all_post = $this->fetch($select_all_slider);
		return $all_post;
	}

	public function edit_slider($id,$image){
		global $server_root;
		$title       = $_POST['title'];
		$description = $_POST['description'];
		if(!empty($_POST['title']) && !empty($_POST['description'])){

			$file      = $_FILES['file'];
			$ext       = pathinfo($file['name'], PATHINFO_EXTENSION);
			$name      = md5(time() . rand());
			$newName   = $name.'.'.$ext;
			$tmpName   = $file['tmp_name'];
			$imagePath = '../admin/static/images/sliderImage/';

			if(!empty($ext)){
				move_uploaded_file($tmpName,$imagePath. $newName);
				unlink('../admin/static/images/sliderImage/' .$image);
				$data = array(
					'title'       => "$title",
					'description' => "$description",
					'image'       => "$newName"
				);
				if($this->update($this->table_slider,$data,array('id'=>"$id"))) {
					header('Location:'.$server_root.'admin/home/slider-manager');
				}
			}else{
				$data =array(
					'title'       => "$title",
					'description' => "$description"
				);
				if($this->update($this->table_slider,$data,array('id'=>"$id"))) {
				header('Location:'.$server_root.'admin/home/slider-manager');
				}
			}
		}else{
			echo "Field are empty";
		}
	}
}