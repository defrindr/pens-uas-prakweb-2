<?php

if($this->user->get('name')==null){
    Url::redirect("site/index");
}


$table_name = "transaksi_barang";
$redirection = str_replace("_", "-", $table_name);
$primary_key = "id";
$readable_column = "id";
$readable_name = ucwords(str_replace("_", " ", $table_name));
$trigger = "submit";
$columns = $this->db->getColumns($table_name, [
    "without_primary_key" => false,
    "unset" => [
        "barang_id",
        "created_by"
    ],
]);

$this->title = "Detail " . $readable_name;

$model = $this->db->findOne([
    "where" => [
        "=",
        $primary_key,
        $_GET['id'],
    ],
], $table_name);

$barang=$this->db->findOne([
    "where" => [
        "=",
        "id",
        $model->barang_id,
    ],
], "barang")->nama;

if ((array) $model == []):
    Url::redirect('site/error', ['error' => "404"]);
endif;

?>

<div class="row">

    <div class="col-md-8">
        <h1><?=$readable_name?>: <?=$model->$readable_column?></h1>
    </div>
</div>
<table class="table table-responsive">
    <tbody>
        <?php foreach ($columns as $col): ?>
        <tr>
            <td><?=strtoupper($col)?></td>
            <td>:</td>
            <td><?=$model->$col?></td>
        </tr>
        <?php endforeach?>
        <tr>
            <td>Barang</td>
            <td>:</td>
            <td><?=$barang?></td>
        </tr>
    </tbody>
</table>

<a href="<?=Url::to($redirection)?>" class="btn btn-warning">Kembali</a>