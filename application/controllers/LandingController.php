<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LandingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CrudModel', 'crud');
        $this->load->library('session');
        if ($this->session->userdata('user_logged')->customer_role !== 'Pelanggan') {
            redirect('user/login');
        }
    }

    public function index()
    {
        $this->db->from('transactions');
        $this->db->join('transaction_details', 'transactions.transaction_id=transaction_details.transaction_id');
        $this->db->where('transactions.transaction_status', 'Proses');
        $this->db->or_where('transactions.transaction_status', 'Dikirim');
        $this->db->or_where('transactions.transaction_status', 'Selesai');
        $this->db->select_sum('transaction_details.qty');
        $sell = $this->db->get()->row();

        $table = 'goods_content';

        $onjoin = ['goods' => $table.'.goods_id = goods.goods_id'];

        $selectGoods = ['goods_content.goods_status', 'goods_content.goods_img', 'goods.nama', 'goods.varian', 'goods.harga', 'goods.goods_id'];

        $tableTesti = 'testimonials';

        $onjoinTesti = [
            'account_customers' => $tableTesti.'.account_id = account_customers.account_id',
            'transactions' => $tableTesti.'.transaction_id = transactions.transaction_id',
        ];

        $whereTesti = ['testimonials.testi_status' => 1];

        $selectTesti = ['account_customers.account_img', 'account_customers.account_name', 'testimonials.rate', 'testimonials.ulasan'];

        $dataTesti = $this->crud->getData('testimonials')->row();

        $rate = 0;

        if (isset($dataTesti)) {
            $rate = (int) $this->crud->getDataSum([], 'testimonials', 'rate')->rate / (int) $this->crud->getDataCount([], 'testimonials');
        }

        $data = [
            'rate' => $rate,
            'sell' => $sell->qty,
            'about_us' => $this->crud->getData('about_us')->result(),
            'products' => $this->crud->getDataJoin($table, $onjoin, [], $selectGoods)->result(),
            'ulasans' => $this->crud->getDataJoin($tableTesti, $onjoinTesti, $whereTesti, $selectTesti)->result(),
            'whatsapp' => $this->crud->getDataWhere('account_systems', 'role', 'admin')->row()->nomor_telp,
        ];

        $this->load->view('LandingPage/Beranda', $data);
    }

    public function productDetail($params)
    {
        $this->db->where('account_id', $this->session->userdata('user_logged')->account_id);
        $this->db->where('deleted', 0);
        $this->db->select('alamat, kecamatan, city_id');
        $query = $this->db->get('address_customers')->row();

        if (!boolval($query)) {
            $this->session->set_flashdata('error', 'Alamatmu belum tersedia untuk saat ini. Silahkan coba daftarkan');
            redirect(base_url('user/account'));
        }

        $table = 'goods_content';

        $onjoin = ['goods' => $table.'.goods_id = goods.goods_id'];

        $where = ['goods.goods_id' => $params];

        $select = ['goods.harga', 'goods.nama', 'goods.varian', 'goods.berat', 'goods_content.status', 'goods_content.deskripsi', 'goods_content.goods_img', 'goods.goods_id', 'goods.stok'];

        $data = [
            'product_detail' => $this->crud->getDataJoin($table, $onjoin, $where, $select)->row(),
            'ongkir' => $this->cekOngkirLanding($query->city_id)->rajaongkir->results[0]->costs[0],
            'account' => $query,
        ];

        $this->load->view('LandingPage/ProductDetailPage', $data);
    }

    public function formOrder($params)
    {
        $table = 'goods_content';

        $onjoin = ['goods' => $table.'.goods_id = goods.goods_id'];

        $dataSelect = ['goods.goods_id' => $params];

        $select = ['goods.harga', 'goods.goods_id', 'goods.nama', 'goods.varian'];

        $account = $this->crud->getDataWhere('account_customers', 'account_id', $this->session->userdata('user_logged')->account_id)->row();

        $data = [
            'product_detail' => $this->crud->getDataJoin($table, $onjoin, $dataSelect)->row(),
            'DataAccount' => $account,
        ];

        $this->load->view('LandingPage/FormOrderPage', $data);
    }

    public function AddFormOrder()
    {
        $date = new DateTime();

        $goods_id = $this->input->post('goods_id');

        $qty = $this->input->post('qty');

        $harga = $this->input->post('total');

        $kurir = explode(',', $this->input->post('ongkir'));

        $cek = implode('', explode('.', implode('', explode('Rp', $harga))));

        $address = explode(',', $this->input->post('address_id'));

        $account = $this->crud->getDataWhere('account_customers', 'account_id', $this->session->userdata('user_logged')->account_id)->row();

        $transaction_id = $this->crud->generateCode('10', 'transaction_id', 'transactions');

        $stokBarang = $this->crud->getDataWhere('goods', 'goods_id', $goods_id)->row();

        $addTransaction = [
            'transaction_id' => $transaction_id,
            'transaction_date' => date('Y-m-d'),
            'transaction_total' => $cek - $kurir[1],
            'transaction_status' => 'Menunggu',
            'account_id' => $this->session->userdata('user_logged')->account_id,
            'shipping' => $kurir[0],
            'shipping_cost' => $kurir[1],
            'payment_id' => 1,
            'estimated_day' => explode('-', $kurir[2])[1],
            'address_id' => $address[0],
        ];

        $addTransactionDetail = [
            'transaction_id' => $transaction_id,
            'goods_id' => $goods_id,
            'qty' => $qty,
            'trs_detail_total' => $cek - $kurir[1],
        ];

        $this->crud->addData('transactions', $addTransaction);
        $this->crud->addData('transaction_details', $addTransactionDetail);

        redirect(base_url('user/checkout/'.$transaction_id));
    }

    public function payments($params)
    {
        $table = 'transactions';

        $joinValidate = ['account_customers' => $table.'.account_id = account_customers.account_id'];

        $where = [
            'transactions.transaction_id' => $params,
            'account_customers.account_id' => $this->session->userdata('user_logged')->account_id,
        ];

        $validateData = $this->crud->getDataJoin($table, $joinValidate, $where, ['transactions.transaction_id'])->row();

        if (!isset($validateData)) {
            redirect(base_url('user'));
        }

        $data['payments'] = $this->crud->getDataWhere('payments', 'payment_status', 1)->result();
        $this->load->view('LandingPage/PaymentPage', $data);
    }

    public function ProcessPayments($params)
    {
        $update = ['payment_id' => $this->input->post('payment_id')];

        $this->crud->updateData('transactions', 'transaction_id', $params, $update);
        redirect(base_url('user/detail_payment/'.$update['payment_id']));
    }

    public function DetailPayments($params)
    {
        $data = [
            'DataPayment' => $this->crud->getDataWhere('payments', 'payment_id', $params)->row(),
            'whatsapp' => $this->crud->getDataWhere('account_systems', 'role', 'admin')->row()->nomor_telp,
        ];

        if (!isset($data['DataPayment']->payment_id)) {
            redirect(base_url('user'));
        }

        $this->load->view('LandingPage/DetailPaymentPage', $data);
    }

    public function UserCheckout($params)
    {
        $table = 'transactions';

        $joinValidate = ['account_customers' => $table.'.account_id = account_customers.account_id'];

        $where = [
            'transactions.transaction_id' => $params,
            'account_customers.account_id' => $this->session->userdata('user_logged')->account_id,
        ];

        $validateData = $this->crud->getDataJoin($table, $joinValidate, $where, ['transactions.transaction_id'])->row();

        if (!isset($validateData)) {
            redirect(base_url('user'));
        }

        $onjoin = [
            'transaction_details' => $table.'.transaction_id = transaction_details.transaction_id',
            'goods' => 'transaction_details.goods_id = goods.goods_id',
            'account_customers' => $table.'.account_id = account_customers.account_id',
            'address_customers' => $table.'.address_id = address_customers.address_id',
        ];

        $select = ['account_customers.account_name', 'account_customers.nomor_telp', 'address_customers.alamat', 'address_customers.kecamatan', 'address_customers.provinsi', 'address_customers.kota', 'address_customers.kode_pos', 'transactions.shipping', 'transactions.shipping_cost', 'goods.nama', 'goods.varian', 'goods.harga', 'transaction_details.qty', 'transactions.transaction_total', 'transactions.transaction_id', 'transactions.estimated_day'];

        $data = ['DataTransaction' => $this->crud->getDataJoin($table, $onjoin, $where, $select)->row()];

        $this->load->view('LandingPage/ListOrderPage', $data);
    }

    public function StockProduct($params)
    {
        $data = $this->crud->getDataWhere('goods', 'goods_id', $params)->row();

        echo json_encode($data);
    }

    public function UserAccount()
    {
        $account_id = $this->session->userdata('user_logged')->account_id;

        $data = [
            'DataAccount' => $this->crud->getDataWhere('account_customers', 'account_id', $account_id)->row(),
            // 'DataAlamat' => $this->crud->getDataWhere('address_customers', 'account_id', $account_id)->result(),
        ];

        $this->load->view('LandingPage/UserDetail', $data);
    }

    public function UserAddress()
    {
        $account_id = $this->session->userdata('user_logged')->account_id;
        $DataAlamat = $this->crud->getDataWhere('address_customers', 'account_id', $account_id)->result();

        echo json_encode($DataAlamat);
    }

    public function AddUserAddress()
    {
        $address = explode(',', $this->input->post('city_id'));

        $add = [
            'city_id' => $address[0],
            'provinsi' => $address[1],
            'kota' => $address[2],
            'kecamatan' => $this->input->post('kecamatan'),
            'kode_pos' => $this->input->post('kode_pos'),
            'alamat' => $this->input->post('alamat'),
            'account_id' => $this->input->post('account_id'),
        ];

        $this->crud->AddData('address_customers', $add);
        redirect(base_url('user/account'));
    }

    public function DeleteUserAddress($params)
    {
        $dataAddress = $this->crud->getDataWhere('address_customers', 'address_id', $params)->row();

        if (!isset($dataAddress->address_id)) {
            redirect(base_url('user/account'));
        }

        $this->crud->updateData('address_customers', 'address_id', $params, ['deleted' => 1]);
        redirect(base_url('user/account'));
    }

    public function UpdateUserAddress($params)
    {
        $account_id = $this->session->userdata('user_logged')->account_id;
        $table = 'address_customers';
        $data = [
            'DataAccount' => $this->crud->getDataWhere('account_customers', 'account_id', $account_id)->row(),
            'DataAlamat' => $this->crud->getDataWhere('address_customers', 'address_id', $params)->row(),
        ];

        $this->load->view('LandingPage/UpdateAddressPage', $data);
    }

    public function AccountProcess()
    {
        $account_id = $this->input->post('account_id');
        $update['username'] = $this->input->post('username');
        $update['account_name'] = $this->input->post('account_name');
        $update['jk'] = $this->input->post('jk');
        $update['tgl_lahir'] = $this->input->post('tgl_lahir');
        $update['nomor_telp'] = $this->input->post('nomor_telp');
        $update['email'] = $this->input->post('email');

        if (!empty($_FILES['account_img']['name'])) {
            $this->crud->deleteImage('account_customers', 'account_id', $account_id, 'account_img', 'account_customers');

            $update['account_img'] = $this->uploadImageLandingUser('account_customers', 'account_img');
        } else {
            $update['account_img'] = $this->input->post('old_image');
        }

        $this->crud->UpdateData('account_customers', 'account_id', $account_id, $update);
        redirect(base_url('user/account'));
    }

    private function uploadImageLandingUser($folder, $field)
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

    public function UpdatePassword()
    {
        $account_id = $this->input->post('account_id');

        $password = ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)];
        $confirmPass = $this->input->post('konfirmasi_password');

        if ($this->input->post('password') === $confirmPass) {
            $this->crud->UpdateData('account_customers', 'account_id', $account_id, $password);

            $this->session->set_flashdata('success_update_password', 'Kata sandi berhasil diubah');
            redirect(base_url('user/account'));
        } else {
            $this->session->set_flashdata('failed_update_password', 'Kata sandi gagal diubah');
            redirect(base_url('user/account'));
        }
    }

    public function UpdateAddress()
    {
        $address = explode(',', $this->input->post('city_id'));

        $update = [
            'address_id' => $this->input->post('address_id'),
            'city_id' => $address[0],
            'provinsi' => $address[1],
            'kota' => $address[2],
            'kecamatan' => $this->input->post('kecamatan'),
            'kode_pos' => $this->input->post('kode_pos'),
            'alamat' => $this->input->post('alamat'),
        ];

        $this->crud->UpdateData('address_customers', 'address_id', $update['address_id'], $update);

        redirect(base_url('user/account'));
    }

    public function HistoryTransaction()
    {
        $account_id = $this->session->userdata('user_logged')->account_id;

        $data = [
            'DataRiwayat' => $this->crud->getDataWhere('transactions', 'account_id', $account_id)->result(),
            'DataAccount' => $this->crud->getDataWhere('account_customers', 'account_id', $account_id)->row(),
            'whatsapp' => $this->crud->getDataWhere('account_systems', 'role', 'admin')->row()->nomor_telp,
        ];

        $this->load->view('LandingPage/HistoryTransactionPage', $data);
    }

    public function RatingUlasan($params)
    {
        $data = [
            'transaction_id' => $params,
        ];

        $this->load->view('LandingPage/RatingPage', $data);
    }

    public function RatingProcess($params)
    {
        $add = [
            'testimonial_id' => $this->crud->generateCode(10, 'testimonial_id', 'testimonials'),
            'ulasan' => $this->input->post('ulasan'),
            'rate' => $this->input->post('star'),
            'testi_status' => 0,
            'account_id' => $this->session->userdata('user_logged')->account_id,
            'transaction_id' => $this->input->post('transaction_id'),
        ];

        $this->crud->updateData('transactions', 'transaction_id', $add['transaction_id'], ['transaction_status' => 'Selesai']);

        $this->crud->addData('testimonials', $add);

        redirect(base_url('user/history'));
    }

    public function cekKota($params = '')
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id={$params}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
                'key: b93be97bd4c41c41886e32e91af735ce',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        echo $response;
    }

    public function cekOngkir($destination = '')
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.rajaongkir.com/starter/cost',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "origin=79&destination={$destination}&weight=300&courier=jne",
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded',
                'key: b93be97bd4c41c41886e32e91af735ce',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;
    }

    public function cekOngkirLanding($destination = '')
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.rajaongkir.com/starter/cost',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "origin=79&destination={$destination}&weight=300&courier=jne",
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded',
                'key: b93be97bd4c41c41886e32e91af735ce',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    public function HistoryDetail($params)
    {
        $table = 'transactions';

        $onjoin = [
            'transaction_details' => $table.'.transaction_id = transaction_details.transaction_id',
            'goods' => 'transaction_details.goods_id = goods.goods_id',
            'account_customers' => $table.'.account_id = account_customers.account_id',
            'address_customers' => $table.'.address_id = address_customers.address_id',
        ];

        $where = ['transactions.transaction_id' => $params];

        $select = ['account_customers.account_name', 'account_customers.nomor_telp', 'address_customers.alamat', 'address_customers.kecamatan', 'address_customers.provinsi', 'address_customers.kota', 'address_customers.kode_pos', 'transactions.shipping', 'transactions.shipping_cost', 'goods.nama', 'goods.varian', 'goods.harga', 'transaction_details.qty', 'transactions.transaction_total', 'transactions.transaction_id', 'transaction_details.trs_detail_total', 'transactions.shipping_cost', 'transactions.transaction_date', 'transactions.estimated_date', 'transactions.delivered_date'];

        $detail = $this->crud->getDataJoin($table, $onjoin, $where, $select)->result();

        echo json_encode($detail);
    }

    public function UserLogout()
    {
        $this->session->sess_destroy();

        redirect(base_url('user/login'));
    }
}
