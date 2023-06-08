<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $types */ ?>

<h2>Types</h2>

<form method="GET" action="/types/create">
    <input type="submit" value="Create">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    <?php foreach($types as $type): ?>
        <tr>
            <td>
                <a href="/types/<?= $type->id ?>"><?= $type->name; ?></a>
            </td>
            <td><?= $type->created_at; ?></td>
            <td><?= $type->updated_at; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'src/views/partials/footer.php'; ?>
