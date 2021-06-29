<?php

if($this->user->get('name')==null){
    Url::redirect("site/index");
}

$redirection = $table_name = "barang";
$readable_name = ucwords(str_replace("_", " ", $table_name));
$trigger = "submit";

$this->title = "Tambah " . $readable_name;
$lokasi = $this->db->find([], "lokasi");

if (isset($_POST[$trigger])) {
    unset($_POST[$trigger]);
    $response = $this->db->insertOne($_POST, $table_name);

    if ($response) {
        Url::redirect($redirection, ['create-success' => 'true']);
    } else {?>
    <div class="alert alert-danger">
        Gagal Dibuat : <?=$this->db->getError()?>
    </div>
<?php }
}

?>

<div class="row">
    <div class="col-md-8">
        <h1>Tambah <?=$readable_name?></h1>
    </div>
</div>

<form class="form" action="" method="POST">
    <div class="mb-3">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" value="<?=isset($_POST['nama']) ? $_POST['nama'] : ""?>" required>
    </div>
    <div class="mb-3">
        <label for="">Lokasi</label>
        <select name="lokasi_id" id="lokasi_id" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($lokasi as $lok): ?>
                <option value="<?=$lok->id?>"><?=$lok->ruang?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Stok</label>
        <input type="text" class="form-control" name="stok" value="<?=isset($_POST['stok']) ? $_POST['stok'] : ""?>" required>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="<?=$trigger?>">Submit</button>
        <a href="<?=Url::to($redirection)?>" class="btn btn-warning">Kembali</a>
    </div>
</form>