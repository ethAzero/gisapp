<div class="content-wrapper">
	<section class="content-header">
		<h1>Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<?php
			$hakakses = $this->session->userdata('hakakses');
			if ($hakakses != 'AJ' and $hakakses != 'JT' and $hakakses != 'LL' and $hakakses != 'PE' and $hakakses != '07') { ?>
				<?php foreach ($jmlAduanByChannel as $key => $jmlAduanByChannel) : ?>
					<?php
					if ($jmlAduanByChannel->id_chanel_aduan == 1) {
						$fa = "fa-warning";
						$bgcolor = "bg-yellow";
					} else if ($jmlAduanByChannel->id_chanel_aduan == 2) {
						$fa = "fa-instagram";
						$bgcolor = "bg-red";
					} else if ($jmlAduanByChannel->id_chanel_aduan == 3) {
						$fa = "fa-whatsapp";
						$bgcolor = "bg-green";
					} else {
						$fa = "fa-twitter";
						$bgcolor = "bg-blue";
					};
					?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon <?= $bgcolor; ?>"><i class="fa fa-brand <?= $fa; ?>"></i></span>
							<div class="info-box-content">
								<span class="info-box-text"><?= $jmlAduanByChannel->chanel_aduan; ?></span>
								<span class="info-box-number"><?= $jmlAduanByChannel->jml_aduan; ?><small> Aduan</small></span>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php } ?>
		</div>
		<div class="row">
			<?php if (($this->session->userdata('hakakses') == 'S') or ($this->session->userdata('hakakses') == 'A') or ($this->session->userdata('hakakses') == 'LL')) { ?>
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Ruas Jalan Provinsi se Jawa Tengah</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<div class="btn-group">
									<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-wrench"></i></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
							<br></br>
							<div class="row">
								<?php foreach ($list as $key => $list) : ?>
									<a href="<?php echo base_url('admin/progress/' . $list->kd_balai); ?>">
										<div class="col-md-3 col-sm-6 col-xs-12">
											<div class="info-box bg-blue">
												<span class="info-box-icon"><i class="fa fa-building"></i></span>
												<div class="info-box-content">
													<span class="info-box-text">&nbsp;</span>
													<span class="info-box-number"><?php echo balai($list->nm_balai); ?></span>
													<div class="progress">
														<div class="progress-bar" style="width: 100%"></div>
													</div>
													<span class="progress-description small">
														<?php $jml = $this->dashboard_model->jmlruasperbalai($list->kd_balai); ?>
														<?php echo $jml->jumlah ?> Ruas Jalan (<?php echo angka($jml->panjang) ?> m)
													</span>
												</div>
											</div>
										</div>
									</a>
								<?php endforeach ?>
							<?php } ?>
							</div>
						</div>
					</div>
				</div>
		</div>
	</section>
</div>