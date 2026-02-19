<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Token</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/select2/css/select2.min.css">
    <style>
    
  </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?= $this->include('admin/navbar') ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Token</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active">Token</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                                                <div class="col-sm-9">
                                                <input class="form-control" type="date" name="start_dttm"
                                                    id="start_dttm" value="<?= date("Y-m-d") ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <label style="padding-top:5px;">s/d</label>
                                        <div class="col-2">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                <input class="form-control" type="date" name="end_dttm" id="end_dttm"
                                                    value="<?= date("Y-m-d") ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 col-form-label">Materi :</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2bs4" name="materi_id" id="materi_id">
                                                        <option value="all">Semua</option>
                                                        <?php
                                                            foreach ($materi as $key) {
                                                        ?>
                                                        <option value="<?= $key->materi_id ?>"><?= $key->materi_nm ?></option>
                                                        <?php } ?>

                                                        <?php
                                                            for ($i = 1; $i <= count($materi); $i++) {
                                                        ?>
                                                            <option value="p_<?= $i ?>">Pembahasan <?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group row">
                                                <button class="btn btn-primary btn-sm" type="button"
                                                    onclick="tampilkantoken()">Tampilkan</button>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group row">
                                                <button class="btn btn-success btn-sm" type="button"
                                                    onclick="tambahtoken()"><i class="fa fa-plus"></i> Tambah Token</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table_token" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">No.</th>
                                                <th style="text-align:center;">Token</th>
                                                <th style="text-align:center;">Tanggal</th>
                                                <th style="text-align:center;">Materi</th>
                                                <th style="text-align:center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
            <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h4>Form Tambah Token</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="modal_body" class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="token">Token</label>
                                        <input class="form-control" type="text" name="token_tambah" id="token_tambah" maxlength="6" minlength="6">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="token">Materi</label><br>
                                        <select style="width: 100%;" class="form-control select2bs4 col-md-8" name="materi_id_tambah" id="materi_id_tambah">
                                            <option value="0">Pilih Materi</option>
                                            <?php
                                                foreach ($materi as $key) {
                                            ?>
                                            <option value="<?= $key->materi_id ?>"><?= $key->materi_nm ?></option>
                                            <?php } ?>
                                            <?php
                                                for ($i = 1; $i <= count($materi); $i++) {
                                            ?>
                                                <option value="p_<?= $i ?>">Pembahasan <?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_dttm">Tanggal Berlaku</label>
                                        <input class="form-control" type="date" name="start_dttm_tambah" id="start_dttm_tambah">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_dttm">Tanggal Expired</label>
                                        <input class="form-control" type="date" name="end_dttm_tambah" id="end_dttm_tambah">
                                    </div>
                                </div>
                            </div>
                            <div>
                            <div class="col-md-12 d-flex justify-content-end">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="button" onclick="simpantoken()">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h4>Form Edit Token</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="modal_body" class="modal-body">
                            <input type="hidden" id="token_id_edit" name="token_id_edit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="token">Token</label>
                                        <input class="form-control" type="text" name="token_edit" id="token_edit" maxlength="6" minlength="6">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="token">Materi</label>
                                        <select style="width: 100%;" class="form-control select2bs4" name="materi_id_edit" id="materi_id_edit">
                                            <option value="0">Pilih Materi</option>
                                            <?php
                                                foreach ($materi as $key) {
                                            ?>
                                            <option value="<?= $key->materi_id ?>"><?= $key->materi_nm ?></option>
                                            <?php } ?>

                                            <?php
                                                for ($i = 1; $i <= count($materi); $i++) {
                                            ?>
                                                <option value="p_<?= $i ?>">Pembahasan <?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_dttm">Tanggal Awal</label>
                                        <input class="form-control" type="date" name="start_dttm_edit" id="start_dttm_edit" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_dttm">Tanggal Akhir</label>
                                        <input class="form-control" type="date" name="end_dttm_edit" id="end_dttm_edit">
                                    </div>
                                </div>
                            </div>
                            <div>
                            <div class="col-md-12 d-flex justify-content-center">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="button" onclick="updatetoken()">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none" id='loader-wrapper'>
                <div class="loader"></div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- Page specific script -->
    <script>
    $(document).ready(function(){
        loadDataToken();
    });

    $(function() {
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
    });

    function tambahtoken() {
        $("#modal-tambah").modal("show");
        document.getElementById('start_dttm_tambah').value = new Date().toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' }).split('/').reverse().join('-');
        document.getElementById('end_dttm_tambah').value = new Date().toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' }).split('/').reverse().join('-');

    }

    function clearFormTambah() {
        $("#token_tambah").val("")
        $("#start_dttm_tambah").val("")
        $("#end_dttm_tambah").val("")
        $("#materi_id_tambah").val("")
    }

    function simpantoken() {
      var token = $("#token_tambah").val()
      var start_dttm = $("#start_dttm_tambah").val()
      var end_dttm = $("#end_dttm_tambah").val()
      var materi_id = $("#materi_id_tambah").val()
      if (start_dttm == "") {
        alert("Tanggal berlaku token belum di tentukan");
        return;
      }
      if (end_dttm == "") {
        alert("Tanggal expired token belum di tentukan");
        return;
      }
      if (token == "") {
        Swal.fire("Token belum di entri", "", "warning");
        return;
      }
      if (materi_id == 0) {
        Swal.fire("Materi belum dipilih", "", "warning");
        return;
      }
      $.ajax({
        url: "<?= base_url('admin/token/simpantoken') ?>",
        type: "post",
        dataType: "json",
        data: {
          "token": token,
          "start_date": start_dttm,
          "end_date": end_dttm,
          "materi_id": materi_id
        },
        beforeSend: function() {
            $("#loader-wrapper").removeClass("d-none");
        },
        success: function(data) {
          if (data == "sukses") {
              Swal.fire("Token berhasil disimpan", "", "success");
          } else {
              Swal.fire("Token gagal disimpan", "", "error");
          }
          $("#loader-wrapper").addClass("d-none");
          $("#modal-tambah").modal("hide");
          loadDataToken();
        },
        error: function() {
          alert("Error");
          $("#loader-wrapper").addClass("d-none");
        }
      });
    }

    function edit(edit) {
        const [token_id, start_date, end_date, token,materi_id] = $(
                    edit).attr("value")
                .split("|")
        $("#modal-edit").modal("show");
        $("#token_id_edit").val(token_id);
        $("#start_dttm_edit").val(start_date);
        $("#end_dttm_edit").val(end_date);
        $("#token_edit").val(token);
        $("#materi_id_edit").val(materi_id);
    }

    function updatetoken() {
        let token_id = $("#token_id_edit").val();
        let start_date = $("#start_dttm_edit").val();
        let end_date = $("#end_dttm_edit").val();
        let token = $("#token_edit").val();
        let materi_id = $("#materi_id_edit").val();
        if (start_dttm == "") {
            alert("Tanggal berlaku token belum di tentukan");
            return;
        }
        if (end_dttm == "") {
            alert("Tanggal expired token belum di tentukan");
            return;
        }
        if (token == "") {
            alert("Token belum di entri");
            return;
        }
        if (materi_id == 0) {
            alert("Materi belum dipilih");
            return;
        }
        $.ajax({
            url: "<?= base_url('admin/token/updatetoken') ?>",
            type: "post",
            dataType: "json",
            data: {
                "token": token,
                "start_date": start_date,
                "end_date": end_date,
                "token_id": token_id,
                "materi_id": materi_id
            },
            beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none");
            },
            success: function(data) {
                if (data == "sukses") {
                    Swal.fire("Token berhasil disimpan", "", "success");
                } else {
                    alert("Token gagal disimpan");
                }
                $("#loader-wrapper").addClass("d-none");
                $("#modal-tambah").modal("hide");
                loadDataToken();
            },
            error: function() {
                alert("Error");
                $("#loader-wrapper").addClass("d-none");
            }
        });
    }

    function hapus(token_id) {
        let text = "Apakah anda yakin menghapus data ini ?";
        if (confirm(text) == true) {
            $.ajax({
                url: "<?= base_url('admin/token/hapustoken') ?>",
                type: "post",
                dataType: "json",
                data: {
                    "token_id": token_id
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none")
                },
                success: function(data) {
                    if (data == "sukses") {
                        Swal.fire("Hapus token berhasil", "", "success");
                    } else {
                        alert("hapus token gagal");
                    }
                    $("#loader-wrapper").addClass("d-none");
                    loadDataToken();
                },
                error: function() {
                    alert("error");
                    $("#loader-wrapper").addClass("d-none");
                }
            });
        }
    }
    function tampilkantoken() {
        loadDataToken();
    }

    loadDataToken = () => {
        var start_date = $("#start_dttm").val();
        var end_date = $("#end_dttm").val();
        var materi_id = $("#materi_id").val();
        
            $("#table_token").DataTable({
                ajax: {
                    url: "/admin/token/loadDataToken",
                    type: "POST",
                    data: function(d) {
                        d.start_date = start_date,
                        d.end_date = end_date,
                        d.materi_id = materi_id
                    },
                    dataSrc: function(json) {
                        let nomor = 1
                        json.forEach((row, idx) => {
                            if (idx > 0) {
                                nomor++
                            }
                            row.nomor = nomor
                        });

                        return json
                    }
                },
                bDestroy: true,
                pageLength: 20,
                columns: [{
                        data: "nomor",
                        className: "text-center",
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css("vertical-align", "center")
                        }
                    },
                    {
                        data: "token",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return `${data.start_date} s/d ${data.end_date}`;
                        }
                    },
                    {
                        data: "materi_nm",
                        className: "text-center"
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data) {
                            return `<button
                                                        onclick="edit(this)"
                                                        value="${data.token_id}|${data.start_date}|${data.end_date}|${data.token}|${data.materi_id}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                                        <button
                                                        onclick="hapus(${data.token_id})"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>`;
                        }
                    }
                ]
            })
        }
    </script>
</body>

</html>