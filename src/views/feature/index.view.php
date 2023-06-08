<?php require 'src/views/partials/head.php'; ?>
<?php /** @var array $features */ ?>

<h2>Features</h2>

<form method="GET" action="/features/create">
    <input type="submit" value="Create">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    <?php foreach($features as $feature): ?>
        <tr>
            <td>
                <a href="/features/<?= $feature->id ?>"><?= $feature->name; ?></a>
            </td>
            <td><?= $feature->created_at; ?></td>
            <td><?= $feature->updated_at; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'src/views/partials/footer.php'; ?>
