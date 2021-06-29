<?php

if($this->user->get('name')==null){
    Url::redirect("site/index");
}

$table_name = "transaksi_barang";
$redirection = str_replace("_", "-", $table_name);
$readable_name = ucwords(str_replace("_", " ", $table_name));
$trigger = "submit";

$this->title = "Tambah " . $readable_name;
$barang = $this->db->find([], "barang");
$jenis = [
    "MASUK",
    "KELUAR",
];

if (isset($_POST[$trigger])) {
    $this->db->beginTransaction();
    unset($_POST[$trigger]);

    $_POST['tanggal'] = date("Y-m-d", strtotime($_POST['tanggal']));
    $_POST['created_at'] = date("Y-m-d H:i:s");
    $_POST['created_by'] = $this->user->get('id');

    $response = $this->db->insertOne($_POST, $table_name);

    if ($response) {

        $cek = (array) $this->db->findOne([
            "where" => [
                "=",
                "id",
                $_POST['barang_id'],
            ],
        ], "barang");

        if ($_POST['jenis'] == "MASUK") {
            $cek['stok'] += $_POST['jumlah'];
        } else {
            $cek['stok'] -= $_POST['jumlah'];
        }

        if ($cek['stok'] < 0) {?>
            
            <div class="alert alert-danger">
                Gagal Dibuat : Stok tidak mencukupi
            </div>
            <?php
            $this->db->rollback();
        } else {

            if ($this->db->update($cek, "barang", "id='{$cek['id']}'")) {
                $this->db->commit();
                Url::redirect($redirection, ['create-success' => 'true']);
            }
        }
        $this->db->rollback();

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
        <label for="">Tanggal</label>
        <input type="date" class="form-control" name="tanggal" value="<?=isset($_POST['tanggal']) ? $_POST['tanggal'] : ""?>" required>
    </div>
    <div class="mb-3">
        <label for="">Jenis</label>
        <select name="jenis" id="jenis" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($jenis as $row): ?>
                <option value="<?=$row?>" <?=(isset($_POST['jenis']) && $_POST['jenis'] == $row) ? "selected" : ""?>><?=$row?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Barang</label>
        <select name="barang_id" id="barang_id" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($barang as $row): ?>
                <option value="<?=$row->id?>" <?=(isset($_POST['barang_id']) && $_POST['barang_id'] == $row->id) ? "selected" : ""?>><?=$row->nama?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Jumlah</label>
        <input type="text" class="form-control" name="jumlah" value="<?=isset($_POST['jumlah']) ? $_POST['jumlah'] : ""?>" required>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="<?=$trigger?>">Submit</button>
        <a href="<?=Url::to($redirection)?>" class="btn btn-warning">Kembali</a>
    </div>
</form>