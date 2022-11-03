<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="page-wrapper">
	<div class="row">
		<p></p>
		<p></p>
		<?php if ($list != '') { ?>
			<div class="col-md-6">
				<h1 class="page-header">Detail <?= $list->nm_perlintasan ?></h1>
				<br>
				<img src="<?php if ($list->img_perlintasan != null) {
								echo base_url('assets/upload/perlintasan/thumbs/' . $list->img_perlintasan);
							} else {
								echo base_url('assets/theme/img/map-marker-logo.jpg');
							} ?>" style="width:100%;">
			</div>
			<div class="col-md-6">
				<h3>Keterangan:</h3>
				<p class="page-subtitle">Lebar Jalan : <?= $list->lebar_jalan ?> m</p>
				<p class="page-subtitle">Jenis Perkerasan : <?= $list->perkerasan ?></p>
				<h3>Keterangan</h3>
				<div class="page-subtitle">
					<?= $list->ket ?>
				</div>
			</div>
		<?php } ?>
		<dvi class="col-md-12 header-wrapper card">

	</div>
</div>
<br>
<br>
</div>