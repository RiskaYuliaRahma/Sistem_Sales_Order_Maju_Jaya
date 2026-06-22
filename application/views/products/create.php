<h1 class="page-title">Tambah Produk</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('products/store') ?>
			<div class="mb-3">
				<label class="form-label">Kode Produk</label>
				<input class="form-control" type="text" name="code" value="<?= set_value('code') ?>" required>
				<?= form_error('code', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Nama Produk</label>
				<input class="form-control" type="text" name="name" value="<?= set_value('name') ?>" required>
				<?= form_error('name', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Harga</label>
				<input class="form-control" type="text" name="price" value="<?= set_value('price') ?>" required>
				<?= form_error('price', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Stok</label>
				<input class="form-control" type="number" name="stock" value="<?= set_value('stock', 0) ?>" min="0" required>
				<?= form_error('stock', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?= site_url('products') ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
	</div>
</div>
