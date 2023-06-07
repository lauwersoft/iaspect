<?php

require 'core/bootstrap.php';

use Core\App;

$sql = file_get_contents(__DIR__.'/migrations.sql');

try {
    /** @var PDO $db */
    $db = App::get('database');
    $db->exec($sql);

    echo "Migrated successfully\n";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}

$db = null;
