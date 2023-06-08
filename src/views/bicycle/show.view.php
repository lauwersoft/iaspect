<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $bicycle */ ?>
<?php /** @var stdClass $battery */ ?>
<?php /** @var stdClass $supplier */ ?>
<?php /** @var stdClass $type */ ?>
<?php /** @var array $features */ ?>

<h2>Show Bicycle</h2>

<div>
    Name: <?= $bicycle->name ?> <br>
    Price: <?= $bicycle->price ?> <br>
    Type: <a href="/types/<?= $type->id ?>"><?= $type->name ?></a><br>
    Battery: <a href="/batteries/<?= $battery->id ?>"><?= $battery->name ?></a><br>
    Supplier: <a href="/suppliers/<?= $supplier->id ?>"><?= $supplier->name ?></a><br>
    <?php foreach($features as $key => $feature): ?>
        Feature <?= $key + 1 ?>: <a href="/features/<?= $feature->id ?>"><?= $feature->name ?></a><br>
    <?php endforeach; ?>
    Created: <?= $bicycle->created_at ?> <br>
    Updated: <?= $bicycle->updated_at ?> <br>
</div>

<form method="GET" action="/bicycles/<?= $bicycle->id ?>/edit">
    <input type="submit" value="Edit">
</form>

<form method="POST" action="/bicycles/<?= $bicycle->id ?>/delete">
    <input type="submit" value="Delete">
</form>


<?php require 'src/views/partials/footer.php'; ?>
