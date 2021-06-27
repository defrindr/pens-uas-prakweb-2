<?php

$this->title = "Anggota";
?>

<h1>Anggota</h1>
<a href="?module=anggota&routes=create" class="btn btn-success">create</a>
<table class="table table-responsive">
    <thead>
        <th>NRP</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
            $anggota = $this->db->find([],"anggota");
            foreach($anggota as $row): ?>
        <tr>
            <td><?= $row->nrp ?></td>
            <td><?= $row->nama ?></td>
            <td><?= $row->tgl_lahir ?></td>
            <td><?= $row->alamat ?></td>
            <td><?= $row->no_hp ?></td>
            <td>
                <a href="?module=anggota&routes=view&id=<?= $row->nrp ?>" class="btn btn-primary  mt-1">show</a>
                <a href="?module=anggota&routes=edit&id=<?= $row->nrp ?>" class="btn btn-warning mt-1">edit</a>
                <form action="?module=anggota&routes=delete" method="post" style="display: inline-block;">
                    <input type="hidden" name="id" value="<?= $row->nrp ?>">
                    <button class="btn btn-danger mt-1">delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>