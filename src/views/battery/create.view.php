<?php require 'src/views/partials/head.php'; ?>

<h2>Create Battery</h2>

<form action="/batteries/store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Battery"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the battery will be created.</p>

<?php require 'src/views/partials/footer.php'; ?>
