<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<a href="#" data-toggle="modal" data-target="#hapus<?php echo $listrekom->id ?>"><button class="btn btn-xs btn-flat btn-success" data-toggle="tooltip" data-placement="top" title="Tangani"><i class="fa fa-check"></i></button></a>
<div id="hapus<?php echo $listrekom->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body" style="background:#46b8da;color:#fff">
                <?php
                echo form_open(base_url('admin/daerahrawan/tanganirekom/') . $listdrk->kd_daerah . '/' . $listrekom->id, array('onsubmit' => 'return ValidasiKoordinat()'));
                ?>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Volume Terpasang</label>
                        <input type="text" class="form-control pull-right" name="terpasang" required>
                    </div>
                    <div class="form-group col-md-7">Data Jumlah Unit Rekomendasi Terpasang </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>