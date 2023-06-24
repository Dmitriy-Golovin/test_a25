<?php

require_once 'backend/config/sdbh.php';

class BaseModel {
	
	protected $db = null;
	
	public function __construct() {
        $this->db = new sdbh();
	}
	
}