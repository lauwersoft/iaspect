<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $batteries */ ?>

<h2>Batteries</h2>

<form method="GET" action="/batteries/create">
    <input type="submit" value="Create">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    <?php foreach($batteries as $battery): ?>
        <tr>
            <td>
                <a href="/batteries/<?= $battery->id ?>"><?= $battery->name; ?></a>
            </td>
            <td><?= $battery->created_at; ?></td>
            <td><?= $battery->updated_at; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'src/views/partials/footer.php'; ?>
