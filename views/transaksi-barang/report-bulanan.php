<?php

if($this->user->get('name')==null){
    Url::redirect("site/index");
}

$table_name = "transaksi_barang";
$redirection = str_replace("_", "-", $table_name);
$readable_name = ucwords(str_replace("_", " ", $table_name));

$date = $_GET['date'];
if ($date == null) {
    $date = date("Y-m");
}

$primary_key = $this->db->getPrimaryKey($table_name);
$columns = $this->db->getColumns($table_name, [
    "without_primary_key" => false,
    "unset" => [
        "created_by",
        "barang_id",
        "created_at",
    ],
]);

$model = $this->db->find([
    'where' => [
        "like",
        "tanggal",
        "{$date}%",
    ],
], $table_name);

$this->title = $readable_name;
?>

<span>Report Harian (<?=$date?>)</span>
<h1><?=$readable_name?></h1>

<form action="">
    <div class="row">
        <div class="col-md-6">
            <input type="month" class="form-control" name="date">
        </div>
        <div class="col-md-6">
            <button class="btn btn-success">Cari</button>
        </div>
    </div>
</form>
<table class="table table-responsive">
    <thead>
        <?php foreach ($columns as $col): ?>
        <th><?=ucwords(str_replace("_", " ", $col))?></th>
        <?php endforeach?>
        <th>Dibuat Oleh</th>
        <th>Barang</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php if (count($model) == 0): ?>
        <tr>
            <td colspan="7" class="text-center">Data tidak tersedia</td>
        </tr>
        <?php endif?>
        <?php foreach ($model as $row): ?>
        <tr>
            <?php foreach ($columns as $col): ?>
            <td><?=$row->$col?></td>
            <?php endforeach?>
            <td><?=$this->db->findOne([
    "where" => [
        "=",
        "id",
        $row->created_by,
    ],
], "user")->name?>
            </td>
            <td><?=$this->db->findOne([
    "where" => [
        "=",
        "id",
        $row->barang_id,
    ],
], "barang")->nama?>
            </td>
            <td>
                <a href="<?=Url::to($redirection . "/view", ['id' => $row->$primary_key])?>"
                    class="btn btn-primary  mt-1">show</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>