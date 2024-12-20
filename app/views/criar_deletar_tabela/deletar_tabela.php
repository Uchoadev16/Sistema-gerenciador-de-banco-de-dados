<?php
//requerindo o arquivo para estanciar a class
require_once('../../controllers/controller_usuario.php');
//estanciando a class e chamando a função
$usuario = new controller_usuario;
$matriz_banco = $usuario->list_database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USGBD</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            position: relative;
        }

        /* Navegação */
        nav {
            background-color: #2c3e50;
            width: 250px;
            height: 100vh;
            position: fixed;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }

        nav h1 {
            margin-bottom: 20px;
        }

        nav h1 a {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
        }

        nav p {
            color: #ecf0f1;
            margin: 15px 0;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
        }

        nav li {
            margin: 10px 0;
        }

        nav a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s;
            display: block;
            padding: 5px 0;
        }

        nav a:hover {
            color: #3498db;
        }

        details {
            margin: 10px 0;
        }

        details summary {
            cursor: pointer;
            padding: 8px;
            background-color: #34495e;
            border-radius: 4px;
            color: white;
        }

        details ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        /* Seção Principal */
        section {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
            background-color: white;
        }

        section h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 28px;
        }

        /* Formulários */
        form {
            margin: 15px 0;
        }

        form ul {
            list-style: none;
        }

        form li {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        /* Botões */
        button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Links de Ação */
        nav a[href*="criar"],
        nav a[href*="nova"] {
            background-color: #2ecc71;
            padding: 8px 15px;
            border-radius: 4px;
            margin: 5px 0;
            display: inline-block;
        }

        nav a[href*="deletar"] {
            background-color: #e74c3c;
            padding: 8px 15px;
            border-radius: 4px;
            margin: 5px 0;
            display: inline-block;
        }

        nav a[href*="criar"]:hover,
        nav a[href*="nova"]:hover {
            background-color: #27ae60;
        }

        nav a[href*="deletar"]:hover {
            background-color: #c0392b;
        }

        /* Mensagens de Resultado */
        section>p {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        section>p:contains("sucesso") {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        section>p:contains("erro") {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        td {
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        /* Scrollbar Personalizada */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            nav {
                width: 200px;
            }

            section {
                margin-left: 200px;
            }
        }
    </style>
    <script>
        function confirmar_delete(event) {
            if (!confirm("Você deseja realmente apagar esta tabela?")) {
                event.preventDefault();
                alert("Banco não apagado!");
            }
        }
    </script>
</head>

<body>
    <nav>
        <ul>

            <h1><a href="../../index.php">USGBD</a></h1>
            <p>Databases</p>
            <li><a href="../criar_deletar_banco/criar_banco.php">Novo</a></li>

            <!--imprimindo todos os bancos que existe-->
            <?php foreach ($matriz_banco as $banco) { ?>

                <li>
                    <details>
                        <summary><?= $banco['Database'] ?></summary>
                        <ul>
                            <li><a href="criar_tabela.php?nome_banco=<?= $banco['Database'] ?>">Nova</a></li>

                            <?php
                            //chamando a função para pegar todas as tabelas que existem em um banco
                            $matriz_tabela = $usuario->list_table($banco['Database']);
                               //imprimindo todas as tabelas do banco
                            foreach ($matriz_tabela as $tabela) {
                            ?>
                                <li>
                                    <a
                                        href="../info_banco_tabela/info_tabela.php?nome_banco=<?= $banco['Database'] ?>&nome_tabela=<?= $tabela['Tables_in_' . $banco['Database']] ?>"><?= $tabela['Tables_in_' . $banco['Database']] ?></a>
                                </li>
                            <?php } ?>
                            <a href="deletar_tabela.php?nome_banco=<?= $banco['Database'] ?>">Deletar tabela</a>
                        </ul>
                    </details>
                </li>
            <?php } ?>
        </ul>

        <p><a href="../criar_deletar_banco/deletar_banco.php">Deletar banco</a></p>
    </nav>

    <section>
        <h1>Deletar tabela</h1>

        <?php
        //se existir o get"nome_banco"
        if (isset($_GET['nome_banco'])) {

            //criando a variavel nome_banco com o get passado
            $banco = $_GET['nome_banco'];

            $matriz_tabela = $usuario->list_table($banco);

            //enquanto a variavel matriz for igual a função fetch_assoc
            foreach ($matriz_tabela as $tabela) { ?>

                <form action="../../controllers/controller.php" method="post">
                    <ul>
                        <li>
                            <?= $tabela['Tables_in_' . $banco] ?>
                            <input type="hidden" name="nome_banco" value="<?= $banco ?>">
                            <input type="hidden" name="nome_tabela" value="<?= $tabela['Tables_in_' . $banco] ?>">
                            <button type="submit" name="deletar_banco" onclick="confirmar_delete(event)">Deletar banco</button>
                        </li>
                    </ul>
                </form>

            <?php } ?>
        <?php } ?>

        <?php

        if (isset($_GET['result'])) {

            switch ($result = $_GET['result']) {

                case 'certo':
                    echo "Tabela deletada com sucesso!";
                    break;

                case 'erro':
                    echo "Erro ao deletar a tabela!";
                    break;
            }
        }
        ?>
    </section>

</body>

</html>