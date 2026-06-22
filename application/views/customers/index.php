<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="page-title">Data Pelanggan</h1><br>
	<a href="<?= site_url('customers/create') ?>" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Tambah Pelanggan</a>
</div>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-4">
				<form method="get" class="d-flex">
					<input class="form-control me-2" type="text" name="search" placeholder="Cari Pelanggan" value="<?= $search ?>">
					<button class="btn btn-primary" type="submit">Cari</button>
					<?php if ($search): ?>
					<a href="<?= site_url('customers') ?>" class="btn btn-secondary ms-2">Reset</a>
					<?php endif; ?>
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table id="myTable" class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($customers): ?>
					<?php $no=1; foreach ($customers as $c): ?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $c->name ?></td>
						<td><?= $c->address ?></td>
						<td class="text-center"><?= $c->phone ?></td>
						<td class="text-center">
							<a href="<?= site_url('customers/edit/'.$c->id) ?>" class="btn btn-sm btn-primary">Edit</a>
							<a href="<?= site_url('customers/delete/'.$c->id) ?>" class="btn btn-sm btn-danger" data-confirm="Hapus pelanggan ini?">Hapus</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr><td colspan="5" class="text-center">Tidak ada pelanggan</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
