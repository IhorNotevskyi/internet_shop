<?php

class PromotionsController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Promotion();
    }

    public function admin_promotion_list(){
        $page = 0;
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $this->data['admin_promotion'] = $this->model->admin_get_promotion($page);

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/promotions/promotion_list', 'Список рекламных блоков')
        );
    }

    public function admin_delete()
    {
        $this->model->admin_delete($this->params[0]);
        Router::redirect('/admin/promotions/promotion_list');
    }
    
    public function admin_promotion_add()
    {
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $this->model->admin_save($_POST, $id);

            Router::redirect('/admin/promotions/promotion_list');
        }

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/promotions/promotion_list', 'Список рекламных блоков'),
            array($url, 'Добавить рекламный блок')
        );
    }
    
    public function admin_edit_promotion(){
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $this->model->admin_save($_POST, $id);

            Router::redirect('/admin/promotions/promotion_list');
        } else {
            $this->data['admin_promotion'] = $this->model->admin_edit($this->params[0]);
        }

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/promotions/promotion_list', 'Список рекламных блоков'),
            array($url, 'Редактировать рекламный блок')
        );
    }
}