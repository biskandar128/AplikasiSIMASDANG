<?php

            $pdf = new Pdf('mm', 'A4', true, 'UTF-8', false);
            $pdf->SetPageOrientation('P');
            $pdf->SetTitle('Laporan Pemasukan SIMASDANG');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage();
            $i = 0;
            $html = '<h3>Laporan Transaksi SIMASDANG</h3>
                    <table cellspacing="2" bgcolor="#666666" cellpadding="2" style="font-size:6px;">
                        <tr bgcolor="#ffffff">
                            <th width="5%" align="center">NO</th>
                            <th width="20%" align="center">Transaksi ID</th>
                            <th width="20%" align="center">Tanggal</th>
                            <th width="20%" align="center">Total</th>
                            <th width="20%" align="center">Nama Akun</th>
                            <th width="15%" align="center">Pembayaran</th>                          
                        </tr>';
            foreach ($DataTransaction as $transaction) {
                ++$i;
                $html .= '<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>

                            <td align="center">'.$transaction->transaction_id.'</td>
                            <td align="center">'.$transaction->transaction_date.'</td>
                            <td align="center">'.$transaction->transaction_total.'</td>
                            <td align="center">'.$transaction->account_name.'</td>
                            <td align="center">'.$transaction->payment_name.'</td>

                        </tr>';
            }
            $html .= '</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('Laporan Pemasukan SIMASDANG.pdf', 'I');
