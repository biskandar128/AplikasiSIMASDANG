<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    // private $_table = 'account_customers';

    public function is_logged_in()
    {
        return $this->session->userdata('user_id');
    }

    //fungsi cek level
    public function is_role()
    {
        return $this->session->userdata('role');
    }

    //fungsi check login
    public function processLogin($table)
    {
        $post = $this->input->post();

        // var_dump(password_hash($post['password'], PASSWORD_DEFAULT));
        // die;

        $this->db->where('email', $post['username'])->or_where('username', $post['username']);

        $user = $this->db->get($table)->row();

        // var_dump($isPasswordTrue = password_verify($post['password'], $user->password));
        // die;

        if ($user) {
            $isPasswordTrue = password_verify($post['password'], $user->password);

            if ($isPasswordTrue) {
                $this->session->set_userdata(['user_logged' => $user]);

                return true;
            }
        }

        return false;
    }

    public function isNotLogin()
    {
        return $this->session->userdata('user_logged') === null;
    }
}
