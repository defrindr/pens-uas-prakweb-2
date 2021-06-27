<?php
if(isset($_POST['id'])){
    $buku = $this->db->findOne([
        "where" => [
            "=",
            "kode_buku",
            $_POST['id'],
        ],
    ], "buku");
        
    if((array)$buku == []):
        Url::redirect('site/error', ['error' => '404']);
    endif;
    
    $response = $this->db->delete("buku", [
        "=",
        "kode_buku",
        $buku->kode_buku,
    ]);
    

    if ($response) {
        Url::redirect('buku/index', ['delete-success' => 'true']);
    } else {
        Url::redirect('buku/index', [
            'delete-success' => 'false',
            'msg' => $this->db->getError(),
        ]);
    }
}else{
    echo "400 bad request";
}


?>
