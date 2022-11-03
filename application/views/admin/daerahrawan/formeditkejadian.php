<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<a href="#" data-toggle="modal" data-target="#editkejadian<?= $listkejadian->id_kejadian ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Kejadian"><i class="fa fa-pencil"></i></button></a>
<div id="editkejadian<?= $listkejadian->id_kejadian ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Kejadian</h4>
            </div>
            <div class="modal-body">
                <?php
                echo form_open(base_url('admin/daerahrawan/kejadianedit/') . $listkejadian->kd_daerah . '/' . $listkejadian->id_kejadian);
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
                                <td><input type="text" name="tahun" class="form-control" required value="<?= $listkejadian->tahun ?>"></td>
                                <td><input type="text" name="jmlkejadian" class="form-control" required value="<?= $listkejadian->jml_kejadian ?>"></td>
                                <td><input type="text" name="md" class="form-control" required value="<?= $listkejadian->md ?>"></td>
                                <td><input type="text" name="lb" class="form-control" required value="<?= $listkejadian->lb ?>"></td>
                                <td><input type="text" name="lr" class="form-control" required value="<?= $listkejadian->lr ?>"></td>
                                <td><input type="text" name="materil" class="form-control" required value="<?= $listkejadian->materil ?>"></td>
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