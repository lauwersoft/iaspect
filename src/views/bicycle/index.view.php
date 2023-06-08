<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $bicycles */ ?>

<h2>Bicycles</h2>

<form method="GET" action="/bicycles/create">
    <input type="submit" value="Create">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    <?php foreach($bicycles as $bicycle): ?>
        <tr>
            <td>
                <a href="/bicycles/<?= $bicycle->id ?>"><?= $bicycle->name; ?></a>
            </td>
            <td><?= $bicycle->created_at; ?></td>
            <td><?= $bicycle->updated_at; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'src/views/partials/footer.php'; ?>
