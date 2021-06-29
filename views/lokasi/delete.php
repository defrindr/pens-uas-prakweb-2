<?php

if($this->user->get('name')==null){
    Url::redirect("site/index");
}

$table_name = "lokasi";
$primary_key = "id";
$redirection = "lokasi/index";

if (isset($_POST['id'])) {
    $model = $this->db->findOne([
        "where" => [
            "=",
            $primary_key,
            $_POST['id'],
        ],
    ], $table_name);

    if ((array) $model == []):
        Url::redirect('site/error', ['error' => '404']);
    endif;

    $response = $this->db->delete($table_name, [
        "=",
        $primary_key,
        $model->id,
    ]);

    if ($response) {
        Url::redirect($redirection, ['delete-success' => 'true']);
    } else {
        Url::redirect($redirection, [
            'delete-success' => 'false',
            'msg' => $this->db->getError(),
        ]);
    }
} else {
    echo "400 bad request";
}
