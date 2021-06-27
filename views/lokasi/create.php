<?php
$redirection = $table_name = "lokasi";
$readable_name = ucwords(str_replace("_", " ", $table_name));
$trigger = "submit";

$this->title = "Tambah " . $readable_name;

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
        <label for="">Ruang</label>
        <input type="text" class="form-control" name="ruang" value="<?=isset($_POST['ruang']) ? $_POST['ruang'] : ""?>" required>
    </div>
    <div class="mb-3">
        <label for="">NO</label>
        <input type="text" class="form-control" name="no" value="<?=isset($_POST['no']) ? $_POST['no'] : ""?>" required>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="<?=$trigger?>">Submit</button>
        <a href="<?=Url::to($redirection)?>" class="btn btn-warning">Kembali</a>
    </div>
</form>