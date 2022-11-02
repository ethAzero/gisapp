<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<a href="#" data-toggle="modal" data-target="#addkejadian<?php echo $listkejadian->id_kejadian ?>"><button class="btn btn-md btn-flat btn-success" data-toggle="tooltip" data-placement="top" title="Tangani"><i class="fa fa-plus"></i> Add</button></a>
<div id="addkejadian<?php echo $listkejadian->id_kejadian ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Kejadian</h4>
            </div>
            <div class="modal-body">
                <?php
                echo form_open(base_url('admin/daerahrawan/tanganirekom/') . $listdrk->kd_daerah . '/' . $listrekom->id, array('onsubmit' => 'return ValidasiKoordinat()'));
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Nama Daerah Rawan</label>
                                        <input type="text" name="nmdaerah" class="form-control" placeholder="Nama Daerah">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Nama Kabupaten / Kota</label>
                                        <select name="kabkota" class="select2 form-control">
                                            <option value="">=== Nama Kabupaten / Kota ===</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Nama Kabupaten / Kota</label>
                                        <select name="kabkota" class="select2 form-control">
                                            <option value="">=== Nama Kabupaten / Kota ===</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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