<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">Laporan Transaksi</h3>
                    </div>
                    <div class="dropdown-divider mb-3"></div>
                    
                    <a class="btn btn-info mb-3" href="<?= base_url('admin/excel'); ?>">Print Excel</a>
                    <a class="btn btn-primary mb-3" href="<?= base_url('admin/pdf'); ?>">Print Pdf</a>
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-striped table-bordered"
                        >
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Transaction Date</th>
                                    <th>Transaction Total</th>
                                    <th>Account Nama</th>
                                    <th>Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataTransaction)) : $i = 0; foreach ($DataTransaction as $transaction) : if ($transaction->transaction_status != 'Menunggu' && $transaction->transaction_status != 'Batal') : ?>

                                    <tr>
                                        <td><?= $transaction->transaction_id; ?></td>
                                        <td><?= $transaction->transaction_date; ?></td>
                                        <td>Rp<?= number_format($transaction->transaction_total, 0, '', '.'); ?></td>
                                        <td><?= $transaction->account_name; ?></td>
                                        <td><?= $transaction->payment_name; ?></td>
                                    </tr>

                                <?php endif; endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
