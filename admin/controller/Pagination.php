<?php
require_once __dir__.'/../model/database.php';
require_once __dir__.'/setting.php';

class Pagination extends Database{

	protected $table_post = 'post';
	protected $table_page = 'pages';

	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }

	public function page_bar(){
		$page_bar = $this->select_page_bar($this->table_post,array('isactive'=>1));
		$fetch_pagebar = $this->fetch($page_bar);
		return $fetch_pagebar;
	}

	public function admin_post_bar(){
		$page_bar = $this->select_page_bar($this->table_post);
		$fetch_pagebar = $this->fetch($page_bar);
		return $fetch_pagebar;
	}

	public function admin_page_bar(){
		$page_bar = $this->select_page_bar($this->table_page);
		$fetch_pagebar = $this->fetch($page_bar);
		return $fetch_pagebar;
	}

	public function view_post_user($page){
		global $limit;
		$offset = ($page - 1) * $limit;
		$select_all_post = $this->pagination($this->table_post,$offset,$limit,array('isactive'=>'1'));
		$all_post = $this->fetch($select_all_post);
		return $all_post;
	}

	public function view_all_post($page){
		global $limit;
		$offset = ($page - 1) * $limit;
		$select_all_post = $this->pagination($this->table_post,$offset,$limit);
		$all_post = $this->fetch($select_all_post);
		return $all_post;
	}
	
	public function view_all_page($page){
		global $limit;
		$offset = ($page - 1) * $limit;
		$select_all_post = $this->pagination($this->table_page,$offset,$limit);
		$all_post = $this->fetch($select_all_post);
		return $all_post;
	}
	
}