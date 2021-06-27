<?php

if (isset($_POST['id'])) {
    $anggota = $this->db->findOne([
        "where" => [
            "=",
            "nrp",
            $_POST['id'],
        ],
    ], "anggota");

    if ((array) $anggota == []):
        Url::redirect('site/error', ['error' => '404']);
    endif;

    $response = $this->db->delete("anggota", [
        "=",
        "nrp",
        $anggota->nrp,
    ]);

    if ($response) {
        Url::redirect('anggota/index', ['delete-success' => 'true']);
    } else {
        Url::redirect('anggota/index', [
            'delete-success' => 'false',
            'msg' => $this->db->getError(),
        ]);
    }
} else {
    echo "400 bad request";
}
