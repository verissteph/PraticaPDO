<?php
//Aqui iremos embutir o php com html e css
//primeiro chamamos com require_onde o arquivo onde criamos a função
require_once 'class-pessoa.php';
//segundo vamos instanciar a class Pessoa por meio da criação de uma nova variável
$p = new Pessoa("crudpdo", "localhost", "root", "");
//terceiro vamos acessar o metodo que criamos, abrindo o php lá abaixo da section direito
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro Pessoa</title>
</head>

<body>
    <?php
    if (isset($_GET['id_update'])) { //se existe o id_update, ou seja, se a pessoa clicou em EDITAR significa que ela vai atualizar a informçao e logo em seguida clicar no botão atualizar, então acontecerá:
        $id_att = addslashes($_GET['id_update']); //nova variavel para armazenar a info do campo via GET
        $res = $p->buscarDadosPessoa($id_att); //vai receber o array proveniente da função buscaDadosPessoa

    }
    ?>
    <div class="sessoes">
        <section id="esquerdo">
            <?php
            //coletar todas as infos que foram colocadas nos inputs (caixinhas)
            if (isset($_POST['nome'])) { //se existir algo no campo nome. Significa que a pessoa clicou no botão CADASTRAR ou EDITAR
                //------------------------------------VAI EDITAR---------------------------//
                if (isset($_GET['id_update']) && (!empty($_GET['id_update']))) { //se existir o id_update que só aparece qnd clicamos no editar, VAI EDITAR A INFO
                    $id_att = addslashes($_GET['id_update']);
                    $nome = addslashes($_POST['nome']);
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    if (!empty($nome) && !empty($telefone) && !empty($email)) {
                        //AQUI ESTÁ DANDO O ERRO --- CORREÇÃO: Estava chamando a função errada!
                        $p->atualizarDados($id_att, $nome, $telefone, $email);
                        header('location: index.php'); //Para quando apertar o atualizar e a info já tiver sido atualizada, ele irá f5 da pagina e o botão ''cadastrar'' irá aparecer como se fosse o inicio da pagina dnv
                    } else {

                        echo "Preencha todos os campos";
                    }
                } else { //caso contrario ----------------------VAI CADASTRAR--------------------
                    $nome = addslashes($_POST['nome']); // addslasches serve para manter a info mais segura, ela introduz caract especiais 
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    //evitar erros antes de enviar para ser cadastrada
                    if (!empty($nome) && !empty($telefone) && !empty($email)) { //se todos os campos estiverem preenchidos
                        //verificando se existe o cadastro e cadastrando 
                        if (!$p->cadastrarPessoa($nome, $telefone, $email)) { //se o retorno da função for FALSE, nós saberemos que já existe o email cadastrado
                            echo "Email ja cadastrado";
                        }
                    } else {
                        echo "Preencha todos os campos!";
                    }
                }
            }

            ?>
            <form action="" method="post">
                <h2>Cadastrar Pessoa</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if (isset($res)) {echo $res['nome'];} //Para aparecer as informações que ja estavam salvas, devemos fazer:?>">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php if (isset($res)) {echo $res['telefone'];} //Para aparecer as informações que ja estavam salvas, devemos fazer:?>">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php if (isset($res)) {echo $res['email'];} //Para aparecer as informações que ja estavam salvas, devemos fazer:?>">
                <input type="submit" value="<?php if (isset($res)) {echo "Atualizar";} else {echo "Cadastrar";
                                            } ?>">
            </form>
        </section>
        <section id="direito">
            <table>
                <tr id="titulo">
                    <td>NOME</td>
                    <td>TELEFONE</td>
                    <td colspan="2">E-MAIL</td>
                </tr>
                <?php
                $dados = $p->buscarDados(); //atribuindo o array de dados a uma variavel. Array de array.
                //var_dump($dados); estava verificando como a variavel $dados estava se comportava, pois estava dando erro, nada era preenchido. O erro é que estava usando prepare ao inves de query na function buscarDados.
                $tamanho_dados = count($dados); //criando variavel para contar o tamanho do array de dados
                if ($tamanho_dados > 0) { //se o array não estiver vazio,ou seja, tem pessoas no BD
                    for ($i = 0; $i < $tamanho_dados; $i++) { //executa o for para repetir o primeiro array que é a posição de cada pessoa
                        echo "<tr>"; //abre antes do foreach por que o for vai criar linha na posição 0 e mostrar todos os dados da pessoa dessa posição e assim por diante até a ultima pessoa (lembre que o foreach vai dar loop nos dados de cada pessoa)
                        foreach ($dados[$i] as $k => $v) { //executa o foreach para repetir as info do segundo array que tem os dados de cada pessoa
                            if ($k != "id") { // a coluna id nao aparece na nossa tabela, logo só irá rodar caso a coluna em questão não seja a coluna que contem o id
                                echo "<td>" . $v . "</td>"; //vai exibir as informações de nome,telefone e email 
                            }
                        }
                ?>
                        <td>
                            <a href="index.php?id_update=<?php echo $dados[$i]['id']; ?>">Editar</a>
                            <a href="index.php?id=<?php echo $dados[$i]['id']; //ao colocar a propria pagina eu estou atualizando ela e ao atualizar queremos ter como retorno um ID de cada pessoa, ao colocar '?id=' estamos criando um metodo GET e sempre que fazemos isso em um link nós estamos criando uma variável que pode ser pega atraves do GET. Abrimos a tag PHP depos do id para acessarmos o array onde os dados de cada pessoa está armazenado, no caso o array $dados que a cada interação [$i] mostrara o ['id'] da pessoa.
                                                    ?>">Excluir</a>
                        </td>
                    <?php
                        echo "</tr>";
                        //faz o tr dentro do FOR porque precisa repetir os botoes a cada linha repetida 
                    }
                } else { //senao se o array está vazio
                    
                    
                       echo "Ainda não há pessoas cadastradas!";
                }
                ?>
                <?php
                //após o envio do ID na pagina index.php vamos pegar o mesmo da seguinte forma
                if (isset($_GET['id'])) { //se a variavel GET foi enviada
                    $id_pessoa = addslashes($_GET['id']); // salvamos em uma variavel nova sempre com o addslasches, o nome fica a seu critério!
                    $p->excluirPessoa($id_pessoa); // enviamos para a função que foi criada para excluir 

                    //apos a exclusao é necessario atualizar a página, podemos usar a função header('location:index.php) que direciona para um local.
                    header("location: index.php"); //estava dando erro com o header, pois caso você nao acrescente o espaço entre location: e o index.php ele nao reconhece o comando!
                }
                ?>
            </table>
        </section>
    </div>
</body>

</html>