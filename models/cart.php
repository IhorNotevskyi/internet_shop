<?php

//class Cart extends Model
//{
//    public function getOrdersByUser($user_id, $page = 0, $limit = 5)
//    {
//        $page = $page * $limit;
//
//        $sql = "select c.*, n.title_news, u.login from custom c
//              left join users u on u.id = c.user_id
//              left join news n on n.id_news = c.user_id
//              where c.user_id = {$user_id} order by c.date_time desc limit {$page},{$limit} ";
//
//        $result['orders'] = $this->db->query($sql);
//        $result['count_page'] = $this->getOrdersCnt($user_id, $limit);
//
//        return $result;
//    }
//
//    public function getOrdersCnt($user_id, $limit)
//    {
//        $sql = "select count(*) as cnt from custom where user_id = {$user_id}";
//
//        $cnt_pages = $this->db->query($sql);
//        $result = ceil($cnt_pages[0]['cnt'] / $limit);
//
//        return $result;
//    }

//    public function admin_get_orders($page = 0, $limit = 5)
//    {
//        $start = $page * $limit;
//
//        $sql = "select c.id, c.user_name, c.user_phone, c.user_email, c.user_email, c.user_id, c.date_time, c.orders, u.id, u.login, n.title_news, n.is_analitic, n.price, n.new_price from custom c
//            left join users u on u.id = c.user_id
//            left join news n on n.id_news = c.id_news
//            order by c.date_time desc limit {$start},{$limit}";
//
//        $result = $this->db->query($sql);
//        $result['count'] = $this->cnt_orders($limit);
//
//        return $result;
//    }
//
//    public function cnt_orders($limit = 10)
//    {
//        $sql = "select count(*) as COUNT from custom ";
//
//        $count_orders = $this->db->query($sql);
//
//        $total_rows = ($count_orders[0]['COUNT']);
//        $num_pages = ceil($total_rows / $limit);
//
//        return $num_pages;
//    }
//}