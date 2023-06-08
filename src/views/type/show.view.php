<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $type */ ?>

<h2>Show Type</h2>

<div>
    Name: <?= $type->name ?> <br>
    Created: <?= $type->created_at ?> <br>
    Updated: <?= $type->updated_at ?> <br>
</div>

<form method="GET" action="/types/<?= $type->id ?>/edit">
    <input type="submit" value="Edit">
</form>

<form method="POST" action="/types/<?= $type->id ?>/delete">
    <input type="submit" value="Delete">
</form>


<?php require 'src/views/partials/footer.php'; ?>
