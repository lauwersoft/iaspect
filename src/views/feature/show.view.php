<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $feature */ ?>

<h2>Show Feature</h2>

<div>
    Name: <?= $feature->name ?> <br>
    Created: <?= $feature->created_at ?> <br>
    Updated: <?= $feature->updated_at ?> <br>
</div>

<form method="GET" action="/features/<?= $feature->id ?>/edit">
    <input type="submit" value="Edit">
</form>

<form method="POST" action="/features/<?= $feature->id ?>/delete">
    <input type="submit" value="Delete">
</form>


<?php require 'src/views/partials/footer.php'; ?>
