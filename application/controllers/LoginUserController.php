<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginUserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel', 'login');
        $this->load->model('CrudModel', 'crud');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (isset($this->session->userdata('user_logged')->account_id)) {
            redirect('user');
        } else {
            if ($this->input->post()) {
                if ($this->login->processLogin('account_customers')) {
                    redirect(base_url('user'));
                }
            }

            $this->load->view('LoginPageUser');
        }
    }

    public function RegisterUser()
    {
        $this->load->view('RegisterPageUser');
    }

    private function uploadImageRegisterUser($folder, $field)
    {
        $config['upload_path'] = './upload/'.$folder;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = time();
        $config['overwrite'] = true;
        $config['max_size'] = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field)) {
            return $this->upload->data('file_name');
        }

        return 'default.jpg';
    }

    public function RegisterProcess()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[account_customers.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('account_name', 'Nama Account', 'trim|required');
        $this->form_validation->set_rules('nomor_telp', 'Nomor Telpon', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[account_customers.email]');
        if ($this->form_validation->run() == true) {
            $add = [
            'account_id' => $this->crud->generateCode('10', 'account_id', 'account_customers'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            // 'password' => $this->input->post('password'),
            'account_name' => $this->input->post('account_name'),
            'nomor_telp' => $this->input->post('nomor_telp'),
            'email' => $this->input->post('email'),
            'account_img' => $this->uploadImageRegisterUser('account_customers', 'account_img'),
        ];
            $this->crud->AddData('account_customers', $add);

            $this->session->set_flashdata('success_register', 'Proses Pendaftaran Akun Berhasil');
            redirect('user/login');
        } else {
            $this->session->set_flashdata('error', validation_errors());

            redirect('user/register');
        }
    }

    public function validateLogin($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->or_where('password', $password);
        $query = $this->db->get('account_customers')->row();

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
