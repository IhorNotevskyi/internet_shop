<?php

class NewsController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Newss();
    }

    public function list()
    {
        $params = App::getRoutes()->getParams();

        if (isset($_POST['change_comment']) && !empty($_POST['change_comment'])) {
            $newsId = trim(strip_tags($_POST['id_comment_news']));
            $changeComment = trim(strip_tags($_POST['change_comment']));
            $commentId = trim(strip_tags($_POST['id_change_comment']));

            $this->model = new Comment();
            $this->data['comments']['tense'] = $this->model->checkCommentDateTime($commentId);

            if (time() < strtotime($this->data['comments']['tense'][0]['date_time']) + 60) {
                $this->data['comments'] = $this->model->editComment($commentId, $changeComment);
            }

            Router::redirect("/news/list/{$newsId}");
        }

        if (isset($_GET['delete'])) {
            $this->model = new Comment();
            $this->data['comments'] = $this->model->deleteComment($_GET['delete']);
            $this->data['comments'] = $this->model->deleteChildrenComment($_GET['delete']);

            $idNews = explode('?', $params[0]);
            Router::redirect("/news/list/{$idNews[0]}");
        }

        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $page = !isset($page) ? 0 : $page;
        $this->data['news'] = $this->model->getNewsListByPage($page, 5);

        if (isset($params) && !isset($_GET['pages'])) {
            $id = $params[0];
            $this->data = $this->model->getNewsListById($id);
            $this->model = new Comment();
            $this->data['comments'] = $this->model->get_comments($id);

            if (isset($_POST['comment']) && !empty($_POST['comment'])) {
                $this->data['comments'] = $this->model->add_comment(
                    Session::get('login'),
                    $id,
                    $_POST['comment'],
                    $_POST['id_parent']
                );

                Router::redirect("/news/list/{$id}");
            }
        }

        $this->model = new Newss();
        if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != '/') {
            $url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
            $urlParts = explode('/', $url);
            $lastPart = array_pop($urlParts);

            if ($lastPart == 'analytics') {
                $numberCategory = $this->model->getAnalyticsData();
                $this->data['crumbs'] = $this->getBreadCrumbs(
                    $this->home,
                    array('/category/list', 'Категории товаров'),
                    array('/category/analytics', $numberCategory[0]['category_name'])
                );
            } else {
                $numberCategory = $this->model->getCategoryForCrumbs($lastPart);
                $this->data['crumbs'] = $this->getBreadCrumbs(
                    $this->home,
                    array('/category/list', 'Категории товаров'),
                    array('/category/list/' . $numberCategory[0]['id_category'], $numberCategory[0]['category_name'])
                );
            }
        } elseif (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) == '/') {
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
            } else {
                $numberCategory = $this->model->getCategoryForCrumbsByNews($lastPart);
                $nameCategory = $this->model->getCategoryForCrumbs($numberCategory[0]['id_category']);
                $this->data['crumbs'] = $this->getBreadCrumbs(
                    $this->home,
                    array('/category/list', 'Категории товаров'),
                    array('/category/list/' . $numberCategory[0]['id_category'], $nameCategory[0]['category_name'])
                );
            }
        }
    }

    public function tag()
    {
        $params = App::getRoutes()->getParams();

        if (isset($params)) {
            $id = $params[0];
            $this->data['tags'] = $this->model->getNewsListByTagId($id);
        } else {
            $this->data['tags'] = $this->model->getTagsList();
        }

//        var_dump($this->data['tags']);
    }

    public function admin_tag()
    {
        if (isset($_POST['new_tags']) && !empty($_POST['new_tags'])) {
            $tags = null;
            foreach ($_POST['new_tags'] as $tag) {
                $tags .= "('{$tag}') ,";
            }

            $tags = substr($tags,0,-1);
            $result = $this->model->admin_add_tag($tags);
            if ($result) {
                Router::redirect('/admin/news/tag');
            }
        } else {
            $this->data['tags'] = $this->model->getTagsList();
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/news/tag', 'Список тегов')
        );
    }
    
    public function admin_category()
    {
        if (isset($_POST['new_categories']) && !empty($_POST['new_categories'])) {
            $categories = null;
            foreach ($_POST['new_categories'] as $category) {
                $categories .= "('{$category}') ,";
            }

            $categories = substr($categories,0,-1);
            $result = $this->model->admin_add_category($categories);

            if ($result) {
                Router::redirect('/admin/news/category');
            }
        } else {
            $this->data['category'] = $this->model->getCategoryList();
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/news/category', 'Список категорий')
        );
    }

    public function admin_add()
    {
        $this->data['tags'] = $this->model->getTagsList();
        $this->data['category'] = $this->model->getCategoryList();

        if ($_POST) {
            if (!empty($_FILES['photo']['name'])) {
                $img = $this->model->move_uploaded_file($_FILES);
            }
            $img = isset($img) ? $img : null;

            $_result = $this->model->save($_POST, $img);
            if ($_result) {
                Session::setFlash('Page was saved.');
            } else {
                Session::setFlash('Error.');
            }

            Router::redirect('/admin/news/list');
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/news/list', 'Список товаров'),
            array('/admin/news/add', 'Добавить товар')
        );
    }

    public function admin_edit()
    {
        if ($_POST) {
            $id = isset($_POST['id_news']) ? $_POST['id_news'] : null;

            if (!empty($_FILES['photo']['name'])) {
                $img = $this->model->move_uploaded_file($_FILES);
            }
            $img = isset($img) ? $img : null;

            $imageName = $this->model->delete_image($this->params[0]);
            $result = $this->model->save($_POST, $img, $id);
            unlink(ROOT . DS . IMAGE_PATH . DS . $imageName[0]['image_news']);

            if ($result) {
                Session::setFlash('Page was saved.');
            } else {
                Session::setFlash('Error.');
            }

            Router::redirect('/admin/news/list');
        }

        if (isset($this->params[0])) {
            $this->data = $this->model->getNewsListById($this->params[0]);
            $this->data['category'] = $this->model->getCategoryList();
            $this->data['tags_list'] = $this->model->getTagsList();

        } else {
            Session::setFlash('Wrong page id.');
            Router::redirect('/admin/news/list');
        }

        $url = urldecode($_SERVER['REQUEST_URI']);
        $urlParts = explode('/', $url);
        $lastPart = array_pop($urlParts);

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/news/list', 'Список товаров'),
            array('/admin/news/edit/' . $lastPart, 'Редактировать товар')
        );
    }

    public function admin_delete()
    {
        if (isset($this->params[0])) {
            $imageName = $this->model->delete_image($this->params[0]);
            $result = $this->model->delete($this->params[0]);
            unlink(ROOT . DS . IMAGE_PATH . DS . $imageName[0]['image_news']);

            if ($result) {
                Session::setFlash('Page was deleted.');
            } else {
                Session::setFlash('Error.');
            }
        }

        Router::redirect('/admin/news/list');
    }

    public function admin_delete_tag()
    {
        if (isset($this->params[0])) {
            $result = $this->model->delete_tag($this->params[0]);

            if ($result) {
                Session::setFlash('Tags was deleted.');
            } else {
                Session::setFlash('Error.');
            }
        }

        Router::redirect('/admin/news/tag');
    }

    public function admin_list()
    {
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }

        $page = !isset($page) ? 0 : $page;
        $this->data = $this->model->getNewsListByPage($page, 10);
    }
    
    public function admin_delete_category()
    {
        if (isset($this->params[0])) {
            $result = $this->model->delete_category($this->params[0]);
            if ($result) {
                Session::setFlash('Category was deleted.');
            } else {
                Session::setFlash('Error.');
            }
        }

        Router::redirect('/admin/news/category');
    }
}