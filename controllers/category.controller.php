<?php

class CategoryController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Newss();
    }

    public function list()
    {
        $params = App::getRoutes()->getParams();

        if (isset($params)) {
            $id = $params[0];
            $this->data['category'] = array_reverse($this->model->getCategoryById($id));
        } else {
            $this->data['category_list'] = $this->model->getCategoryList();
        }

        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $urlParts = explode('/', $url);
        $lastPart = array_pop($urlParts);

        if ($lastPart == 'list') {
            $this->data['crumbs'] = $this->getBreadCrumbs(
                $this->home,
                array('/category/list', 'Категории товаров')
            );
        } else {
            $numberCategory = $this->model->getCategoryForCrumbs($lastPart);
            $this->data['crumbs'] = $this->getBreadCrumbs(
                $this->home,
                array('/category/list', 'Категории товаров'),
                array('/category/list/' . $numberCategory[0]['id_category'], $numberCategory[0]['category_name'])
            );
        }
    }

    public function analytics()
    {
        $page = 0;
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $this->data['category_analytics'] = $this->model->getAnalyticsByPage($page);
        $this->data['data_analytics'] = $this->model->getAnalyticsData();

        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $urlParts = explode('/', $url);
        $lastPart = array_pop($urlParts);

        if ($lastPart == 'analytics') {
            $numberCategory = $this->model->getAnalyticsData();
            $this->data['crumbs'] = $this->getBreadCrumbs(
                $this->home,
                array('/category/list', 'Категории товаров'),
                array('/category/analytics', $numberCategory[0]['category_name'])
            );
        }
    }
}