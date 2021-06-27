<?php
/**
 * Defri Indra M
 * 2021-04-14
 */

class Connection
{
    protected $connection;

    public function __construct($params)
    {
        $this->connection = mysqli_connect($params['host'], $params['username'], $params['password'], $params['dbname']) or die("Koneksi gagal");
    }

    public function query($query)
    {
        $response = mysqli_query($this->connection, $query);
        return $response;
    }

    private function buildFields($fields, $with_key = true)
    {
        $fields_query = "";

        $field_len = count($fields) - 1;
        $index = 0;
        foreach ($fields as $field_name => $val) {
            $escaped_value = mysqli_escape_string($this->connection, $val);
            if ($with_key) {
                $fields_query .= "`$field_name` = '$escaped_value'";
            } else {
                $fields_query .= "'$escaped_value'";
            }
            if ($index < $field_len) {
                $fields_query .= ",";
            }
            $index++;
        }

        return $fields_query;
    }

    private function where($op, $params)
    {
        $query = "";

        if (is_array($params[1])) {
            $query .= "({$this->where($params[1][0], $params[1])})";
        } else {
            $query .= "`{$params[1]}`";
        }

        $query .= " {$op}";

        if (is_array($params[2])) {
            $query .= " ({$this->where($params[2][0], $params[2])})";
        } else {
            $query .= " '{$params[2]}'";
        }

        return $query;
    }

    public function buildQuery($params, $table)
    {
        $base_params = [
            "select" => ["*"],
        ];

        $base_params = array_merge($base_params, $params);

        if (isset($base_params['select'])):
            $select = "";
            $select_len = count($base_params['select']) - 1; //real index
            foreach ($base_params['select'] as $index => $val):
                $select .= "{$val}";
                if ($index < $select_len):
                    $select .= ",";
                endif;
            endforeach;
        endif;

        $query = "select {$select} from {$table}";

        if (isset($base_params['join'])):
            $join = "";
            if (isset($base_params['join'][0])):
                $join_len = count($base_params['join']) - 1;
                foreach ($base_params['join'] as $index => $joins):
                    $join .= " join {$joins['table']} on {$joins['on']}";
                    // if($index < $join_len):
                    //     $join .= ",";
                    // endif;
                endforeach;
            else:
                $join .= " join {$base_params['table']} on {$base_params['on']}";
            endif;

            $query .= $join;
        endif;
        
        if (isset($base_params['where'])):
            $query .= " where {$this->where($base_params['where'][0], $base_params['where'])}";
        endif;

        if (isset($base_params['group'])):
            $query .= " group by {$base_params['group']}";
        endif;

        if (isset($base_params['order'])):
            $query .= " order by {$base_params['order']}";
        endif;

        if (isset($base_params['limit'])):
            $query .= " limit {$base_params['limit']}";
        endif;

        return $query;
    }

    private function parseAsObj($mysqli_result){
        $template = [];
        while($res = mysqli_fetch_object($mysqli_result)){
            $template[] = $res;
        }

        return $template;
    }

    public function find($params, $table)
    {
        $query = $this->buildQuery($params, $table);

        return $this->parseAsObj($this->query($query));
    }

    public function findOne($params, $table)
    {
        $base_params = [
            "limit" => "1",
        ];
        $base_params = array_merge($base_params, $params);
        $query = $this->buildQuery($base_params, $table);
        $mysqli_result = $this->query($query);
        $template = (object)[];

        while($res = mysqli_fetch_object($mysqli_result)){
            $template = $res;
        }

        return $template;
    }

    public function update($fields, $table, $where = "1=1")
    {
        $query = "update {$table} set {$this->buildFields($fields)} where $where";
        return $this->query($query);
    }

    

    public function delete($table, $where = [])
    {
        $query = "delete from {$table}";
        $query .= " where {$this->where($where[0], $where)}";
        return $this->query($query);
    }


    public function insertOne($fields, $table)
    {
        if($fields == []) return false;

        $field_list = [];
        foreach ($fields as $key => $val) {
            $field_list[] = $key;
        }

        $field_list = implode(",", $field_list);
        $query = "insert into {$table}($field_list) values ({$this->buildFields($fields, false)})";

        return $this->query($query);
    }
}
