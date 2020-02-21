<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro Pessoa</title>
</head>
<body>
    <section id="esquerdo">
        <form action="">
            <h2>Cadastrar Pessoa</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone">
            <label for="email">Email</label>
            <input type="text"name="email" id="email">
            <input type="submit" value="cadastrar">
        </form>
    </section>
    <section id="direito">
        <table>
            <tr>
                <td>Nome</td>
                <td>Telefone</td>
                <td colspan="2">E-mail</td>
            </tr>
            <tr>
                <td>Maria</td>
                <td>0000000</td>
                <td>maria@gmail.com</td>
                <td>
                <a href="#">editar</a>
                <a href="#">excluir</a>
                </td>
            </tr>
        </table>
    </section>
</body>
</html>