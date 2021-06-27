<?php

if(isset($_POST['id'])){
    $anggota = $this->db->findOne([
        "where" => [
            "=",
            "nrp",
            $_POST['id'],
        ],
    ], "anggota");
    
    if((array)$anggota == []):
        header("location: ?module=site&routes=error&error=404");
    endif;
    
    $response = $this->db->delete("anggota", [
        "=",
        "nrp",
        $anggota->nrp,
    ]);
    
    if(isset($response)){
    
        if($response){
            header("location: ?module=anggota&routes=index&delete-success=true");
        }else{
            header("location: ?module=anggota&routes=index&delete-success=false");
        }
    }
}else{
    echo "400 bad request";
}


?>
