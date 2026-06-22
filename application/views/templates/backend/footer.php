				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">&copy; <?= date('Y') ?> PT Maju Jaya</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">Sales Order System</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="<?= base_url('assets/js/app.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
	<script>
	<?php if ($this->session->flashdata('success')): ?>
	Swal.fire({icon:'success',title:'Berhasil!',text:'<?= addslashes($this->session->flashdata('success')) ?>',timer:3000,showConfirmButton:false});
	<?php endif; ?>
	<?php if ($this->session->flashdata('error')): ?>
	Swal.fire({icon:'error',title:'Gagal!',text:'<?= addslashes($this->session->flashdata('error')) ?>',timer:3000,showConfirmButton:false});
	<?php endif; ?>
	document.querySelectorAll('[data-confirm]').forEach(function(el) {
		el.addEventListener('click', function(e) {
			e.preventDefault();
			var url = this.getAttribute('href');
			Swal.fire({title:'Konfirmasi',text:this.getAttribute('data-confirm'),icon:'warning',showCancelButton:true,confirmButtonColor:'#d33',cancelButtonColor:'#6c757d',confirmButtonText:'Ya, hapus!',cancelButtonText:'Batal'}).then(function(result) {
				if (result.isConfirmed) window.location.href = url;
			});
		});
	});
	</script>
	
	<?php if (isset($page_scripts)): ?>
	<?= $page_scripts ?>
	<?php endif; ?>

	<script src="<?= base_url('assets/js/users.js') ?>"></script>
	<script src="<?= base_url('assets/js/sales_order.js') ?>"></script>

</body>
</html>
