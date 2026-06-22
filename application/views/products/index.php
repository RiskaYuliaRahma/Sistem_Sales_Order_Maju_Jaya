<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="page-title">Data Produk</h1><br>
	<a href="<?= site_url('products/create') ?>" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Tambah Produk</a>
</div>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-4">
				<form method="get" class="d-flex">
					<input class="form-control me-2" type="text" name="search" placeholder="Cari Produk" value="<?= $search ?>">
					<button class="btn btn-primary" type="submit">Cari</button>
					<?php if ($search): ?>
					<a href="<?= site_url('products') ?>" class="btn btn-secondary ms-2">Reset</a>
					<?php endif; ?>
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table id="myTable" class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($products): ?>
					<?php $no=1; foreach ($products as $p): ?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $p->code ?></td>
						<td><?= $p->name ?></td>
						<td class="text-end">Rp <?= number_format($p->price, 0, ',', '.') ?></td>
						<td class="text-center"><?= $p->stock ?></td>
						<td class="text-center">
							<a href="<?= site_url('products/edit/'.$p->id) ?>" class="btn btn-sm btn-primary">Edit</a>
							<a href="<?= site_url('products/delete/'.$p->id) ?>" 
							class="btn btn-sm btn-danger"
							onclick="return confirm('Hapus produk ini?')">
							Hapus
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr><td colspan="6" class="text-center">Tidak ada produk</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
