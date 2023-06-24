<?php


class NotFoundController extends BaseController {

    public function notFound() {
        header('HTTP/1.0 404 Not Found');
        $this->view->render('page_404', []);
    }
}