<?= $this->extend('Layout/template'); ?>
<!-- membuat layout conten harus sama dengan section pada template -->
<?= $this->section('content'); ?>

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="card border-success">
                        <div class="card-header bg-success">
                            <h4 class="card-title" style="color:black;">Data Pemasukan</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="icon-minus4" style="color:black;"></i></a></li>
                                    <li><a data-action="reload"><i class="icon-reload" style="color:black;"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2" style="color:black;"></i></a></li>
                                    <li><a data-action="close"><i class="icon-cross2" style="color:black;"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="table-responsive card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-md-center">
                                        <div class="form-group">
                                            <!-- Single Button Dropdown -->
                                            <div class="btn-group mb-0.1 mr-0.1 " style="float:right;">
                                                <form action="" method="post">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <fieldset class="form-group position-relative">
                                                            <input type="text" class="form-control" placeholder="Masukan " name="cari">
                                                            <div class="form-control-position " style="margin-right: 9px;">
                                                                <button class="btn btn-outline-primary btn-info mb-2 mr-4 mb-0.1 " type="submit" name="submit"><i class="icon-ios-search"></i></button>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- Single Button Dropdown -->
                                            <div class="btn-group mb-0.1 ml-0.1 " style="float:lefth; margin-top:-15px;">
                                                <a href="/c_pemasukan/create" class="btn btn-info btn-outline-primary mb-0.1 ">Tambah Data</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered mb-0 ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Rincian</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 + (6 * ($currentPage - 1)); ?>
                                        <?php foreach ($komik as $k) : ?>
                                            <tr>
                                                <td scope="row"><?= $no++; ?></td>
                                                <td><?= $k['rincian_transaksi']; ?></td>
                                                <td><?= "Rp " . number_format($k['jumlah'], 0, ',', '.'); ?></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="#del<?= $k['id_transaksi']; ?>" class="btn btn-danger" data-toggle="modal">
                                                        Hapus
                                                    </a>
                                                    <a href="/c_pemasukan/edit/<?= $k['id_transaksi']; ?>" class=" btn btn-warning">Edit</a>
                                                    <a href="/c_pemasukan/<?= $k['id_transaksi']; ?>" class=" btn btn-primary">Lihat</a>
                                                    <!-- Modal -->
                                                    <div class="modal fade bd-example-modal-sm" id="del<?= $k['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                                </div>
                                                                <div class="modal-body" style="text-align: center;">
                                                                    Apakah Anda ingin Menghapus Data <b><?= $k['id_transaksi']; ?></b>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                                    <form action="/c_pemasukan/delete/<?= $k['id_transaksi']; ?>" method="POST" class="d-inline">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELET">
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- membuat pagination -->
                                <?= $pager->links('komik', 'komik_pagination'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bordered table end -->
<?= $this->endSection(); ?>