<?php require 'src/views/partials/head.php'; ?>

<h2>Create Supplier</h2>

<form action="/suppliers/store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Supplier"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the supplier will be created.</p>

<?php require 'src/views/partials/footer.php'; ?>
