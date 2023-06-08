<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $battery */ ?>

<h2>Show Battery</h2>

<div>
    Name: <?= $battery->name ?> <br>
    Created: <?= $battery->created_at ?> <br>
    Updated: <?= $battery->updated_at ?> <br>
</div>

<form method="GET" action="/batteries/<?= $battery->id ?>/edit">
    <input type="submit" value="Edit">
</form>

<form method="POST" action="/batteries/<?= $battery->id ?>/delete">
    <input type="submit" value="Delete">
</form>


<?php require 'src/views/partials/footer.php'; ?>
