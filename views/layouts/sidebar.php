<?php
$lists = [
    [
        Url::getBaseUrl()."/barang/",
        "Barang",
    ],
    [
        Url::getBaseUrl()."/lokasi/",
        "Lokasi",
    ],
    [
        Url::getBaseUrl()."/transaksi-barang/",
        "Transaksi Barang",
    ],
];
?>
<ul class="nav nav-pills">
<?php foreach($lists as $list): ?>
    <li class="nav-item"><a href="<?= $list[0] ?>index" class="nav-link <?= (strpos("?".$_SERVER['QUERY_STRING'], $list[0]) != false) ? "active" : '' ?>"><?= $list[1] ?></a></li>
<?php endforeach ?>
</ul>