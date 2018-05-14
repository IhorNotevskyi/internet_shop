<?php

class Controller
{
    protected $data;

    protected $model;

    protected $params;

    protected $home = array('/', 'Главная');

    protected $panel = array('/admin/settings/menu', 'Админ-панель');

    public function __construct($data = array())
    {
        $this->data = $data;
        $this->params = App::getRoutes()->getParams();
    }

    public function getData()
    {
        $promotion = new Model();
        $id = isset($_POST['promotion_id']) ? $_POST['promotion_id'] : null;
        $this->data['promotion'] = $promotion->getPromotion($id);
        $this->data['config'] = $promotion->admin_color();

        $this->model = new User();
        $this->data['admin_role'] = $this->model->getUsersByRole();

        $this->model = new Newss();
        $this->data['categories_roster'] = $this->model->getCategoryList();

        $this->model = new Setting();
        $menuItems = $this->model->getMenu();

        $sortKeyMenuItems = array();
        foreach ($menuItems as $key => $value) {
            $sortKeyMenuItems[$key + 1] = $value;
        }

        $this->data['menu'] = $this->getTree($sortKeyMenuItems);

        return $this->data;
    }

    public function getTree($data)
    {
        $tree = array();

        foreach ($data as $id => &$value) {
            if (!$value['id_parent']) {   // Если нет вложенности
                $tree[$id] = &$value;
            } else {                      // Если есть потомки, то перебираем массив
                $data[$value['id_parent']]['children'][$id] = &$value;
            }
        }

        return $tree;
    }

    public function getBreadCrumbs()
    {
        $arg_list = func_get_args();
        $numargs = func_num_args();
        $str = '';

        for ($i = 0; $i < $numargs; $i++) {
            $str .= ($arg_list[$i][1] ?
                ($arg_list[$i][0] ?
                    '<a href="' . $arg_list[$i][0] . '">' . $arg_list[$i][1] . '</a>' :
                    $arg_list[$i][1]
                ) . ($numargs - 1 > $i && $arg_list[$i][0] ?
                    '<span>&ensp;&#10148;&ensp;</span>' :
                    ''
                ) : ''
            );
        }

        return $str;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getParams()
    {
        return $this->params;
    }
}