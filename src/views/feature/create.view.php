<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $bicycles */ ?>

<h2>Create Feature</h2>

<form action="/features/store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Feature"><br>

    <label for="bicycle_id">Choose a bicycle:</label><br>
    <select id="bicycle_id" name="bicycle_id">
        <?php foreach($bicycles as $bicycle): ?>
            <option value="<?= $bicycle->id ?>"><?= $bicycle->name ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the feature will be created.</p>

<?php require 'src/views/partials/footer.php'; ?>
