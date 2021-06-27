<?php
$this->title = "Edit Anggota";

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

if(isset($_POST['nrp'])){
    $response = $this->db->update($_POST, "anggota", "nrp='$anggota->nrp'");

    if($response){
        header("location: ?module=anggota&routes=index&update-success=true");
    }else{ ?>
        <div class="alert alert-danger">
            Gagal Diupdate
        </div>
    <?php }
}


?>

<div class="row">
    <div class="col-md-8">
        <h1>Edit Anggota: <?=$anggota->nama?></h1>
    </div>
</div>

<form class="form" action="" method="POST">
    <div class="mb-3">
        <label for="">NRP</label>
        <input type="text" class="form-control" name="nrp" value="<?= $anggota->nrp ?>">
    </div>
    <div class="mb-3">
        <label for="">NAMA</label>
        <input type="text" class="form-control" name="nama" value="<?= $anggota->nama ?>">
    </div>
    <div class="mb-3">
        <label for="">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tgl_lahir" value="<?= $anggota->tgl_lahir ?>">
    </div>
    <div class="mb-3">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" value="<?= $anggota->alamat ?>">
    </div>
    <div class="mb-3">
        <label for="">No HP</label>
        <input type="text" class="form-control" name="no_hp" value="<?= $anggota->no_hp ?>">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" value="submit">Submit</button>
        <a href="?module=anggota&routes=index" class="btn btn-warning">Kembali</a>
    </div>
</form>