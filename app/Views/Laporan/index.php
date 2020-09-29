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
                    <div class="card border-success ">
                        <div class="card-header bg-success">
                            <h4 class="card-title" style="color:black;">Rekap Kas<h4>
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
                                            <div class="btn-group mb-0.1 ml-0.1 " style="float:lefth; margin-top:-15px;">
                                                <!-- <a href="/c_pengguna/create" class="btn btn-info btn-outline-primary mb-0.1 ">Buat Laporan</a> -->
                                                <a href="#del" class="btn btn-info btn-outline-primary mb-0.1 " data-toggle="modal">
                                                    Hapus
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade bd-example-modal-sm" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                            </div>
                                                            <div class="modal-body" style="text-align: center;">
                                                                Apakah Anda ingin Menghapus Data
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                                <form action="/c_pengeluaran/delete/" method="POST" class="d-inline">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="_method" value="DELET">
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <td rowspan="2">No</td>
                                            <td colspan="3">Rincian</td>
                                            <td rowspan="2">Pemasukan</td>
                                            <td rowspan="2">Pengeluaran</td>
                                            <td rowspan="2">Tanggal</td>
                                            <td rowspan="2">Keterangan</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Jumlah</td>
                                            <td>Harga</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 + (10 * ($currentPage - 1)); ?>
                                        <?php foreach ($rekap as $k) : ?>
                                            <tr>
                                                <td scope="row"><?= $no++; ?></td>
                                                <td><?= $k['rincian_transaksi'] ?></td>
                                                <td>
                                                    <?php if ($k['jenis_transaksi'] == 'pengeluaran') {
                                                        echo $k['jumlah'];
                                                    } else {
                                                        echo "-";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($k['jenis_transaksi'] == 'pengeluaran') {
                                                        echo "Rp " . number_format($k['harga'], 0, ',', '.');;
                                                    } else {
                                                        echo "-";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($k['jenis_transaksi'] == 'pemasukan') {
                                                        echo "Rp " . number_format($k['jumlah'], 0, ',', '.');;
                                                    } else {
                                                        echo "-";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($k['jenis_transaksi'] == 'pengeluaran') {
                                                        echo "Rp " . number_format($k['total'], 0, ',', '.');;
                                                    } else {
                                                        echo "-";
                                                    } ?>
                                                </td>
                                                <td><?= date("d-m-Y", strtotime($k['created_at'])); ?></td>
                                                <td>
                                                    sukses
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- membuat pagination -->
                                <?= $pager->links('rekap', 'komik_pagination'); ?>
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