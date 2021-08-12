<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h3 styl="text-align; center;front-size;2,0em !important;">Laporan Pemasukan SIMASDANG</h3>
	<table width='100%' cellspacing='1' cellpadding='4' align='center' border='1'>
		<thead>
			<th>No</th>
			<th>Transaction ID</th>
            <th>Transaction Date</th>
            <th>Transaction Total</th>
            <th>Account Nama</th>
            <th>Pembayaran</th>
			</tr>
		</thead>
<?php
	$i = 0;
	foreach ($DataTransaction as $transaction) 
	{
	echo "
		<tr>
			<td align='center'>".++$i."</td>
			<td align='center'>`".$transaction['transaction_id']."</td>
			<td align='center'>".$transaction['transaction_date']."</td>
			<td align='center'>".$transaction['transaction_total']."</td>
			<td align='center'>".$transaction['account_name']."</td>
			<td align='center'>".$transaction['payment_name']."</td>
		</tr>
		";
	}
?>
</table>
</body>
</html>