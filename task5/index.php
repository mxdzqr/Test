<?php
$sum = 0;

for ($i = 1; $i <= 999; $i++)
    $i % 3 == 0 || $i % 5 == 0 ? $sum += $i : NULL;

echo '<br>';
echo 'Сумма ' . $sum;
