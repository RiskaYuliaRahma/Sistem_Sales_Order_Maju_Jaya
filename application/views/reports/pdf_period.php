<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Per Periode</title>
	<style>
		body {
		font-family: "Times New Roman", serif;
		font-size: 12px;
		margin: 0; 
		padding: 0;
		}

		.title{
			font-size:14pt;
			font-weight:bold;
			text-align:center;
			margin: 0;
			padding: 0;
		}

		.company{
			font-size:12pt;
			text-align:center;
			margin: 0;
			padding: 0;
		}

		table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 0;
		}

		th, td {
			border: 1px solid #000;
			padding: 6px;
			font-size: 11pt;
			vertical-align: middle;
		}
	</style>
</head>
<body>
	<div class="title">Laporan Penjualan Per Periode</div>
	<div class="company"><strong>PT MAJU JAYA</strong></div><br>
	<table>
		<thead>
			<tr>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>No</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Tanggal</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Total Order</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Total Revenue</strong></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($reports as $r): ?>
			<tr>
				<td align="center"><?= $no++ ?></td>
				<td align="center"><?= date('d/m/Y', strtotime($r->date)) ?></td>
				<td align="center"><?= $r->total_orders ?></td>
				<td align="right">
					Rp <?= number_format($r->total_revenue, 0, ',', '.') ?>
				</td>
			</tr>
			<?php endforeach; ?>

			<?php
			$total_orders = 0;
			$total_revenue = 0;

			foreach ($reports as $item) {
				$total_orders += $item->total_orders;
				$total_revenue += $item->total_revenue;
			}
			?>

			<tr style="background-color:#D9EAF7;">
				<td colspan="2" align="left">
					<strong>Total</strong>
				</td>

				<td align="center">
					<strong><?= $total_orders ?></strong>
				</td>

				<td align="right">
					<strong>
						Rp <?= number_format($total_revenue, 0, ',', '.') ?>
					</strong>
				</td>
			</tr>
		</tbody>
				
	</table>
</body>
</html>
