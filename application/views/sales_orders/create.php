<h1 class="page-title">Buat Sales Order</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('sales_orders/store') ?>
			<div class="row mb-3">
				<div class="col-md-6">
					<label class="form-label">No. Order</label>
					<input class="form-control" type="text" value="<?= $order_number ?>" readonly>
				</div>
				<div class="col-md-6">
					<label class="form-label">Tanggal Order</label>
					<input class="form-control" type="date" name="order_date" value="<?= date('Y-m-d') ?>" required>
				</div>
			</div>
			<div class="mb-3">
				<label class="form-label">Pelanggan</label>
				<select class="form-control" name="customer_id" required>
					<option value="">-- Pilih Pelanggan --</option>
					<?php foreach ($customers as $c): ?>
					<option value="<?= $c->id ?>" <?= set_select('customer_id', $c->id) ?>><?= $c->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label">Catatan</label>
				<textarea class="form-control" name="notes" rows="2"><?= set_value('notes') ?></textarea>
			</div>

			<hr>
			<h5>Item Produk</h5>

			<div id="product-rows">
				<div class="row mb-2 product-row">
					<div class="col-md-5">
						<select class="form-control product-select" name="product_id[]" required>
							<option value="">-- Pilih Produk --</option>
							<?php foreach ($products as $p): ?>
							<option value="<?= $p->id ?>" data-price="<?= $p->price ?>" data-stock="<?= $p->stock ?>">
								<?= $p->code ?> - <?= $p->name ?> (Rp <?= number_format($p->price, 0, ',', '.') ?>, Stok: <?= $p->stock ?>)
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3">
						<input class="form-control qty-input" type="number" name="quantity[]" min="1" placeholder="Jumlah" required>
					</div>
					<div class="col-md-3">
						<input class="form-control subtotal-input" type="text" readonly placeholder="Subtotal">
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-danger btn-remove-row" style="display:none;">&times;</button>
					</div>
				</div>
			</div>

			<button type="button" class="btn btn-sm btn-success mb-3" id="add-row"><i class="align-middle" data-feather="plus"></i> Tambah Produk</button>

			<div class="row mb-3">
				<div class="col-md-6 offset-md-6">
					<div class="input-group">
						<span class="input-group-text">Total</span>
						<input class="form-control text-end fw-bold" type="text" id="grand-total" value="Rp 0" readonly>
					</div>
				</div>
			</div>

			<button type="submit" class="btn btn-primary">Simpan Order</button>
			<a href="<?= site_url('sales_orders') ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
	</div>
</div>
