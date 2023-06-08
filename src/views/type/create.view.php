<?php require 'src/views/partials/head.php'; ?>

<h2>Create Type</h2>

<form action="/types/store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Type"><br>
    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the type will be created.</p>

<?php require 'src/views/partials/footer.php'; ?>
