<h1 class="page-title">Edit Produk</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('products/update/'.$product->id) ?>
			<div class="mb-3">
				<label class="form-label">Kode Produk</label>
				<input class="form-control" type="text" name="code" value="<?= set_value('code', $product->code) ?>" required>
				<?= form_error('code', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Nama Produk</label>
				<input class="form-control" type="text" name="name" value="<?= set_value('name', $product->name) ?>" required>
				<?= form_error('name', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Harga</label>
				<input class="form-control" type="text" name="price" value="<?= set_value('price', $product->price) ?>" required>
				<?= form_error('price', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Stok</label>
				<input class="form-control" type="number" name="stock" value="<?= set_value('stock', $product->stock) ?>" min="0" required>
				<?= form_error('stock', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
			<a href="<?= site_url('products') ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
	</div>
</div>
