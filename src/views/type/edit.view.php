<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $type */ ?>

<h2>Edit Type</h2>

<form action="/types/<?= $type->id ?>/update" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $type->name ?>"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the type will be updated.</p>

<?php require 'src/views/partials/footer.php'; ?>
