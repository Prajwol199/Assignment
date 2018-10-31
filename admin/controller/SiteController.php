<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';

class SiteController extends Database{
	protected $table='setting';

	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

	public function select_site(){
		$data = array(
			'*'
		);
		$site_data = $this->select($this->table,$data);
		$fetch_data = $this->fetch($site_data);
		return $fetch_data;
	}

	public function fetch_data(){
		$data = array(
			'*'
		);
		$result = $this->select($this->table,$data);
		$fetch_result = $this->fetch($result);
		return $fetch_result;
	}

	public function edit_site(){
		global $server_root;
		$id = $_GET['id'];
		$site_name = $_POST['name'];
		$site_url = $_POST['url'];
		$footer = $_POST['footer'];
		$file = $_FILES['logo'];
		
		if(!empty($_POST['name']) &&  !empty($_POST['url']) && !empty($_POST['footer'])){
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$newName ='Logo.'.$ext;
			$tmpName = $file['tmp_name'];

			$imagePath='../admin/static/images/';
			move_uploaded_file($tmpName,$imagePath. $newName);

			if(!empty($ext)){
				$data = array(
					'server_root'=>"$site_url",
					'footer'=>"$footer",
					'logo'=>"$newName",
					'site_name'=>"$site_name"
				);

				$criteria = array(
					'id'=>"$id"
				);

				if($this->update($this->table,$data,$criteria)){
					echo "Updated";
				}else{
					echo "Not updated";
				}
			}else{
				$data = array(
					'server_root'=>"$site_url",
					'footer'=>"$footer",
					'site_name'=>"$site_name"
				);

				$criteria = array(
					'id'=>"$id"
				);

				if($this->update($this->table,$data,$criteria)){
					header('Location:'.$server_root.'admin/home/site_configuration');
				}else{
					echo "Not updated";
				}
			}
		}else{
			echo "Site name, Site URL and footer cannot be empty";
		}
	}

}


?>