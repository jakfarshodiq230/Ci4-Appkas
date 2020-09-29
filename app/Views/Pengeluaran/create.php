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
                        <form class="form" action="/c_pengeluaran/save" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="id_transaksi">ID Transaksi</label>
                                    <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $kode_otomatis; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="userinput2">Rincian</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('rincian_transaksi')) ? 'is-invalid' : ''; ?>" id="rincian_transaksi" name="rincian_transaksi" autofocus value="<?= old('rincian_transaksi'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('rincian_transaksi'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userinput3">Jumlah</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('jumlah'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Harga</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('harga'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kuitansi" class="col-sm-2 col-form-label">Kuitansi</label>
                                    <div class="col-sm-6">
                                        <img src="/app-assets/images/user.jpg" class="img-thumbnail img-preview" style="position: relative; height:200px;">
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="custom-file">
                                            <label class="file center-block" for="kuitansi">
                                                <input type="file" class="custom-file-input <?= ($validation->hasError('kuitansi')) ? 'is-invalid' : ''; ?> " id="kuitansi" name="kuitansi" onchange="previewImg()">
                                                <label class="custom-file-label btn btn-secondary btn-min-width" style="margin-top: -10%; margin-left:-5%" for="kuitansi">Choose file</label>
                                            </label>

                                            <div class="invalid-tooltip" style="color:red;">
                                                <?= $validation->getError('kuitansi'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions right">
                                <a href="/c_pengeluaran" class="btn btn-warning"><i class="icon-cross2"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check2"></i> Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>