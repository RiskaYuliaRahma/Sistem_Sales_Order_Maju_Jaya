<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="page-title">Laporan Per Sales</h1><br>
	<a href="<?= site_url('reports/export_pdf?type=sales&start_date='.$start_date.'&end_date='.$end_date) ?>" class="btn btn-danger"><i class="align-middle" data-feather="file-text"></i> Export PDF</a>
</div>

<div class="card">
	<div class="card-body">
		<form class="row mb-3" method="get">
			<div class="col-md-4">
				<label class="form-label">Dari Tanggal</label>
				<input class="form-control" type="date" name="start_date" value="<?= $start_date ?>">
			</div>
			<div class="col-md-4">
				<label class="form-label">Sampai Tanggal</label>
				<input class="form-control" type="date" name="end_date" value="<?= $end_date ?>">
			</div>
			<div class="col-md-4 d-flex align-items-end">
				<button type="submit" class="btn btn-primary">Filter</button>
				<a href="<?= site_url('reports/sales') ?>" class="btn btn-secondary ms-2">Reset</a>
			</div>
		</form>

		<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Sales</th>
					<th>Total Order</th>
					<th>Total Revenue</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($reports): ?>
				<?php $no=1; foreach ($reports as $r): ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td><?= $r->full_name ?></td>
					<td class="text-center"><?= $r->total_orders ?></td>
					<td class="text-end">Rp <?= number_format($r->total_revenue, 0, ',', '.') ?></td>
				</tr>
				<?php endforeach; ?>
				<?php else: ?>
				<tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
				<?php endif; ?>
			</tbody>

			<?php if ($reports): ?>
			<?php
			$total_orders = 0;
			$total_revenue = 0;

			foreach ($reports as $r) {
				$total_orders += $r->total_orders;
				$total_revenue += $r->total_revenue;
			}
			?>
			<tfoot>
				<tr>
					<td colspan="2" class="text-start">Total</td>
					<td class="text-center"><?= $total_orders ?></td>
					<td class="text-end">
						Rp <?= number_format($total_revenue, 0, ',', '.') ?>
					</td>
				</tr>
			</tfoot>
			<?php endif; ?>

			</table>
					</table>
		</div>
	</div>
</div>
