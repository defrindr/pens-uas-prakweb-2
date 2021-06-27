<?php
$this->title = "Pinjam";
?>

<h1>Pinjam</h1>
<a href="?module=pinjam&routes=create" class="btn btn-success">create</a>
<table class="table table-responsive">
    <thead>
        <th>Nama</th>
        <th>Judul</th>
        <th>Tanggal Pinjam</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
            $pinjam = $this->db->find([
                "join" => [
                    [
                        "table" => "anggota",
                        "on" => "anggota.nrp = pinjam.nrp"
                    ],
                    [
                        "table" => "buku",
                        "on" => "buku.kode_buku = pinjam.kode_buku"
                    ],
                ]
            ],"pinjam");
            foreach($pinjam as $row): ?>
        <tr>
            <td><?= $row->nama ?></td>
            <td><?= $row->judul ?></td>
            <td><?= $row->tgl_pinjam ?></td>
            <td>
                <a href="?module=pinjam&routes=view&id=<?= $row->nrp ?>" class="btn btn-primary  mt-1">show</a>
                <a href="?module=pinjam&routes=edit&id=<?= $row->nrp ?>" class="btn btn-warning mt-1">edit</a>
                <form action="?module=pinjam&routes=delete" method="post" style="display: inline-block;">
                    <input type="hidden" name="id" value="<?= $row->nrp ?>">
                    <button class="btn btn-danger mt-1">delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>