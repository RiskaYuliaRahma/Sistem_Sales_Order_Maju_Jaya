<h1 class="page-title">Edit Sales</h1><br>

<div class="card">
	<div class="card-body">
		<?= form_open('users/update/'.$user->id) ?>
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input class="form-control" type="text" name="username" value="<?= set_value('username', $user->username) ?>" required>
				<?= form_error('username', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Nama Lengkap</label>
				<input class="form-control" type="text" name="full_name" value="<?= set_value('full_name', $user->full_name) ?>" required>
				<?= form_error('full_name', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label class="form-label">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
				<input class="form-control" type="password" name="password">
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
			<a href="<?= site_url('users') ?>" class="btn btn-secondary">Kembali</a>
		<?= form_close() ?>
	</div>
</div>
