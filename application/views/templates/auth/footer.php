					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="<?= base_url('assets/js/app.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
	<?php if ($this->session->flashdata('error')): ?>
	Swal.fire({icon:'error',title:'Gagal!',text:'<?= addslashes($this->session->flashdata('error')) ?>',timer:3000,showConfirmButton:false});
	<?php endif; ?>
	</script>
	<script src="<?= base_url('assets/js/auth.js') ?>"></script>

	</body>
</html>
