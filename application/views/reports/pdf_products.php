<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Per Produk</title>
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
	<div class="title">Laporan Penjualan Per Produk</div>
	<div class="company"><strong>PT MAJU JAYA</strong></div><br>
	<table>
		<thead>
			<tr>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>No</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Kode</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Nama Produk</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Total Terjual</strong></th>
				<th style="background-color:#D9EAF7; text-align:center;"><strong>Total Revenue</strong></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($reports as $r): ?>
			<tr>
				<td align="center"><?= $no++ ?></td>
				<td align="center"><?= $r->code ?></td>
				<td><?= $r->name ?></td>
				<td align="center"><?= $r->total_qty ?></td>
				<td align="right">
					Rp <?= number_format($r->total_revenue, 0, ',', '.') ?>
				</td>
			</tr>
			<?php endforeach; ?>

			<?php
			$total_qty = 0;
			$total_revenue = 0;

			foreach ($reports as $item) {
				$total_qty += $item->total_qty;
				$total_revenue += $item->total_revenue;
			}
			?>

			<tr style="background-color:#D9EAF7;">
				<td colspan="3" align="left">
					<strong>Total</strong>
				</td>

				<td align="center">
					<strong><?= $total_qty ?></strong>
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
