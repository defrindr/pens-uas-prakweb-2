<?php
$redirection = $table_name = "barang";
$primary_key = "id";
$readable_column = "nama";
$readable_name = ucwords(str_replace("_", " ", $table_name));
$trigger = "submit";
$lokasi = $this->db->find([], "lokasi");

$this->title = "Edit " . $readable_name;

$model = $this->db->findOne([
    "where" => [
        "=",
        $primary_key,
        $_GET['id'],
    ],
], $table_name);

if ((array) $model == []):
    Url::redirect('site/error', ['error' => '404']);
endif;

if (isset($_POST[$trigger])) {
    unset($_POST[$trigger]);
    $response = $this->db->update($_POST, $table_name, "$primary_key='{$model->$primary_key}'");

    if ($response) {
        Url::redirect($redirection, ['update-success' => 'true']);
    } else {?>
        <div class="alert alert-danger">
            Gagal Diupdate: <?=$this->db->getError()?>
        </div>
    <?php }
}

?>

<div class="row">
    <div class="col-md-8">
        <h1>Edit <?=$readable_name?>: <?=$model->$readable_column?></h1>
    </div>
</div>

<form class="form" action="" method="POST">
    <div class="mb-3">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" value="<?=$model->nama?>" required>
    </div>
    <div class="mb-3">
        <label for="">Lokasi</label>
        <select name="lokasi_id" id="lokasi_id" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($lokasi as $lok): ?>
                <option value="<?=$lok->id?>" <?=($lok->id == $model->lokasi_id) ? "selected" : ""?>><?=$lok->ruang?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Stok</label>
        <input type="text" class="form-control" name="stok" value="<?=$model->stok?>" required>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="<?=$trigger?>">Submit</button>
        <a href="<?=Url::to($redirection);?>" class="btn btn-warning">Kembali</a>
    </div>
</form>