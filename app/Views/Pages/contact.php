<?= $this->extend('Layout/template'); ?>
<!-- membuat layout conten harus sama dengan section pada template -->
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Contact</h1>
            <?php foreach ($alamat as $a) : ?>
                <ul>
                    <li><?= $a['tipe']; ?></li>
                    <li><?= $a['alamat']; ?></li>
                    <li><?= $a['kota']; ?></li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>