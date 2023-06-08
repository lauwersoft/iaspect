<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $supplier */ ?>

<h2>Show Supplier</h2>

<div>
    Name: <?= $supplier->name ?> <br>
    Created: <?= $supplier->created_at ?> <br>
    Updated: <?= $supplier->updated_at ?> <br>
</div>

<form method="GET" action="/suppliers/<?= $supplier->id ?>/edit">
    <input type="submit" value="Edit">
</form>

<form method="POST" action="/suppliers/<?= $supplier->id ?>/delete">
    <input type="submit" value="Delete">
</form>


<?php require 'src/views/partials/footer.php'; ?>
