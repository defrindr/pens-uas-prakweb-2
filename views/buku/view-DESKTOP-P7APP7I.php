<?php
$this->title = "Detail Buku";
$buku = $this->db->findOne([
    "where" => [
        "=",
        "kode_buku",
        $_GET['id'],
    ],
], "buku");

if((array)$buku == []):
    Url::redirect('site/error',['error'=>'404']);
endif;

?>
<div class="row">

    <div class="col-md-8">
        <h1>Buku: <?=$buku->judul?></h1>
    </div>
</div>
<table class="table table-responsive">
    <tbody>
        <tr>
            <td>Kode Buku</td>
            <td>:</td>
            <td><?=$buku->kode_buku?></td>
        </tr>
        <tr>
            <td>Judul</td>
            <td>:</td>
            <td><?=$buku->judul?></td>
        </tr>
        <tr>
            <td>Pengarang</td>
            <td>:</td>
            <td><?=$buku->pengarang?></td>
        </tr>
        <tr>
            <td>Penerbit</td>
            <td>:</td>
            <td><?=$buku->penerbit?></td>
        </tr>
    </tbody>
</table>

<a href="<?=Url::to('buku')?>" class="btn btn-warning">Kembali</a>