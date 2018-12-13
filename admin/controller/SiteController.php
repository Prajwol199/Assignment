<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';

class SiteController extends Database{
	protected $table            = 'setting';
	protected $table_subscriber = 'subscriber';
	protected $table_page       = 'pages';
	protected $table_post       = 'post';
	protected $table_user       = 'users';
	protected $table_slider     = 'slider';

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
		$site_data  = $this->select($this->table,$data);
		$fetch_data = $this->fetch($site_data);
		return $fetch_data;
	}

	public function fetch_data(){
		$data = array(
			'*'
		);
		$result       = $this->select($this->table,$data);
		$fetch_result = $this->fetch($result);
		return $fetch_result;
	}

	public function edit_site(){
		global $server_root;
		$id = $_GET['id'];
		$site_name = $_POST['name'];
		$site_url  = $_POST['url'];
		$footer    = $_POST['footer'];
		$limit     = $_POST['limit'];
		$file      = $_FILES['logo'];
		
		if(!empty($_POST['name']) &&  !empty($_POST['url']) && !empty($_POST['footer'])){
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$newName ='Logo.'.$ext;
			$tmpName = $file['tmp_name'];

			$imagePath='../admin/static/images/';
			move_uploaded_file($tmpName,$imagePath. $newName);

			if(!empty($ext)){
				$data = array(
					'server_root' => "$site_url",
					'footer'      => "$footer",
					'logo'        => "$newName",
					'page_limit'  => "$limit",
					'site_name'   => "$site_name"
				);

				$criteria = array(
					'id' => "$id"
				);

				if($this->update($this->table,$data,$criteria)){
					echo "Updated";
				}else{
					echo "Not updated";
				}
			}else{
				$data = array(
					'server_root' => "$site_url",
					'footer'      => "$footer",
					'site_name'   => "$site_name",
					'page_limit'  => "$limit"
				);

				$criteria = array(
					'id'=>"$id"
				);

				if($this->update($this->table,$data,$criteria)){
					header('Location:'.$server_root.'admin/home/site-configuration');
				}else{
					echo "Not updated";
				}
			}
		}else{
			echo "Site name, Site URL and footer cannot be empty";
		}
	}

	public function select_subscriber(){
		$data = array(
			'*'
		);
		$result         = $this->select($this->table_subscriber,$data);
		$all_subscriber = $this->fetch($result);
		return $all_subscriber;
	}

	public function delete_subscriber(){
		global $server_root;
		$id   = $_POST['delete-subscriber'];
		$data = array(
			'id'=>"$id"
		);
		if($this->delete($this->table_subscriber,$data)){
			$_SESSION['delete'] = "Delete Successfully";
			header('Location:'.$server_root.'admin/home/subscribers');
		}
	}

	public function export_subscriber(){
		header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=data.csv'); 
		ob_end_clean(); 
		$output = fopen("php://output", "w");  
		fputcsv($output, array('ID', 'Email', 'Date'));  
		$query =$this->select($this->table_subscriber,array('*'));  
		while($row = mysqli_fetch_assoc($query)){  
		    fputcsv($output, $row);  
		}  
		fclose($output); 
		exit();
	}

	public function view_content(){
		$data    = ['*'];
		$page    = $this->select($this->table_page,$data);
		$pages   = count($this->fetch($page));
		$post    = $this->select($this->table_post,$data);
		$posts   = count($this->fetch($post));
		$user    = $this->select($this->table_user,$data);
		$users   = count($this->fetch($user));
		$slider  = $this->select($this->table_slider,$data);
		$sliders = count($this->fetch($slider));
		return ['page'=>$pages,'post'=>$posts,'user'=>$users,'slider'=>$sliders];
	}
}
