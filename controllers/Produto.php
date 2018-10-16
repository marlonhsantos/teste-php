<?php
class Produto extends Controller 
{
    /**
     * Instancia um Controller para Produto e carrega uma Model para conexão com banco
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('ProdutoModel');
    }

    /**
     * Carrega a view padrão com a listagem de produtos
     *
     * @return void
     */
    public function index()
    {
        $data["title"] = "Lista de produtos";
        $data["rows_last_three"] = $this->ProdutoModel->get(['quantidade<=' => 3]);
        $data["rows_last_updated"] = $this->ProdutoModel->get([], 'updated_at DESC', 5);
        $this->loadView('inc/header',$data);
        $this->loadView('Produto/index',$data);
        $this->loadView('inc/footer');
    }
    
    /**
     * Carrega a view padrão com a listagem de produtos
     *
     * @return void
     */
    public function lists()
    {
        $data["title"] = "Lista de produtos";
        $data["rows"] = $this->ProdutoModel->get([], 'nome, valor');
        $this->loadView('inc/header',$data);
        $this->loadView('Produto/lists',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe um id de produto e carrega os dados em formulário
     *
     * @return void
     */
    public function get()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            $data["title"] = "Produto não encontrado!";
            $this->loadView('inc/header',$data);
            $this->loadView('Produto/nao_encontrado');
            $this->loadView('inc/footer');
        } else {
            $id = $_GET["id"];
            $data["title"] = "Editar produto";
            $row = $this->ProdutoModel->getById($id);
            if (is_object($row)) {
                
                $data["id"] = $id;
                $data["nome"] = $row->nome;
                $data["descricao"] = $row->descricao;
                $data["quantidade"] = $row->quantidade;
                $data["valor"] = number_format($row->valor, 2, ',', '.');

                $this->loadView('inc/header',$data);
                $this->loadView('Produto/form',$data);
                $this->loadView('inc/footer');
            } else {
                $data["title"] = "Produto não nao_encontrado";
                $this->loadView('inc/header',$data);
                $this->loadView('Produto/nao_encontrado');
                $this->loadView('inc/footer');
            }
        }
    }
    
    /**
     * Recebe um id de produto e retorna os dados em JSON
     *
     * @return json
     */
    public function getJSON()
    {
        $output = [];
        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $id = $_GET["id"];
            $row = $this->ProdutoModel->getById($id);
            if (is_object($row)) {
                $output["id"] = $id;
                $output["nome"] = $row->nome;
                $output["descricao"] = $row->descricao;
                $output["quantidade"] = $row->quantidade;
                $output["valor"] = number_format($row->valor, 2, ',', '.');
                $output["created_at"] = date("d/m/Y H:i:s", strtotime($row->created_at));
                $output["updated_at"] = date("d/m/Y H:i:s", strtotime($row->updated_at));
            }
        }
        $data["output"] = json_encode($output);
        $this->loadView('json_output',$data);
    }

    /**
     * Recebe dados do usuário e exibe um formulário para criação de novo Produto
     *
     * @return void
     */
    public function create()
    {

        $data["title"] = "Novo produto";
        $data["id"] = '';
        $data["nome"] = '';
        $data["descricao"] = '';
        $data["quantidade"] = '';
        $data["valor"] = '';
        $this->loadView('inc/header',$data);
        $this->loadView('Produto/form',$data);
        $this->loadView('inc/footer');
    }

    /**
     * Recebe dados do usuário e adiciona um novo produto exibindo o resultado em JSON
     *
     * @return void
     */
    public function add()
    {
        $output_data = [];
        if (isset($_POST) && count($_POST) > 0) {
            $input_data = $_POST;
            $id = $this->ProdutoModel->add($input_data);
            if (is_numeric($id)) {
                $output_data["id"] = $id;
            } else {
                $output_data["err"] = true;
            }
        }
        $data["output"] = json_encode($output_data);
        
        $this->loadView('json_output',$data);
    }

    /**
     * Recebe dados do usuário e um ID de Produto para alterar os dados e exibindo o resultado em JSON
     *
     * @return void
     */
    public function update()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            $output_data["err"] = true;
        } else {
            $id = $_GET["id"];
            $output_data = [];

            if (isset($_POST) && count($_POST) > 0) {
                $input_data = $_POST;
                $affected_rows = $this->ProdutoModel->update($id, $input_data);
                if (is_numeric($affected_rows)) {
                    $output_data["affected_rows"] = $affected_rows;
                } else {
                    $output_data["err"] = true;
                }

            }
        }

        $data["output"] = json_encode($output_data);
        
        $this->loadView('json_output',$data);
    }

    /**
     * Recebe um ID de Produto e o apaga exibindo o resultado em JSON
     *
     * @return void
     */
    public function delete()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            $output_data["err"] = true;
        } else {
            $id = $_GET["id"];
            $output_data = [];

            $affected_rows = $this->ProdutoModel->delete($id);
            if (is_numeric($affected_rows)) {
                $output_data["affected_rows"] = $affected_rows;
            } else {
                $output_data["err"] = true;
            }
        }

        $data["output"] = json_encode($output_data);
        
        $this->loadView('json_output',$data);
    }
}