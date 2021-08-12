<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UnSessionController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CrudModel', 'crud');
        if ($this->session->userdata('user_logged') !== null) {
            redirect('user');
        }
    }

    public function index()
    {
        $table = 'goods_content';

        $onjoin = ['goods' => $table.'.goods_id = goods.goods_id'];

        $selectGoods = ['goods_content.goods_status', 'goods_content.goods_img', 'goods.nama', 'goods.varian', 'goods.harga', 'goods.goods_id'];

        $tableTesti = 'testimonials';

        $onjoinTesti = ['account_customers' => $tableTesti.'.account_id = account_customers.account_id'];

        $whereTesti = ['testimonials.testi_status' => 1];

        $selectTesti = ['account_customers.account_img', 'account_customers.account_name', 'testimonials.rate', 'testimonials.ulasan'];

        $dataTesti = $this->crud->getData('testimonials')->row();

        $rate = 0;

        if (isset($dataTesti)) {
            $rate = (int) $this->crud->getDataSum([], 'testimonials', 'rate')->rate / (int) $this->crud->getDataCount([], 'testimonials');
        }

        $data = [
            'rate' => $rate,
            'sell' => $this->crud->getDataSum([], 'transaction_details', 'qty')->qty,
            'about_us' => $this->crud->getData('about_us')->result(),
            'products' => $this->crud->getDataJoin($table, $onjoin, [], $selectGoods)->result(),
            'ulasans' => $this->crud->getDataJoin($tableTesti, $onjoinTesti, $whereTesti, $selectTesti)->result(),
        ];

        $this->load->view('UnSession/Beranda', $data);
    }

    public function productDetail($params)
    {
        $table = 'goods_content';

        $onjoin = ['goods' => $table.'.goods_id = goods.goods_id'];

        $dataSelect = ['goods.goods_id' => $params];

        $select = ['goods.harga', 'goods.nama', 'goods.varian', 'goods.berat', 'goods_content.status', 'goods_content.deskripsi', 'goods_content.goods_img', 'goods.goods_id', 'goods.stok'];

        $data['product_detail'] = $this->crud->getDataJoin($table, $onjoin, $dataSelect, $select)->row();

        if (!$data['product_detail']) {
            redirect(base_url('/'));
        }

        $this->load->view('UnSession/ProductDetailPage', $data);
    }

    public function StockProduct($params)
    {
        $data = $this->crud->getDataWhere('goods', 'goods_id', $params)->row();

        echo json_encode($data);
    }
}
