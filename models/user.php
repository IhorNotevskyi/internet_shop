<?php

class User extends Model
{
    public function getByLogin($login)
    {
        $login = $this->db->escape($login);
        $sql = "select * from users where login = '{$login}' limit 1";
        $result = $this->db->query($sql);

        if (isset($result[0])) {
            return $result[0];
        }

        return false;
    }

    public function getCountUsers($limit = 10)
    {
        $sql = "select count(*) as COUNT from users";
        $count_users = $this->db->query($sql);
        $total_rows = ($count_users[0]['COUNT']);
        $num_pages = ceil($total_rows / $limit);

        return $num_pages;
    }

    public function getPersonalData($id)
    {
        $sql = "select `id`, login, email from users where `id` = '{$id}'";

        return $this->db->query($sql);
    }

    public function getPasswordForCheck($id)
    {
        $sql = "select `password` from users where `id` = '{$id}'";

        return $this->db->query($sql);
    }

    public function changePersonalPassword($id, $password)
    {
        $sql = "update users set password = '{$password}' where `id` = '{$id}'";

        return $this->db->query($sql);
    }

    public function getEmailById($id)
    {
        $sql = "select email from users where `id` = '{$id}'";

        return $this->db->query($sql);
    }

    public function getAllEmailsForCheck()
    {
        $sql = "select email from users";

        return $this->db->query($sql);
    }

    public function saveNewPersonalEmail($id, $email)
    {
        $sql = "update users set email = '{$email}' where `id` = '{$id}'";

        return $this->db->query($sql);
    }

    public function getUsersByRole()
    {
        $sql = "SELECT login FROM users WHERE role = 'admin'";

        return $this->db->query($sql);
    }

    public function getUserIdByLogin($login)
    {
        $sql = "SELECT id FROM users WHERE login = '{$login}'";

        return $this->db->query($sql);
    }
    
    public function users($page = 0, $limit = 10)
    {
        $start = $page * $limit;
        $sql = "select * from  users where role not in('admin') limit {$start},{$limit}";
        $result= $this->db->query($sql);
        $result['count'] = $this->getCountUsers($limit);

        return $result;
    }

    public function admin_delete($id)
    {
        $id = (int)$id;
        $sql = "delete from users where id= {$id}";

        return $this->db->query($sql);
    }

    public function addUser($form_fields)
    {
        $login = $form_fields['login'];
        $email = $form_fields['email'];
        $password = $form_fields['password'];
        $hash = md5(Config::get('salt') . $password);

        $sql = "insert into users
                    set login='{$login}',
                        email='{$email}',
                        password='{$hash}'";

        if ($this->db->query($sql)) {
           return $this->getByLogin($login);
        }

        return false;
    }

    public function checkUniqueField($field, $login)
    {
        $sql = "SELECT id FROM users WHERE {$field} = '{$login}' LIMIT 1";
        $result = $this->db->query($sql);
        $digit = array_shift($result)['id'];

        return $digit;
    }
}