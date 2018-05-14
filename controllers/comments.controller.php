<?php

class CommentsController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Comment();
    }

    public function show()
    {
        $params = App::getRoutes()->getParams();

        $page = 0;
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        if (isset($params)) {
            $id = $params[0];
            $this->data = $this->model->getCommentsByUser($id, $page);
        }
    }

    public function admin_delete_comment()
    {
        $id = $this->params[0];
        $this->model->admin_delete_comment($id);
        Router::redirect('/admin/comments/comments_list');
    }

    public function admin_delete_comment_pub()
    {
        $id = $this->params[0];
        $this->model->admin_delete_comment($id);
        Router::redirect('/admin/comments/comments_list_pub');
    }

    public function admin_edit_comment()
    {
        if (isset($_POST['id_comment']) && !empty($_POST['id_comment'])) {
            $this->model->change_comment(
                $_POST['id_comment'],
                $_POST['comment'],
                $_POST['like'],
                $_POST['dislike'],
                $_POST['is_active']
            );

            Router::redirect('/admin/comments/comments_list');
        } else {
            $id = $this->params[0];
            $this->data = $this->model->admin_edit_comment($id);
        }

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/comments/comments_list', 'Список всех комментариев'),
            array($url, 'Редактировать комментарий')
        );
    }

    public function admin_edit_comment_pub()
    {
        if (isset($_POST['id_comment']) && !empty($_POST['id_comment'])) {
            $this->model->change_comment(
                $_POST['id_comment'],
                $_POST['comment'],
                $_POST['like'],
                $_POST['dislike'],
                $_POST['is_active']
            );

            Router::redirect('/admin/comments/comments_list_pub');
        } else {
            $id = $this->params[0];
            $this->data = $this->model->admin_edit_comment($id);
        }

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/comments/comments_list_pub', 'Список неопубликованных комментариев'),
            array($url, 'Редактировать неопубликованный комментарий')
        );
    }

    public function admin_comments_list()
    {
        $page = 0;
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $this->data['comments'] = $this->model->admin_get_comments($page);

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array($url, 'Список всех комментариев')
        );
    }

    public function admin_comments_list_pub()
    {
        $page = 0;
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $this->data['comments'] = $this->model->admin_get_comments_pub($page);

        $url = urldecode($_SERVER['REQUEST_URI']);
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array($url, 'Список неопубликованных комментариев')
        );
    }
}