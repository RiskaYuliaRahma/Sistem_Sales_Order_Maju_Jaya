<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h3 mb-0"><strong>Detail Sales Order<strong></h1>
	<div>
		<?php if ($order->status == 'draft'): ?>
		<a href="<?= site_url('sales_orders/edit/'.$order->id) ?>" class="btn btn-primary">Edit</a>
		<a href="<?= site_url('sales_orders/delete/'.$order->id) ?>" class="btn btn-danger" data-confirm="Hapus order ini?">Hapus</a>
		<?php endif; ?>
		<a href="<?= site_url('sales_orders') ?>" class="btn btn-secondary">Kembali</a>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Informasi Order</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="200">No. Order</th>
						<td><?= $order->order_number ?></td>
					</tr>
					<tr>
						<th>Tanggal</th>
						<td><?= date('d/m/Y', strtotime($order->order_date)) ?></td>
					</tr>
					<tr>
						<th>Pelanggan</th>
						<td><?= $order->customer_name ?><br>
							<small><?= $order->customer_address ?><br><?= $order->customer_phone ?></small>
						</td>
					</tr>
					<tr>
						<th>Sales</th>
						<td><?= $order->sales_name ?></td>
					</tr>
					<tr>
						<th>Status</th>
						<td>
							<span class="badge bg-<?= $order->status == 'selesai' ? 'success' : ($order->status == 'dibatalkan' ? 'danger' : ($order->status == 'dikirim' ? 'info' : 'warning')) ?>">
								<?= ucfirst($order->status) ?>
							</span>
						</td>
					</tr>
					<?php if ($order->notes): ?>
					<tr>
						<th>Catatan</th>
						<td><?= $order->notes ?></td>
					</tr>
					<?php endif; ?>
				</table>
			</div>
		</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Ubah Status</h5>
			</div>
			<div class="card-body">
				<?= form_open('sales_orders/change_status/'.$order->id) ?>
				<div class="mb-3">
					<select class="form-control" name="status">
						<option value="draft" <?= $order->status == 'draft' ? 'selected' : '' ?>>Draft</option>
						<option value="dikirim" <?= $order->status == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
						<option value="selesai" <?= $order->status == 'selesai' ? 'selected' : '' ?>>Selesai</option>
						<option value="dibatalkan" <?= $order->status == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
					</select>
				</div>
				<button type="submit" class="btn btn-warning w-100">Update Status</button>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>

<div class="card mt-3">
	<div class="card-header">
		<h5 class="card-title">Item Order</h5>
	</div>
	<div class="card-body">
		<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Produk</th>
					<th class="text-center">Harga</th>
					<th class="text-center">Jumlah</th>
					<th class="text-center">Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($items as $item): ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td><?= $item->product_code ?> - <?= $item->product_name ?></td>
					<td class="text-center">Rp <?= number_format($item->unit_price, 0, ',', '.') ?></td>
					<td class="text-center"><?= $item->quantity ?></td>
					<td class="text-center">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"></td>

					<td class="text-end">
						<div class="bg-warning text-white px-3 py-1 d-inline-flex rounded fw-bold">
							Total Rp <?= number_format($order->total_amount, 0, ',', '.') ?>
						</div>
					</td>
				</tr>
			</tfoot>
		

		</table>
		</div>
	</div>
</div>