<h1 class="page-title">Tambah Pelanggan</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('customers/store') ?>
			<div class="mb-3">
				<label class="form-label">Nama Pelanggan</label>
				<input class="form-control" type="text" name="name" value="<?= set_value('name') ?>" required>
				<?= form_error('name', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Alamat</label>
				<textarea class="form-control" name="address" rows="3"><?= set_value('address') ?></textarea>
			</div>
			<div class="mb-3">
				<label class="form-label">No. Telepon</label>
				<input class="form-control" type="text" name="phone" value="<?= set_value('phone') ?>" required>
				<?= form_error('phone', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?= site_url('customers') ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
	</div>
</div>
