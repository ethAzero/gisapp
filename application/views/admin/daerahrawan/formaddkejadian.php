<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<a href="#" data-toggle="modal" data-target="#addkejadian"><button class="btn btn-md btn-flat btn-success" data-toggle="tooltip" data-placement="top" title="Tambah Kejadian"><i class="fa fa-plus"></i> Add</button></a>
<div id="addkejadian" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Kejadian</h4>
            </div>
            <div class="modal-body">
                <?php
                echo form_open(base_url('admin/daerahrawan/kejadianadd/') . $listdrk->kd_daerah);
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Tahun</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Jumlah Kejadian</th>
                                <th colspan="4" style="vertical-align:middle; text-align:center;">Korban</th>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle; text-align:center;">MD</th>
                                <th style="vertical-align:middle; text-align:center;">LB</th>
                                <th style="vertical-align:middle; text-align:center;">LR</th>
                                <th style="vertical-align:middle; text-align:center;">Materil</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="tahun" class="form-control" required></td>
                                <td><input type="text" name="jmlkejadian" class="form-control" required></td>
                                <td><input type="text" name="md" class="form-control" required></td>
                                <td><input type="text" name="lb" class="form-control" required></td>
                                <td><input type="text" name="lr" class="form-control" required></td>
                                <td><input type="text" name="materil" class="form-control" required></td>
                            </tr>
                        </table>
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