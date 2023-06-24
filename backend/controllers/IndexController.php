<?php

class IndexController extends BaseController {

    public function __construct($method, $action) {
        parent::__construct();
        $this->method = $method;
		$this->action = $action;
        $this->actionMethodList = [
            'index' => 'GET',
            'calculate' => 'POST'
        ];
        $this->checkMethod();
    }
    public function index() {
        $indexModel = new IndexModel();
        $result = $indexModel->getAllProduct();
        $this->pageData['data'] = $result;
        $this->view->render('index', $this->pageData);
    }
    public function calculate() {
        $indexModel = new IndexModel();
        $result = $indexModel->getCost($_POST);

        if (!empty($result['errors'])) {
            $this->setFlashErrors($result['errors']);
            header("Location: ".$_SERVER['HTTP_REFERER']);
        } else {
            $this->pageData['data'] = $result;
            $this->view->render('result', $this->pageData);
        }
    }
}