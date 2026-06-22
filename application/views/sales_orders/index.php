<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="page-title">Sales Order</h1><br>
	<a href="<?= site_url('sales_orders/create') ?>" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Buat Order</a>
</div>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-4">
				<form method="get" class="d-flex">
					<input class="form-control me-2" type="text" name="search" placeholder="Cari order..." value="<?= $search ?>">
					<button class="btn btn-primary" type="submit">Cari</button>
					<?php if ($search): ?>
					<a href="<?= site_url('sales_orders') ?>" class="btn btn-secondary ms-2">Reset</a>
					<?php endif; ?>
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table id="myTable" class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Order</th>
						<th>Pelanggan</th>
						<th>Sales</th>
						<th>Tanggal</th>
						<th>Total</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($orders): ?>
					<?php $no=1; foreach ($orders as $o): ?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td class="text-center"><?= $o->order_number ?></td>
						<td><?= $o->customer_name ?></td>
						<td><?= $o->sales_name ?></td>
						<td class="text-center"><?= date('d/m/Y', strtotime($o->order_date)) ?></td>
						<td class="text-end">Rp <?= number_format($o->total_amount, 0, ',', '.') ?></td>
						<td class="text-center">
							<span class="badge bg-<?= $o->status == 'selesai' ? 'success' : ($o->status == 'dibatalkan' ? 'danger' : ($o->status == 'dikirim' ? 'info' : 'warning')) ?>">
								<?= ucfirst($o->status) ?>
							</span>
						</td>
						<td class="text-center">
							<a href="<?= site_url('sales_orders/show/'.$o->id) ?>" class="btn btn-sm btn-info">Detail</a>
							<?php if ($o->status == 'draft'): ?>
							<a href="<?= site_url('sales_orders/edit/'.$o->id) ?>" class="btn btn-sm btn-primary">Edit</a>
							<a href="<?= site_url('sales_orders/delete/'.$o->id) ?>" class="btn btn-sm btn-danger" data-confirm="Hapus order ini?">Hapus</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr><td colspan="8" class="text-center">Tidak ada sales order</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
