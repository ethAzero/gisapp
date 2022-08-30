<link rel="icon" href="<?php echo base_url() ?>assets/admin/icon.png" sizes="32x32">
<link href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/admin/plugins/select2/select2.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />


<label for="exampleInputEmail1">Tipe Rambu</label>
<select name="jenis" id="jenis" class="form-control select2" required onchange="getTipe(this.value)">
    <option value="">~~Kode Klasifikasi~~</option>
    <?php
    foreach ($klasifikasi as $row) {
    ?>
        <option value="<?php echo $row->id_tabel; ?>"><?php echo $row->nm_perjal; ?></option>
    <?php
    };
    ?>
</select>






<select name="tipe1" id="tipe1" class="form-control select2" required>
    <option value="">~~Tipe Rambu1~~</option>
</select>

<select name="tipe" id="tipe" class="form-control select2" required>
    <option value="">~~Tipe Rambu~~</option>
    <?php
    foreach ($tipe as $row) {
    ?>
        <option value="<?php echo $row->id_rambu; ?>" data-image="<?= base_url('assets/upload/img_rambu/' . $row->img_tipe) ?>"><?php echo $row->desk_tipe; ?></option>
    <?php
    };
    ?>
</select>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/growl/jquery.growl.js"></script>
<link href="<?php echo base_url() ?>assets/admin/plugins/growl/jquery.growl.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/admin/plugins/jquery-validation/dist/jquery.validate.min.js"></script>

<script>
    let klasifikasiVal = () => $('#jenis').val();
    // mengambil data Program 
    function getTipe(val) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('tipe') ?>",
            data: {
                klasifikasiVal: val
            },
            dataType: "json",
            beforeSend: function() {
                $("#tipe1").html("");
            },
            error: function() {
                $('#tipe1').append($('<option>').val("").text(" ~~~ Data Tidak Ditemukan ~~~"));
            },
            success: function(data) {
                let options = document.getElementById('tipe1');
                $('option', options).remove();
                iconpath = '<?= base_url("assets/upload/img_rambu/") ?>';
                for (let i = 0; i < data.length; i++) {
                    // options[options.length] = new Option(data[i].desk_tipe, data[i].id_rambu, data[i].img_tipe);
                    $('#tipe1').append($('<option>').val(data[i].id_rambu).text(data[i].desk_tipe).attr('data-image', iconpath + data[i].img_tipe));
                    // $('<option>').val(data[i].id_rambu).text(data[i].desk_tipe).attr('data-image', iconpath + data[i].img_tipe).appendTo('#tipe1');
                }

                console.log(options);
            }
        })
    }

    $("#tipe1").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    function formatState(opt) {
        if (!opt.id) {
            return opt.text;
        }

        var optimage = $(opt.element).attr('data-image');
        // console.log(optimage)
        if (!optimage) {
            return opt.text.toUpperCase();
        } else {
            var $opt = $(
                '<span><img src="' + optimage + '" width="30px" height="30px" /> ' + opt.text + '</span>'
            );
            return $opt;
        }
    };
</script>