<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">
	<link href="<?= base_url('assets/css/base.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/table.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/components.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/sidebar.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/datatables.css') ?>" rel="stylesheet">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sales Order System - PT Maju Jaya">
	<meta name="author" content="PT Maju Jaya">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<title><?= isset($title) ? $title . ' - ' : '' ?>Sales Order - PT Maju Jaya</title>
	<link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?= site_url('dashboard') ?>">
					<div class="company-brand">
						<h3>PT MAJU JAYA</h3>
					</div>
				</a>

				<ul class="sidebar-nav">
					<hr class="sidebar-divider d-none d-md-block">
					<li class="sidebar-header">Menu Utama</li>

					<li class="sidebar-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
						<a class="sidebar-link" href="<?= site_url('dashboard') ?>">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<?php if ($this->session->userdata('role') == 'admin'): ?>
					<li class="sidebar-item <?= $this->uri->segment(1) == 'products' ? 'active' : '' ?>">
						<a class="sidebar-link" href="<?= site_url('products') ?>">
							<i class="align-middle" data-feather="box"></i> <span class="align-middle">Produk</span>
						</a>
					</li>

					<li class="sidebar-item <?= $this->uri->segment(1) == 'customers' ? 'active' : '' ?>">
						<a class="sidebar-link" href="<?= site_url('customers') ?>">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Pelanggan</span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'manager'): ?>
					<li class="sidebar-item <?= $this->uri->segment(1) == 'users' ? 'active' : '' ?>">
						<a class="sidebar-link" href="<?= site_url('users') ?>">
							<i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Data Sales</span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'sales'): ?>
					<li class="sidebar-item <?= $this->uri->segment(1) == 'sales_orders' ? 'active' : '' ?>">
						<a class="sidebar-link" href="<?= site_url('sales_orders') ?>">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Sales Order</span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'manager'): ?>
					<hr class="sidebar-divider d-none d-md-block">
					<li class="sidebar-header">LapForan</li>

					<li class="sidebar-item <?= $this->uri->segment(1) == 'reports' ? 'active' : '' ?>">
						<a class="sidebar-link" href="<?= site_url('reports') ?>">
							<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Laporan</span>
						</a>
					</li>
					<?php endif; ?>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-flex align-items-center" href="#" data-bs-toggle="dropdown">

								<i data-feather="user" class="me-2"></i>

								<div class="user-info">
									<div class="user-name">
										<?= $this->session->userdata('full_name') ?>
									</div>

									<div class="user-role">
										<?= ucfirst($this->session->userdata('role')) ?>
									</div>
								</div>

							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					
	
