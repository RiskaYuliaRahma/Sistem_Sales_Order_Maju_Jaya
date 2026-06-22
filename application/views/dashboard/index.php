<h1 class="page-title">Dashboard</h1><br>

<div class="row">
	<div class="col-xl-6 col-xxl-5 d-flex">
		<div class="w-100">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Total Orders</h5>
								</div>
								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="shopping-cart"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3"><?= $total_orders ?></h1>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Total Produk</h5>
								</div>
								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="box"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3"><?= $total_products ?></h1>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Revenue</h5>
								</div>
								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="credit-card"></i>
									</div>
								</div>
							</div>
							<h2 class="mt-1 mb-3">
								Rp <?= number_format($total_revenue, 0, ',', '.') ?>
							</h2>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Total Pelanggan</h5>
								</div>
								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="users"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3"><?= $total_customers ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-xxl-7">
		<div class="card flex-fill w-100">
			<div class="card-header">
				<h5 class="card-title mb-0">Recent Orders</h5>
			</div>
			<div class="card-body py-3">
				<div class="table-responsive">
				<table class="table table-hover align-middle">
					<thead class="table-light">
						<tr>
							<th>Order</th>
							<th>Pelanggan</th>
							<th>Sales</th>
							<th>Status</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($recent_orders): ?>
						<?php foreach ($recent_orders as $order): ?>
						<tr>
							<td class="text-center"><?= $order->order_number ?></td>
							<td><?= $order->customer_name ?></td>
							<td><?= $order->sales_name ?></td>
							<td class="text-center">
								<span class="badge bg-<?= $order->status == 'selesai' ? 'success' : ($order->status == 'dibatalkan' ? 'danger' : ($order->status == 'dikirim' ? 'info' : 'warning')) ?>">
									<?= ucfirst($order->status) ?>
								</span>
							</td>
							<td class="text-end fw-bold">
								Rp <?= number_format($order->total_amount, 0, ',', '.') ?>
							</td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">Belum ada order</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
