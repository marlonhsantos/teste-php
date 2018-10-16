<?php
class ProdutoModel extends Model
{
    /**
     * Instancia um novo Modelo para Produto e carrega conexão com o banco de dados
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadDatabase();
    }

    /**
     * Busca todos os produtos no banco e retorna
     *
     * @return array
     */
    public function get($where=[], $orderby = '' ,$limit=false)
    {
        $sql = 'SELECT * FROM produtos' . ((count($where)) ? ' WHERE ' : '');
        $prepare = [];
        $operators = ['>=', '>', '<=', '<'];
        foreach($where as $field => $value){
            $operator = ' = ';
            foreach($operators as $op){
                if (strpos($field, $op) !== false) {
                    $operator = $op;
                    $field = str_replace($op, '', $field);
                }
            }
            $sql .= $field . ' ' . $operator . ' :'.$field;
            $prepare[':'.$field] = $value;
        }
        
        $sql .= (strlen($orderby)) ? ' ORDER BY ' . $orderby : '';
        $sql .= ($limit !== false) ? ' LIMIT 0,' . $limit : '';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($prepare);
        
        //$rs = $this->db->query();
        $rows = array();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    /**
     * Recebe um ID de Produto e retorna seus dados
     *
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        $rs = $this->db->query("SELECT * FROM produtos WHERE id = ".$id);
        $rows = array();
        if ($rs->rowCount() > 0) {
            $row = $rs->fetch(PDO::FETCH_OBJ);
            return $row;
        } else {
            return false;
        }

    }

    /**
     * Insere um novo Produto no banco de dados
     *
     * @param array $input_data
     * @return void
     */
    public function add($input_data)
    {
        $stmt = $this->db->prepare("INSERT INTO produtos(nome, descricao, quantidade, valor) VALUES(?, ?, ?, ?)");
        $stmt->bindParam(1, $input_data["nome"]);
        $stmt->bindParam(2, $input_data["descricao"]);
        $stmt->bindParam(3, $input_data["quantidade"]);
        $stmt->bindParam(4, $input_data["valor"]);
        $stmt->execute();

        $lastInsertId = $this->db->lastInsertId();
        
        if ($lastInsertId > 0) {
            return $lastInsertId;
        } else {
            return false;
        }
    }

    /**
     * Recebe um ID de Produto e altera o registro
     *
     * @param integer $id
     * @param array $input_data
     * @return void
     */
    public function update($id, $input_data)
    {
        $prepare = [':id' => $id];
        $sql = 'UPDATE produtos SET ';
        
        foreach($input_data as $field => $value){
            $sql .= $field . ' = :' . $field . ', ';
            $prepare[':'.$field] = $value;
        }
        
        $stmt = $this->db->prepare($sql . 'updated_at = NOW() WHERE id = :id');
        $stmt->execute($prepare);

        $affected_rows = $stmt->rowCount();
        
        if ($affected_rows > 0) {
            return $affected_rows;
        } else {
            return false;
        }
    }

    /**
     * Recebe um ID de Produto e apaga o registro
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $affected_rows = $stmt->rowCount();
        
        if ($affected_rows > 0) {
            return $affected_rows;
        } else {
            return false;
        }
    }
}