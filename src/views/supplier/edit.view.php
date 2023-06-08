<?php require 'src/views/partials/head.php'; ?>
<?php /** @var stdClass $supplier */ ?>

<h2>Edit Supplier</h2>

<form action="/suppliers/<?= $supplier->id ?>/update" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $supplier->name ?>"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the supplier will be updated.</p>

<?php require 'src/views/partials/footer.php'; ?>
