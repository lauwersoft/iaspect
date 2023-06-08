<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $feature */ ?>

<h2>Edit Feature</h2>

<form action="/features/<?= $feature->id ?>/update" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $feature->name ?>"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the feature will be updated.</p>

<?php require 'src/views/partials/footer.php'; ?>
