<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginSystemController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('LoginModel', 'login');
    }

    public function index()
    {
        if (isset($this->session->userdata('user_logged')->account_id)) {
            if ($this->session->userdata('user_logged')->role === 'admin') {
                redirect('admin/dashboard');
            }
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            if ($this->form_validation->run() === true) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                if ($this->login->processLogin('account_systems')) {
                    // var_dump($this->session->userdata('user_logged'));
                    // die;
                    if ($this->session->userdata('user_logged')->role === 'kurir') {
                        redirect('kurir/dashboard');
                    }
                    if ($this->session->userdata('user_logged')->role === 'admin') {
                        redirect('admin/dashboard');
                    }
                } else {
                    $this->load->view('LoginPageSystem');
                }
            } else {
                $this->load->view('LoginPageSystem');
            }
        }
    }

    public function validateLogin($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->or_where('password', $password);
        $query = $this->db->get('account_systems')->row();

        if (!isset($query)) {
            echo json_encode(false);
        } else {
            $isPasswordTrue = password_verify($password, $query->password);

            if ($isPasswordTrue) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        }
    }
}
