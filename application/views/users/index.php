<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="page-title">Data Sales</h1><br>
	<a href="<?= site_url('users/create') ?>" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Tambah Sales</a>
</div>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-4">
				<form method="get" class="d-flex">
					<input class="form-control me-2" type="text" name="search" placeholder="Cari sales..." value="<?= $search ?>">
					<button class="btn btn-primary" type="submit">Cari</button>
					<?php if ($search): ?>
					<a href="<?= site_url('users') ?>" class="btn btn-secondary ms-2">Reset</a>
					<?php endif; ?>
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table id="myTable" class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($users): ?>
					<?php $no=1; foreach ($users as $u): ?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $u->username ?></td>
						<td><?= $u->full_name ?></td>
						<td class="text-center">
							<a href="<?= site_url('users/edit/'.$u->id) ?>" class="btn btn-sm btn-primary">Edit</a>
							<a href="<?= site_url('users/delete/'.$u->id) ?>" class="btn btn-sm btn-danger" data-confirm="Hapus sales ini?">Hapus</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr><td colspan="4" class="text-center">Belum ada data sales</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
