<?php
$redirection = $table_name = "lokasi";
$primary_key = "id";
$readable_column = "ruang";
$readable_name = ucwords(str_replace("_", " ", $table_name));
$trigger="submit";

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
        <label for="">Ruang</label>
        <input type="text" class="form-control" name="ruang" value="<?=$model->ruang?>" required>
    </div>
    <div class="mb-3">
        <label for="">NO</label>
        <input type="text" class="form-control" name="no" value="<?=$model->no?>" required>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="<?=$trigger?>">Submit</button>
        <a href="<?=Url::to($redirection);?>" class="btn btn-warning">Kembali</a>
    </div>
</form>