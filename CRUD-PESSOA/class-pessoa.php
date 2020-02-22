<?php
Class Pessoa{
    private $pdo;
    //terá 6 funções
    //conexão com o BD orientado a obj, passaremos como parametro para o construtor
    public function __construct($dbname,$host,$user,$senha)
    {
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }catch(PDOException $e){
            echo "Erro com banco de dados:".$e->getMessage();
            exit();
        }catch(Exception $e){
            echo "Erro generico:" . $e->getMessage();
            exit();
        }

    }
    //metodo que vai buscar todos os dados do BD
    public function buscarDados(){
        $cmd = $pdo
    }
}
?>