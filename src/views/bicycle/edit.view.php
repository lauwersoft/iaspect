<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $bicycle */ ?>

<h2>Edit Bicycle</h2>

<form action="/bicycles/<?= $bicycle->id ?>/update" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $bicycle->name ?>"><br>

    <label for="price">Price</label><br>
    <input type="text" id="price" name="price" value="<?= $bicycle->price ?>"><br>

    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the bicycle will be updated.</p>

<?php require 'src/views/partials/footer.php'; ?>
