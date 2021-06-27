<?php
$table_name = "transaksi_barang";
$redirection = str_replace("_", "-", $table_name);
$readable_name = ucwords(str_replace("_", " ", $table_name));

$primary_key = $this->db->getPrimaryKey($table_name);
$columns = $this->db->getColumns($table_name, [
    "without_primary_key" => false,
    "unset" => [
        "created_by",
        "barang_id",
        "created_at",
    ],
]);

$model = $this->db->find([], $table_name);

$this->title = $readable_name;
?>

<h1><?=$readable_name?></h1>
<a href="<?=Url::to($redirection . "/create")?>" class="btn btn-success">Tambah</a>
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
                <a href="<?=Url::to($redirection . "/view", ['id' => $row->$primary_key])?>" class="btn btn-primary  mt-1">show</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>