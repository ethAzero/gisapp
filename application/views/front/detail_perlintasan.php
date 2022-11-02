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
				<h3>Data Fasilitas Keselamatan</h3>
				<table class="table	datatable">
					<thead>
						<tr>
							<th style="width:8%;">No</th>
							<th>Jenis Fasilitas</th>
							<th style="width:30%;">Jumlah</th>
						</tr>
						<tr>
							<td>1</th>
							<td>Palang Pintu</th>
							<td><?= $list->palang_pintu ?></th>
						</tr>
						<tr>
							<td>2</th>
							<td>Andreas Cross</th>
							<td><?= $list->andreas_cross ?></th>
						</tr>
						<tr>
							<td>3</th>
							<td>Rambu Berhenti</th>
							<td><?= $list->rambu_stop ?></th>
						</tr>
						<tr>
							<td>4</th>
							<td>Rambu Peringatan</th>
							<td><?= $list->rambu_peringatan + $list->rambu_peringatan1 + $list->rambu_peringatan2 ?></th>
						</tr>
						<tr>
							<td>5</th>
							<td>Warning Light</th>
							<td><?= $list->wl_running_text ?></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		<?php } ?>
		<dvi class="col-md-12 header-wrapper card">

	</div>
</div>
<br>
<br>
</div>