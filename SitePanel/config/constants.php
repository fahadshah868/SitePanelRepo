<?php

use Carbon\Carbon;

$date = Carbon::now();
$date = $date->toDateString();

return [
    'today_date' => $date,
]

?>