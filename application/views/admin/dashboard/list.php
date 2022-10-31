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
		<?php
		$hakakses = $this->session->userdata('hakakses');
		if ($hakakses != 'AJ' and $hakakses != 'JT' and $hakakses != 'LL' and $hakakses != 'PE' and $hakakses != '07') { ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<div class="col-md-6">
								<label>Filter By : Tahun </label>
								<select name="tahun" id="tahun" class="form-control select2" style="width: 100%;" onchange="getDataFilter(this.value,bidangbalaiVal())">
									<?php foreach ($listtahun as $listtahun) : ?>
										<?php date_default_timezone_set("Asia/Bangkok");
										if ($listtahun->Tahun == date("Y")) { ?>
											<option value="<?php echo $listtahun->Tahun ?>" selected><?php echo $listtahun->Tahun ?></option>
										<?php } else { ?>
											<option value="<?php echo $listtahun->Tahun ?>"><?php echo $listtahun->Tahun ?></option>
										<?php } ?>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-6">
								<label>Filter By : Balai </label>
								<?php
								$hakakses = $this->session->userdata('hakakses');
								if ($hakakses == '01' || $hakakses == '02' || $hakakses == '03' || $hakakses == '04' || $hakakses == '05' || $hakakses == '06') {
									$lock = 'disabled';
								?>
									<select name="bidangbalai" id="bidangbalai" class="form-control select2" style="width: 100%;" onchange="getDataFilter(tahunVal(),this.value)" <?= $lock; ?>>
										<option value="all">Dinas Perhubungan</option>
										<?php foreach ($listbidangbalai as $key => $bidangbalai) : ?>
											<option value="<?php echo $bidangbalai->kd_balai ?>" <?php if ($bidangbalai->kd_balai === $hakakses) {
																										echo "selected";
																									} ?>><?php echo $bidangbalai->nm_balai ?></option>
										<?php endforeach ?>
									</select>
								<?php } else if ($hakakses == 'S' || $hakakses == 'A' || $hakakses == 'AD') { ?>
									<select name="bidangbalai" id="bidangbalai" class="form-control select2" style="width: 100%;" onchange="getDataFilter(tahunVal(),this.value)">
										<option value="all" selected>Dinas Perhubungan</option>
										<?php foreach ($listbidangbalai as $key => $bidangbalai) : ?>
											<option value="<?php echo $bidangbalai->kd_balai ?>"><?php echo $bidangbalai->nm_balai ?></option>
										<?php endforeach ?>
									</select>
								<?php }
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php
		$hakakses = $this->session->userdata('hakakses');
		if ($hakakses != 'AJ' and $hakakses != 'JT' and $hakakses != 'LL' and $hakakses != 'PE' and $hakakses != '07') { ?>
			<div id='loader1'></div>
			<div class="row" id="aduanbychanel">
			</div>
			<div class="row">
				<section class="col-lg-8 connectedSortable">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class="pull-left header"><i class="fa fa-inbox"></i> Rekapan Aduan Bulanan</li>
						</ul>
						<div id='loader2'></div>
						<div id="tidakada"></div>
						<div class="tab-content" id="chartContainer">
							<canvas id="chartMonthly" height="300px"></canvas>
						</div>

					</div>
				</section>
				<section class="col-lg-4 connectedSortable">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class="pull-left header"><i class="fa fa-inbox"></i> Rekapan Aduan Tahunan</li>
						</ul>
						<div class="tab-content">
							<canvas id="chartPie" height="300px"></canvas>
						</div>
					</div>
				</section>
			</div>
		<?php } ?>
		<div class="row">
			<?php if (($this->session->userdata('hakakses') == 'S') or ($this->session->userdata('hakakses') == 'A') or ($this->session->userdata('hakakses') == 'LL')) { ?>
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Ruas Jalan Provinsi se Jawa Tengah</h3>
							<div class="box-tools pull-right">
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