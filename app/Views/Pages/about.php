<?= $this->extend('Layout/template'); ?>
<!-- membuat layout conten harus sama dengan section pada template -->
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>About</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt deleniti reiciendis totam,
                blanditiis consectetur nesciunt dolore, rerum earum aliquam architecto cupiditate animi magnam! Velit,
                dolores aut. Minima voluptatum voluptatibus excepturi!</p>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>