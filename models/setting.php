<?php

class Setting extends Model
{
    public function save($id, $color)
    {
        $id = (int)$id;
        $sql = "update setting set `value`='{$color}' where id = '{$id}'";

        $this->db->query($sql);
    }

    public function getMenu()
    {
        $sql = "select * from menu";

        return $this->db->query($sql);
    }

    public function add_nav_menu($value, $path, $parent)
    {
        $sql = "insert into menu set `value` = '{$value}',
                                      path = '{$path}',
                                      id_parent = '{$parent}'";

        $this->db->query($sql);
    }

    public function add_nav_menu_without_parent($value, $path)
    {
        $sql = "insert into menu set `value` = '{$value}',
                                      path = '{$path}'";

        $this->db->query($sql);
    }

    public function change_nav_menu($id, $value, $path)
    {
        $sql = "update menu set `value` = '{$value}',
                                 path = '{$path}'
                where id = {$id}";

        $this->db->query($sql);
    }

    public function admin_edit_nav_menu($id)
    {
        $sql = "select * from menu where id = '{$id}'";

        return $this->db->query($sql);
    }

    public function admin_delete_nav_menu($id)
    {
        $sql = "delete from menu where id = '{$id}'";

        $this->db->query($sql);
    }
}