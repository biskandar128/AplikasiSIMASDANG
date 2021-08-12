<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CrudModel', 'crud');
        $this->load->library('Pdf');
        $this->load->library('session');
        if ($this->session->userdata('user_logged')->role !== 'admin') {
            redirect('sistem/login');
        }
    }

    public function index()
    {
        $this->db->select_sum('transaction_total');
        $this->db->where('transaction_status !=', 'Menunggu');
        $this->db->where('transaction_status !=', 'Batal');
        $this->db->where('month(transaction_date)', date('m'));
        $this->db->where('year(transaction_date)', date('Y'));
        $monthIncome = $this->db->get('transactions')->row()->transaction_total;

        $waiting = [
            'transaction_status' => 'Menunggu',
        ];

        $process = [
            'transaction_status' => 'Proses',
        ];

        $shipping = [
            'transaction_status' => 'Dikirim',
        ];

        $cancel = [
            'transaction_status' => 'Batal',
        ];

        $finish = [
            'transaction_status' => 'Selesai',
        ];

        $query = $this->db->get('goods');

        $data = [
            'content' => 'Admin/DashboardPage',
            'monthIncome' => $monthIncome,
            'waiting' => $this->crud->getDataCount($waiting, 'transactions'),
            'process' => $this->crud->getDataCount($process, 'transactions'),
            'shipping' => $this->crud->getDataCount($shipping, 'transactions'),
            'cancel' => $this->crud->getDataCount($cancel, 'transactions'),
            'finish' => $this->crud->getDataCount($finish, 'transactions'),
            'totalProduct' => $query->num_rows(),
            'titlePage' => 'Halaman Dashboard',
            'title' => 'Dashboard',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    private function uploadImageContentProduct($folder, $field)
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

    public function Goods()
    {
        $data = [
            'DataGoods' => $this->crud->GetData('goods')->result(),
            'content' => 'Admin/ProdukPage',
            'titlePage' => 'Halaman Produk',
            'title' => 'Produk',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function AddDataGoods()
    {
        $addGoods = [
            'goods_id' => $this->crud->generateCode('10', 'goods_id', 'goods'),
            'nama' => $this->input->post('nama'),
            'varian' => $this->input->post('varian'),
            'berat' => $this->input->post('berat'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
        ];

        $addGoodsContent = [
            'content_id' => $this->crud->generateCode('10', 'content_id', 'goods_content'),
            'deskripsi' => $this->input->post('deskripsi'),
            'goods_img' => $this->uploadImageContentProduct('konten_produk', 'goods_img'),
            'status' => $this->input->post('status'),
            'goods_status' => 0,
            'goods_id' => $addGoods['goods_id'],
        ];

        $this->crud->AddData('goods', $addGoods);

        $this->crud->AddData('goods_content', $addGoodsContent);
        $this->session->set_flashdata('success_input_produk', 'Data Berhasil Di Simpan');
        redirect(base_url('admin/produk'));
    }

    public function UpdateDataGoods()
    {
        $update = [
            'goods_id' => $this->input->post('goods_id'),
            'nama' => $this->input->post('nama'),
            'varian' => $this->input->post('varian'),
            'berat' => $this->input->post('berat'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
        ];

        $this->crud->UpdateData('goods', 'goods_id', $update['goods_id'], $update);
        $this->session->set_flashdata('success_update_produk', 'Data Berhasil Di Ubah');
        redirect(base_url('admin/produk'));
    }

    public function GoodsContent()
    {
        $table = 'goods_content';

        $onjoin = ['goods' => $table.'.goods_id = goods.goods_id'];

        $select = ['goods.nama', 'goods.varian', 'goods_content.goods_img', 'goods_content.deskripsi', 'goods_content.status', 'goods_content.goods_status', 'goods_content.content_id'];

        $data = [
            'DataGoodsContent' => $this->crud->getDataJoin($table, $onjoin, [], $select)->result(),
            'DataGoods' => $this->crud->getData('goods')->result(),
            'content' => 'Admin/KontenProdukPage',
            'titlePage' => 'Halaman Konten Produk',
            'title' => 'Konten Produk',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function UpdateDataGoodsContent()
    {
        $content_id = $this->input->post('content_id');
        $update['deskripsi'] = $this->input->post('deskripsi');
        $update['status'] = $this->input->post('status');

        $update['goods_status'] = $this->input->post('goods_status');

        if (!empty($_FILES['goods_img']['name'])) {
            $this->crud->deleteImage('goods_content', 'content_id', $content_id, 'goods_img', 'konten_produk');
            $update['goods_img'] = $this->uploadImageContentProduct('konten_produk', 'goods_img');
        } else {
            $update['goods_img'] = $this->input->post('old_image');
        }

        $this->crud->UpdateData('goods_content', 'content_id', $content_id, $update);
        $this->session->set_flashdata('success_update_produk_konten', 'Data Berhasil Di Ubah');
        redirect(base_url('admin/konten_produk'));
    }

    public function About()
    {
        $data = [
            'DataAbout' => $this->crud->getData('about_us')->result(),
            'content' => 'Admin/KontenAboutPage',
            'titlePage' => 'Halaman Konten About Us',
            'title' => 'Konten Tentang Kami',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function AddDataAbout()
    {
        $add = [
            'about_desc' => $this->input->post('about_desc'),
            'about_img' => $this->uploadImageContentProduct('konten_about', 'about_img'),
            'about_status' => $this->input->post('about_status'),
        ];

        $this->crud->AddData('about_us', $add);
        $this->session->set_flashdata('success_input_about', 'Data Berhasil Di Simpan');
        redirect(base_url('admin/konten_about'));
    }

    public function UpdateDataAbout()
    {
        $about_id = $this->input->post('about_id');
        $update = ['about_desc' => $this->input->post('about_desc'), 'about_status' => $this->input->post('about_status')];

        if (!empty($_FILES['about_img']['name'])) {
            $this->crud->deleteImage('about_us', 'about_id', $about_id, 'about_img', 'konten_about');
            $update['about_img'] = $this->uploadImageContentProduct('konten_about', 'about_img');
        } else {
            $update['about_img'] = $this->input->post('old_image');
        }

        $this->crud->UpdateData('about_us', 'about_id', $about_id, $update);
        $this->session->set_flashdata('success_update_about', 'Data Berhasil Di Ubah');
        redirect(base_url('admin/konten_about'));
    }

    public function Account()
    {
        $data = [
            'DataAccount' => $this->crud->getData('account_customers')->result(),
            'content' => 'Admin/AccountPage',
            'titlePage' => 'Halaman Data Akun',
            'title' => 'Data Akun',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function Transaction()
    {
        $table = 'transactions';

        $onjoin = [
            'payments' => $table.'.payment_id = payments.payment_id',
        ];

        $select = ['transactions.transaction_id', 'transactions.delivered_date', 'transactions.estimated_day', 'transactions.estimated_date', 'transactions.transaction_date', 'transactions.transaction_total', 'transactions.transaction_status', 'transactions.account_id', 'payments.payment_name', 'transactions.tracking'];

        $data = [
            'DataTransaction' => $this->crud->getDataJoin($table, $onjoin, [], $select)->result(),
            'content' => 'Admin/TransactionPage',
            'titlePage' => 'Halaman Transaksi',
            'title' => 'Transaksi',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function UpdateTransactionStatus()
    {
        $emailSystem = $this->crud->getDataWhere('account_systems', 'account_id', $this->session->userdata('user_logged')->account_id)->row();

        $config = [
            'charset' => 'iso-8859-1',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $emailSystem->email,
            'smtp_pass' => 'dmx785ia14',
            'mailtype' => 'html',
        ];

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('biskandar158@gmail.com', 'Sambel Gendang');

        $transaction_id = $this->input->post('transaction_id');

        $update['transaction_status'] = $this->input->post('transaction_status');

        $params = $this->crud->getDataWhere('transactions', 'transaction_id', $transaction_id)->row();

        $table = 'transactions';

        $onjoin = [
            'transaction_details' => $table.'.transaction_id = transaction_details.transaction_id',
            'goods' => 'transaction_details.goods_id = goods.goods_id',
            'account_customers' => $table.'.account_id = account_customers.account_id',
            'payments' => $table.'.payment_id = payments.payment_id',
            'address_customers' => $table.'.address_id = address_customers.address_id',
        ];

        $where = ['transactions.transaction_id' => $params->transaction_id];

        $selectDataEmail = ['transactions.transaction_id', 'account_customers.email', 'account_customers.account_name', 'account_customers.nomor_telp', 'address_customers.alamat', 'address_customers.kecamatan', 'address_customers.kota', 'address_customers.provinsi', 'address_customers.kode_pos', 'goods.nama', 'goods.varian', 'goods.harga', 'transaction_details.qty', 'transactions.transaction_total', 'transactions.shipping', 'transactions.shipping_cost', 'transactions.estimated_day'];

        $data = ['DataTransaction' => $this->crud->getDataJoin($table, $onjoin, $where, $selectDataEmail)->row()];

        // Kirim Email
        if ($update['transaction_status'] === 'Proses') {
            $data['email'] = $data['DataTransaction'];
            $this->email->to($data['email']->email);
            $this->email->subject('Sambalmu sedang dikemas!');
            $customer = $this->load->view('admin/emailcustomer', $data, true);
            $this->email->message($customer);
            $this->email->send();
            $table = 'transaction_details';

            $onjoin = ['goods' => "{$table}.goods_id = goods.goods_id"];

            $where = ['transaction_details.transaction_id' => $transaction_id];

            $select = ['transaction_details.qty', 'goods.stok', 'goods.goods_id'];

            $cancel = $this->crud->getDataJoin($table, $onjoin, $where, $select)->row();

            $this->crud->updateData('goods', 'goods_id', $cancel->goods_id, ['stok' => $cancel->stok - $cancel->qty]);
        }

        if ($update['transaction_status'] === 'Dikirim') {
            if ($params->delivered_date === '0000-00-00') {
                $date = new DateTime();

                $estimated = (int) $params->estimated_day + 3;

                $update['delivered_date'] = $date->format('Y-m-d');
                $update['estimated_date'] = $date->add(new DateInterval("P{$estimated}D"))->format('Y-m-d');
            }

            $update['tracking'] = $this->input->post('tracking');
        }

        $this->crud->updateData('transactions', 'transaction_id', $transaction_id, $update);
        $this->session->set_flashdata('success_update_transaction', 'Data Berhasil Di Di Ubah');
        redirect(base_url('admin/transaksi'));
    }

    public function Testimonial()
    {
        $table = 'testimonials';

        $onjoin = [
            'account_customers' => $table.'.account_id = account_customers.account_id',
        ];

        $select = ['testimonials.ulasan', 'testimonials.rate', 'account_customers.account_name', 'testimonials.transaction_id', 'testimonials.testi_status', 'testimonials.testimonial_id'];

        $data = [
            'content' => 'Admin/KontenTestimonialPage',
            'DataTestimonial' => $this->crud->getDataJoin($table, $onjoin, [], $select)->result(),
            'titlePage' => 'Halaman Testimonial',
            'title' => 'Testimonial',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function UpdateStatusRating()
    {
        $testimonial_id = $this->input->post('testimonial_id');

        $update = [
            'testi_status' => $this->input->post('testi_status'),
        ];

        $this->crud->updateData('testimonials', 'testimonial_id', $testimonial_id, $update);
        $this->session->set_flashdata('success_update_konten_testimonial', 'Data Berhasil Di Ubah');
        redirect(base_url('admin/konten_testimonial'));
    }

    public function Payment()
    {
        $data = [
            'DataPayment' => $this->crud->getData('payments')->result(),
            'content' => 'Admin/KontenPaymentPage',
            'titlePage' => 'Halaman Metode Pembayaran',
            'title' => 'Metode Pembayaran',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function AddDataPayment()
    {
        $add = [
            'payment_img' => $this->uploadImageContentProduct('konten_payment', 'payment_img'),
            'payment_name' => $this->input->post('payment_name'),
            'payment_receiver' => $this->input->post('payment_receiver'),
            'payment_transfer' => $this->input->post('payment_transfer'),
            'payment_status' => $this->input->post('payment_status'),
        ];

        $this->crud->addData('payments', $add);
        $this->session->set_flashdata('success_input_payment', 'Data Berhasil Di Simpan');
        redirect(base_url('admin/payment'));
    }

    public function UpdateDataPayment()
    {
        $payment_id = $this->input->post('payment_id');

        $update = [
            'payment_name' => $this->input->post('payment_name'),
            'payment_receiver' => $this->input->post('payment_receiver'),
            'payment_transfer' => $this->input->post('payment_transfer'),
            'payment_status' => $this->input->post('payment_status'),
        ];

        if (!empty($_FILES['payment_img']['name'])) {
            $this->crud->deleteImage('payments', 'payment_id', $payment_id, 'payment_img', 'konten_payment');
            $update['payment_img'] = $this->uploadImageContentProduct('konten_payment', 'payment_img');
        } else {
            $update['payment_img'] = $this->input->post('old_image');
        }

        $this->crud->updateData('payments', 'payment_id', $payment_id, $update);
        $this->session->set_flashdata('success_update_payment', 'Data Berhasil Di Ubah');
        redirect(base_url('admin/payment'));
    }

    public function ReportTransaction()
    {
        $table = 'transactions';

        $onjoin = [
            'account_customers' => $table.'.account_id = account_customers.account_id',
            'payments' => $table.'.payment_id = payments.payment_id',
        ];

        $select = ['transactions.transaction_id', 'transactions.transaction_date', 'transactions.transaction_total', 'account_customers.account_name', 'payments.payment_name', 'transactions.transaction_status'];

        $data = [
            'DataTransaction' => $this->crud->getDataJoin($table, $onjoin, [], $select)->result(),
            'content' => 'Admin/ReportTransactionPage',
            'titlePage' => 'Halaman Laporan Pemasukan',
            'title' => 'Laporan',
        ];

        $this->load->view('Admin/VBackend', $data);
    }

    public function AdminLogout()
    {
        $this->session->sess_destroy();

        redirect(base_url('sistem/login'));
    }

    public function PrintLaporanPemasukanPdf()
    {
        $this->db->from('transactions');
        $this->db->join('account_customers', 'transactions.account_id = account_customers.account_id');
        $this->db->join('payments', 'transactions.payment_id = payments.payment_id');
        $this->db->where('transactions.transaction_status !=', 'Menunggu');
        $this->db->where('transactions.transaction_status !=', 'Batal');
        $this->db->select('transactions.transaction_id, transactions.transaction_date, transactions.transaction_total, account_customers.account_name, payments.payment_name');
        $query = $this->db->get()->result();

        $data = [
            'DataTransaction' => $query,
        ];

        $this->load->view('Admin/VCetakPDFLaporanPemasukan', $data);
    }

    public function DetailTransaction($params)
    {
        $table = 'transactions';

        $onjoin = [
            'transaction_details' => $table.'.transaction_id = transaction_details.transaction_id',
            'goods' => 'transaction_details.goods_id = goods.goods_id',
            'account_customers' => $table.'.account_id = account_customers.account_id',
            'address_customers' => $table.'.address_id = address_customers.address_id',
        ];

        $where = ['transactions.transaction_id' => $params];

        $select = ['account_customers.account_name', 'account_customers.nomor_telp', 'address_customers.alamat', 'address_customers.kecamatan', 'address_customers.provinsi', 'address_customers.kota', 'address_customers.kode_pos', 'transactions.shipping', 'transactions.shipping_cost', 'goods.nama', 'goods.varian', 'goods.harga', 'transaction_details.qty', 'transactions.transaction_total', 'transactions.transaction_id', 'transaction_details.trs_detail_total', 'transactions.shipping_cost', 'transactions.estimated_day'];

        $detail = $this->crud->getDataJoin($table, $onjoin, $where, $select)->result();

        echo json_encode($detail);
    }

    public function accountSystem()
    {
        $data = ['account' => $this->crud->getDataWhere('account_systems', 'account_id', $this->session->userdata('user_logged')->account_id)->row()];

        echo json_encode($data['account']);
    }

    public function updateAccountSystem()
    {
        $account_id = $this->session->userdata('user_logged')->account_id;

        $update = [
            'email' => $this->input->post('email'),
            'nomor_telp' => "62{$this->input->post('nomor_telp')}",
        ];

        $this->crud->updateData('account_systems', 'account_id', $account_id, $update);
        redirect(base_url('admin'));
    }

    public function PrintLaporanPemasukanExcel()
    {
        header('Content-type=appalication/vnd.ms.excel');
        header('Content-disposition: attachment; filename=Laporan Pemasukan SIMASDANG.xls');

        $this->db->from('transactions');
        $this->db->join('account_customers', 'transactions.account_id = account_customers.account_id');
        $this->db->join('payments', 'transactions.payment_id = payments.payment_id');
        $this->db->where('transactions.transaction_status !=', 'Menunggu');
        $this->db->where('transactions.transaction_status !=', 'Batal');
        $this->db->select('transactions.transaction_id, transactions.transaction_date, transactions.transaction_total, account_customers.account_name, payments.payment_name');
        $query = $this->db->get()->result_array();

        $data = [
            'DataTransaction' => $query,
        ];

        $this->load->view('Admin/VCetakExcelLaporanPemasukan', $data);
    }
}
