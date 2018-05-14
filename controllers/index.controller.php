<?php

class IndexController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Newss();
    }

    public function search()
    {
        $search = $_POST['search'];
        $search = addslashes($search);
        $search = htmlspecialchars($search);
        $search = stripslashes($search);
        $row = $this->model->ajax($search);

        for ($i = 0; $i < count($row); $i++) {
            echo "<li><a href=/news/tag/{$row[$i]['id_tag']}>" . $row[$i]['tag_name'] . "</a></li>";
        }
        exit;
    }

    public function list()
    {
        $this->data = $this->model->getListIndex();
        $this->data['by_analytics'] = $this->model->getListIndexWhereIsAnalytics();
        $this->data['carousel_slider'] = $this->model->getCarouselSlider();
        $this->data['category_analytics'] = $this->model->getAnalyticsListLimit();
        $this->data['data_analytics'] = $this->model->getAnalyticsData();

        $this->model = new Comment();
        $this->data['commentator'] = $this->model->getTopCommentators();
        $this->data['themes'] = $this->model->getTopThemes();
    }

    public function admin_list()
    {
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $page = !isset($page) ? 0 : $page;
        $this->data = $this->model->getNewsListByPage($page, 10);

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array($url, 'Список товаров')
        );
    }


}