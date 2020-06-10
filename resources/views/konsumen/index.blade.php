<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        var tbl;
        $(document).ready(function() {
            tbl = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo url('konsumen/dataSource') ?>'
            });
            $('#konsumen-save').on('click', function (e) {
                e.preventDefault();
                var data = $('#frm-konsumen-add').serializeArray();
                $.ajax({
                    url: '<?php echo url("konsumen/insert") ?>',
                    type: "POST",
                    data: data,
                    success: function (result) {
                        alert(result);
                        $('#konsumen-modal-add').modal('hide');
                        tbl.ajax.reload();
                    }
                });
            })
            $('#konsumen-edit').on('click', function (e) {
                e.preventDefault();
                var data = $('#frm-konsumen-edit').serializeArray();
                data.push({name: 'id', value: localStorage.getItem('id_konsumen')});
                $.ajax({
                    url: '<?php echo url("konsumen/update") ?>',
                    type: "POST",
                    data: data,
                    success: function (result) {
                        alert(result);
                        $('#konsumen-modal-edit').modal('hide');
                        tbl.ajax.reload();
                    }
                });
            })
        } );
        function ubahKonsumen(id) {
            $.ajax({
                url: '<?php echo url("konsumen/get_konsumen_id") ?>/' + id,
                dataType: 'json',
                success: function (result) {
                    if (result.status == 0) {
                        alert(result.data[0]);
                    } else {
                        $('#konsumen-modal-edit').modal('toggle');
                        var data = result.data;
                        localStorage.setItem('id_konsumen', data.id);
                        $("#frm-konsumen-edit #nm_konsumen").val(data.nm_konsumen);
                        $("#frm-konsumen-edit #jns_kendaraan").val(data.jns_kendaraan);
                        $("#frm-konsumen-edit #nopol").val(data.nopol);
                        $("#frm-konsumen-edit #tgl_lahir").val(data.tgl_lahir);
                        if (data.jns_kelamin == 'L') {
                            $("#frm-konsumen-edit #jns_kelamin1").attr('checked','checked');
                        } else {
                            $("#frm-konsumen-edit #jns_kelamin2").attr('checked','checked');
                        }
                        $("#frm-konsumen-edit #no_hp").val(data.no_hp);
                    }
                }
            });
        }
    </script>
</head>
<body>
<div class="col-md-12">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#konsumen-modal-add" title="add new">
        <span class="fa fa-plus"></span>
    </button>
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Konsumen</th>
        <th>Jenis Kendaraan</th>
        <th>No. Polisi</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>No Hp</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th>Konsumen</th>
        <th>Jenis Kendaraan</th>
        <th>No. Polisi</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>No Hp</th>
        <th></th>
    </tr>
    </tfoot>
</table>
<div class="modal" id="konsumen-modal-add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Konsumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm-konsumen-add" id="frm-konsumen-add">
                    <div class="form-group row">
                        <label class="col-md-3">Nama Konsumen</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nm_konsumen" id="nm_konsumen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Jenis Kendaraan</label>
                        <div class="col-md-12">
                            <select class="form-control" name="jns_kendaraan" id="jns_kendaraan">
                                <option value="0" disabled></option>
                                <option value="Mobil">Mobil</option>
                                <option value="Motor">Motor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Nomor Polisi</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nopol" id="nopol">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Tanggal Lahir</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Jenis Kelamin</label>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jns_kelamin" id="jns_kelamin1" value="L">
                            <label class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jns_kelamin" id="jns_kelamin2" value="P">
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Nomor Handphone</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="no_hp" id="no_hp">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="konsumen-save"><span class="fa fa-save"></span></a>
                <a class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span></a>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="konsumen-modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Konsumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm-konsumen-edit" id="frm-konsumen-edit">
                    <div class="form-group row">
                        <label class="col-md-3">Nama Konsumen</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nm_konsumen" id="nm_konsumen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Jenis Kendaraan</label>
                        <div class="col-md-12">
                            <select class="form-control" name="jns_kendaraan" id="jns_kendaraan">
                                <option value="0" disabled></option>
                                <option value="Mobil">Mobil</option>
                                <option value="Motor">Motor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Nomor Polisi</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nopol" id="nopol">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Tanggal Lahir</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Jenis Kelamin</label>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jns_kelamin" id="jns_kelamin1" value="L">
                            <label class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jns_kelamin" id="jns_kelamin2" value="P">
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Nomor Handphone</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="no_hp" id="no_hp">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="konsumen-edit"><span class="fa fa-save"></span></a>
                <a class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
