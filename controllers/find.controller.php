<?php

class FindController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Newss();
    }

    public function list()
    {
        $this->data['tags'] = $this->model->getTagsList();
        $this->data['category'] = $this->model->getCategoryList();

        if (!empty($_POST)) {
            $this->data['filter'] = array_reverse($this->model->getNewsByFilter($_POST));
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->home,
            array('/find', 'Поиск товаров')
        );
    }
}