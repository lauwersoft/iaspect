<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $batteries */ ?>
<?php /** @var array $suppliers */ ?>
<?php /** @var array $types */ ?>

<h2>Create Bicycle</h2>

<form action="/bicycles/store" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Bicycle"><br>

    <label for="battery_id">Choose a battery:</label><br>
    <select id="battery_id" name="battery_id">
        <?php foreach($batteries as $battery): ?>
            <option value="<?= $battery->id ?>"><?= $battery->name ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="supplier_id">Choose a supplier:</label><br>
    <select id="supplier_id" name="supplier_id">
        <?php foreach($suppliers as $supplier): ?>
            <option value="<?= $supplier->id ?>"><?= $supplier->name ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="type_id">Choose a type:</label><br>
    <select id="type_id" name="type_id">
        <?php foreach($types as $type): ?>
            <option value="<?= $type->id ?>"><?= $type->name ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="price">Price</label><br>
    <input type="text" id="price" name="price" value="0"><br>

    <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the bicycle will be created.</p>

<?php require 'src/views/partials/footer.php'; ?>
