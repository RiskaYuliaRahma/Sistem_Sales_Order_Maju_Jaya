<h1 class="page-title">Tambah Sales</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('users/store') ?>
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input class="form-control" type="text" name="username" value="<?= set_value('username') ?>" required>
				<?= form_error('username', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Nama Lengkap</label>
				<input class="form-control" type="text" name="full_name" value="<?= set_value('full_name') ?>" required>
				<?= form_error('full_name', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input class="form-control" type="password" name="password" required>
				<?= form_error('password', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?= site_url('users') ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
	</div>
</div>
