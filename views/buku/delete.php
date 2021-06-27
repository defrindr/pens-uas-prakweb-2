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
        header("location: ?module=site&routes=error&error=404");
    endif;
    
    $response = $this->db->delete("buku", [
        "=",
        "kode_buku",
        $buku->kode_buku,
    ]);
    
    if(isset($response)){
        if($response){
            header("location: ?module=buku&routes=index&delete-success=true");
        }else{
            header("location: ?module=buku&routes=index&delete-success=false");
        }
    }
}else{
    echo "400 bad request";
}


?>
