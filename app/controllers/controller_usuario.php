<?php
//requindo o arquivo model_usuario.php
require_once(realpath(dirname(__FILE__) . '/../models/model_usuario.php'));

//criando a class controller_usuario
class controller_usuario
{
    //atributos
    private $model;

    //metodos especiais
    function __construct()
    {
        //estanciando a class model_usuairo para ser usuada nos metodos
        $this->model = new model_usuario;
    }

    //metodos
    function list_database()
    {
        return $banco = $this->model->list_database();
    }
    function list_table($banco)
    {
        $list_table = $this->model->list_table($banco);
        return $list_table;
    }
    function criar_banco($nome_banco)
    {
        $result = $this->model->criar_banco($nome_banco);
        return $result;
    }
    function deletar_banco($nome_banco)
    {
        $result = $this->model->deletar_banco($nome_banco);
        return $result;
    }
    function criar_tabela($nome_banco, $nome_tabela, $nome_coluna, $tipo_coluna, $tamanho_coluna, $nao_nulo_coluna, $auto_incre_coluna, $primario_coluna){

        $result = $this->model->criar_tabela($nome_banco, $nome_tabela, $nome_coluna, $tipo_coluna, $tamanho_coluna, $nao_nulo_coluna, $auto_incre_coluna, $primario_coluna);

        return $result;
    }
    function deletar_tabela($nome_banco, $nome_tabela){

        $result = $this->model->deletar_tabela($nome_banco, $nome_tabela);

        return $result;
    }
    function desc_table($nome_banco, $nome_tabela){

        $result = $this->model->desc_table($nome_banco, $nome_tabela);

        return $result;
    }
    function select_table($nome_banco, $nome_tabela){

        $result = $this->model->select_table($nome_banco, $nome_tabela);

        return $result;
    }
}
