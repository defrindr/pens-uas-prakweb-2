<?php
$lists = [
    [
        "module=anggota&routes=",
        "Anggota",
    ],
    [
        "module=buku&routes=",
        "Buku",
    ],
    [
        "module=pinjam&routes=",
        "Pinjam",
    ],
];
?>
<ul class="nav nav-pills">
<?php foreach($lists as $list): ?>
    <li class="nav-item"><a href="<?=Url::getBaseUrl()?>index.php?<?= $list[0] ?>index" class="nav-link <?= (strpos("?".$_SERVER['QUERY_STRING'], $list[0]) != false) ? "active" : '' ?>"><?= $list[1] ?></a></li>
<?php endforeach ?>
</ul>