<?php
$this->title = "Detail Anggota";

$anggota = $this->db->findOne([
    "where" => [
        "=",
        "nrp",
        $_GET['id'],
    ],
], "anggota");


if((array)$anggota == []):
    header("location: ?module=site&routes=error&error=404");
endif;

?>

<div class="row">

    <div class="col-md-8">
        <h1>Anggota: <?=$anggota->nama?></h1>
    </div>
</div>
<table class="table table-responsive">
    <tbody>
        <tr>
            <td>NRP</td>
            <td>:</td>
            <td><?=$anggota->nrp?></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td><?=$anggota->nama?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?=$anggota->tgl_lahir?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?=$anggota->alamat?></td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>:</td>
            <td><?=$anggota->no_hp?></td>
        </tr>
    </tbody>
</table>

<a href="?module=anggota&routes=index" class="btn btn-warning">Kembali</a>