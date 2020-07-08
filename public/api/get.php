<?php

require_once '../../bootloader.php';

use App\Views\Forms\Tables\TableData;

$table_data = new TableData();
$comment = $table_data->getTableData();

print json_encode($comment);
