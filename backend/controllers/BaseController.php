<?php

class BaseController {
	
	protected $view;
	protected $method;
	protected $action;
	protected $actionMethodList = [];
	protected $pageData = ['erorrs' => [], 'data' => []];
	
	public function __construct() {
		$this->getFlashErrors();
		$this->view = new View();
	}

	protected function checkMethod() {
		foreach ($this->actionMethodList as $action => $method) {
			if ($action === $this->action && $method !== $this->method) {
				$this->show404();
				die;
			}
		}
	}
	
	protected function show404() {
		header('HTTP/1.0 404 Not Found');
        $this->view->render('page_404', []);
	}

	protected function setFlashErrors($data) {
		$_SESSION['flash_errors'] = json_encode($data);
	}

	protected function getFlashErrors() {
		if (!empty($_SESSION['flash_errors'])) {
			$this->pageData['errors'] = json_decode($_SESSION['flash_errors'], true);
			unset($_SESSION['flash_errors']);
		}
	}
}