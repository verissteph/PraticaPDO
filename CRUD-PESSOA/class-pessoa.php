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
    //metodo que vai buscar todos os dados do BD e mostrar no lado direito da tela
    public function buscarDados(){
        $res=array();
        $cmd = $this->pdo ->query("SELECT * FROM pessoa ORDER BY nome"); // utilizamos a query por não precisarmos susbtituir valores, estamos agindo diretamente como se fosse no BD
        $res = $cmd ->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    //metodo para cadastrar pessoas ao banco de dados e mostrar no lado direito da tela, caso feito com sucesso
    public function cadastrarPessoa($nome,$telefone,$email){
        //antes de cadastrar é preciso verificar se já existe no BD
        $cmd = $this ->pdo->prepare("SELECT id FROM pessoa WHERE email=:email");
        $cmd->bindValue(":email",$email); //substituindo o que tem no bd pelo que ta em $email
        $cmd->execute();

        if($cmd ->rowCount() > 0) { // o email já existe no BD
            return false; //a pessoa ja ta cadastrada
        } else{ //email nao existe no BD e então irá cadastrar a partir do codigo abaixo.
            $cmd = $this ->pdo->prepare("INSERT INTO pessoa(nome,telefone,email)VALUES(:nome,:tel,:email)");
            $cmd->bindValue(":nome",$nome);
            $cmd->bindValue(":tel",$telefone);
            $cmd->bindValue(":email",$email);
            $cmd->execute();
            return true; //a pessoa não está cadastrada no BD AINDA
        }
    }
    //metodo para EXCLUIR quando apertar no botão, usaremos o mais convecional que é excluindo pelo ID de cada pessoa cadastrada.
    public function excluirPessoa($id){
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id=:id"); //deletando da tabela pessoa onde o id está como :id.
        $cmd->bindValue(":id",$id); //atribuindo ao :id o valor que a variavel $id receber
        $cmd->execute();
    }
    //metodo para PROCURAR os dados de uma pessoa a partir do seu ID e mostrar no campo quando escolher editar.
    public function buscarDadosPessoa($id){
    $res=[]; //para prevenir erros, determinamos que $res é um array vazio caso nao venha nehum dado do BD
    $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id=:id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res=$cmd->fetch(PDO::FETCH_ASSOC); // aqui estamos usando o fetch ao inves do fetchAll porque queremos os dados de uma única pessoa.
    return $res;
    }
    }

