<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $suppliers */ ?>

<h2>Suppliers</h2>

<form method="GET" action="/suppliers/create">
    <input type="submit" value="Create">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    <?php foreach($suppliers as $supplier): ?>
        <tr>
            <td>
                <a href="/suppliers/<?= $supplier->id ?>"><?= $supplier->name; ?></a>
            </td>
            <td><?= $supplier->created_at; ?></td>
            <td><?= $supplier->updated_at; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'src/views/partials/footer.php'; ?>
