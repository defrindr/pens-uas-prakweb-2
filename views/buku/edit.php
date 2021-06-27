<?php
$this->title = "Edit Buku";

$buku = $this->db->findOne([
    "where" => [
        "=",
        "kode_buku",
        $_GET['id'],
    ],
], "buku");

if((array)$buku == []):
    header("location: ?module=site&routes=error&error=404");
endif;

if(isset($_POST['kode_buku'])){
    $response = $this->db->update($_POST, "buku", "kode_buku='$buku->kode_buku'");

    if($response){
        header("location: ?module=buku&routes=index&update-success=true");
    }else{ ?>
<div class="alert alert-danger">
    Gagal Diupdate
</div>
<?php }
}


?>

<div class="row">
    <div class="col-md-8">
        <h1>Edit Buku: <?=$buku->judul?></h1>
    </div>
</div>

<form class="form" action="" method="POST">
    <div class="row">
        <div class="col-md-6 mb-1">
            <div class="mb-3">
                <label for="">Kode Buku</label>
                <input type="text" class="form-control" name="kode_buku" value="<?= $buku->kode_buku ?>">
            </div>
            <div class="mb-3">
                <label for="">Judul</label>
                <input type="text" class="form-control" name="judul" value="<?= $buku->judul ?>">
            </div>
        </div>
        <div class="col-md-6 mb-1">
            <div class="mb-3">
                <label for="">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" value="<?= $buku->pengarang ?>">
            </div>
            <div class="mb-3">
                <label for="">Penerbit</label>
                <input type="text" class="form-control" name="penerbit" value="<?= $buku->penerbit ?>">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" value="submit">Submit</button>
        <a href="?module=buku&routes=index" class="btn btn-warning">Kembali</a>
    </div>
</form>