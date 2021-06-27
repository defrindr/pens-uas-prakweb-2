<?php
$this->title = "Tambah Anggota";

if (isset($_POST['nrp'])) {
    $response = $this->db->insertOne($_POST, "anggota");

    if ($response) {
        Url::redirect('anggota', ['create-success' => 'true']);
    } else {?>
    <div class="alert alert-danger">
        Gagal Dibuat : <?=$this->db->getError()?>
    </div>
<?php }
}

?>

<div class="row">
    <div class="col-md-8">
        <h1>Create Anggota</h1>
    </div>
</div>

<form class="form" action="" method="POST">
    <div class="mb-3">
        <label for="">NRP</label>
        <input type="text" class="form-control" name="nrp" value="<?=($_GET['nrp']) ?? ""?>">
    </div>
    <div class="mb-3">
        <label for="">NAMA</label>
        <input type="text" class="form-control" name="nama" value="<?=($_GET['nama']) ?? ""?>">
    </div>
    <div class="mb-3">
        <label for="">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tgl_lahir" value="<?=($_GET['tgl_lahir']) ?? ""?>">
    </div>
    <div class="mb-3">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" value="<?=($_GET['alamat']) ?? ""?>">
    </div>
    <div class="mb-3">
        <label for="">No HP</label>
        <input type="text" class="form-control" name="no_hp" value="<?=($_GET['no_hp']) ?? ""?>">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" value="submit">Submit</button>
        <a href="<?=Url::to("anggota/")?>" class="btn btn-warning">Kembali</a>
    </div>
</form>