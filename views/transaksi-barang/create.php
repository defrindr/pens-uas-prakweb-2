<?php
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
    unset($_POST[$trigger]);

    $_POST['tanggal'] = date("Y-m-d", strtotime($_POST['tanggal']));
    $_POST['created_at'] = date("Y-m-d H:i:s");
    $_POST['created_by'] = null;

    $response = $this->db->insertOne($_POST, $table_name);
    dd($this->db->getError());

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
        <label for="">Tanggal</label>
        <input type="date" class="form-control" name="tanggal" value="<?=isset($_POST['tanggal']) ? $_POST['tanggal'] : ""?>" required>
    </div>
    <div class="mb-3">
        <label for="">Jenis</label>
        <select name="jenis" id="jenis" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($jenis as $row): ?>
                <option value="<?=$row?>"><?=$row?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Barang</label>
        <select name="barang_id" id="barang_id" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($barang as $row): ?>
                <option value="<?=$row->id?>"><?=$row->nama?></option>
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