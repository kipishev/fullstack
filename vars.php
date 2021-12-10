<?php
$gamburger = 4.95;
$coctail = 1.95;
$coca_colla = 0.85;
$chai = 0.16;
$vat = 0.075;
$chek_novat = $gamburger * 2 + $coctail + $coca_colla;
$chek_with_chai = $chek_novat * $chai + $chek_novat;
echo "Сумма чека: " . $chek_with_chai * (1 + $vat) . " руб., в т. ч. НДС " . $vat * 100 . "%";
