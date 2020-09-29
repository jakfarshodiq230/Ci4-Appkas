<!-- membuat layout conten harus sama dengan section pada template -->
<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">Data Tranaksi</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form class="form" action="/c_pengguna/update/<?= $komik['id_user']; ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_user" value="<?= $komik['id_user']; ?>">
                            <input type="hidden" name="file_nama_lama" value="<?= $komik['foto']; ?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="userinput2">Nama</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $komik['nama_pengguna']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" id="provinsi">
                                        <option value=""> Pilih Provinsi</option>
                                        <?php foreach ($wilayah_provinsi->getResult() as $wp) : ?>
                                            <?php if ($komik['kd_provinsi'] == $wp->id) { ?>
                                                <option value="<?= $wp->id; ?>" selected><?= $wp->nama; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $wp->id; ?>"><?= $wp->nama; ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('provinsi'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Kabupaten</label>
                                    <select class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" name="kabupaten" id="kabupaten">
                                        <option value="">Pilih</option>
                                        <?php foreach ($wilayah_kabupaten->getResult() as $kb) : ?>
                                            <?php if ($komik['kd_kabupaten'] == $kb->id) { ?>
                                                <option value="<?= $kb->id; ?>" selected><?= $kb->nama; ?></option>
                                            <?php } elseif ($komik['kd_provinsi'] == $kb->provinsi_id) { ?>
                                                <option value="<?= $kb->id; ?>"><?= $kb->nama; ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('kabupaten'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" name="kecamatan" id="kecamatan">
                                        <option value="">Pilih</option>
                                        <?php foreach ($wilayah_kecamatan->getResult() as $kc) : ?>
                                            <?php if ($komik['kd_kecamatan'] == $kc->id) { ?>
                                                <option value="<?= $kc->id; ?>" selected><?= $kc->nama; ?></option>
                                            <?php } elseif ($komik['kd_kabupaten'] == $kc->kabupaten_id) { ?>
                                                <option value="<?= $kc->id; ?>"><?= $kc->nama; ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('kecamatan'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <select class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" name="kelurahan" id="kelurahan">
                                        <option value="">Pilih</option>
                                        <?php foreach ($wilayah_kelurahan->getResult() as $kl) : ?>
                                            <?php if ($kl->id == $komik['kd_desa']) { ?>
                                                <option value="<?= $kl->id; ?>" selected><?= $kl->nama; ?></option>
                                            <?php } elseif ($komik['kd_kecamatan'] == $kl->kecamatan_id) { ?>
                                                <option value="<?= $kl->id; ?>"><?= $kl->nama; ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('kelurahan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Username</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= $komik['username']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('username'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Password</label>
                                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= $komik['password']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="foto" class="col-sm-2 col-form-label">foto</label>
                                    <div class="col-sm-6">
                                        <img src="/img/<?= $komik['foto']; ?>" class="img-thumbnail img-preview" style="position: relative; height:200px;">
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="custom-file">
                                            <label class="file center-block" for="foto">
                                                <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?> " id="foto" name="foto" onchange="previewImg()">
                                                <label class="custom-file-label btn btn-secondary btn-min-width" style="margin-top: -10%; margin-left:-5%" for="foto">Choose file</label>
                                            </label>

                                            <div class="invalid-tooltip" style="color:red;">
                                                <?= $validation->getError('foto'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions right">
                                <a href="/c_pengguna" class="btn btn-warning"><i class="icon-undo"></i> Kembali</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
                                    Update
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit Data</h5>
                                        </div>
                                        <div class="modal-body" style="text-align: center;">
                                            Apakah Anda ingin Mengedit Data <b><?= $komik['id_user']; ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary">
                                                <i class="icon-download3"></i> Simpan</button>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>/c_pengguna/get_kabupaten",
                method: "POST",
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#kabupaten').html(html);

                }
            });
        });
        $('#kabupaten').change(function() {
            var id_kecamatan = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>/c_pengguna/get_kecamatan",
                method: "POST",
                data: {
                    id_kecamatan: id_kecamatan
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#kecamatan').html(html);

                }
            });
        });
        $('#kecamatan').change(function() {
            var id_kelurahan = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>/c_pengguna/get_kelurahan",
                method: "POST",
                data: {
                    id_kelurahan: id_kelurahan
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#kelurahan').html(html);

                }
            });
        });
    });
</script>
<?= $this->endSection('content'); ?>