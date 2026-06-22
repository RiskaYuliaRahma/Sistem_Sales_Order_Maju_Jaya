<h1 class="page-title">Edit Sales Order</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('sales_orders/update/'.$order->id) ?>
			<div class="row mb-3">
				<div class="col-md-6">
					<label class="form-label">No. Order</label>
					<input class="form-control" type="text" value="<?= $order->order_number ?>" readonly>
				</div>
				<div class="col-md-6">
					<label class="form-label">Tanggal Order</label>
					<input class="form-control" type="date" name="order_date" value="<?= $order->order_date ?>" required>
				</div>
			</div>
			<div class="mb-3">
				<label class="form-label">Pelanggan</label>
				<select class="form-control" name="customer_id" required>
					<?php foreach ($customers as $c): ?>
					<option value="<?= $c->id ?>" <?= $order->customer_id == $c->id ? 'selected' : '' ?>><?= $c->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">Catatan</label>
				<textarea class="form-control" name="notes" rows="2"><?= $order->notes ?></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
			<a href="<?= site_url('sales_orders/show/'.$order->id) ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
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
					<th>#</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($items as $item): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $item->product_code ?> - <?= $item->product_name ?></td>
					<td>Rp <?= number_format($item->unit_price, 0, ',', '.') ?></td>
					<td><?= $item->quantity ?></td>
					<td>Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr class="fw-bold">
					<td colspan="4" class="text-end">Total</td>
					<td>Rp <?= number_format($order->total_amount, 0, ',', '.') ?></td>
				</tr>
			</tfoot>
		</table>
		</div>
	</div>
</div>
