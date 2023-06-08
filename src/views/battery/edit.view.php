<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $battery */ ?>

<h2>Edit Battery</h2>

<form action="/batteries/<?= $battery->id ?>/update" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $battery->name ?>"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the battery will be updated.</p>

<?php require 'src/views/partials/footer.php'; ?>
