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
        }

        nav {
            background-color: #2c3e50;
            width: 250px;
            height: 100vh;
            position: fixed;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }

        nav h1 a {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
            display: block;
            margin-bottom: 20px;
        }

        nav ul {
            list-style: none;
        }

        nav p {
            color: #ecf0f1;
            margin: 15px 0;
            font-weight: bold;
        }

        nav li {
            margin: 10px 0;
        }

        nav a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s;
            padding: 5px 0;
            display: block;
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
            margin-bottom: 5px;
        }

        details ul {
            margin-left: 20px;
        }

        section {
            margin-left: 250px;
            padding: 30px;
            background-color: white;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form p {
            margin: 10px 0;
            color: #2c3e50;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        td {
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        tr:first-child {
            background-color: #2c3e50;
            color: white;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        input[type="checkbox"],
        input[type="radio"] {
            margin: 0;
            cursor: pointer;
        }

        select {
            background-color: white;
            cursor: pointer;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

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

        @media (max-width: 1200px) {
            nav {
                width: 200px;
            }

            section {
                margin-left: 200px;
            }
        }

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
    </style>
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
        <?php

        if (isset($_POST['nome_numero_tabela']) && isset($_GET['nome_banco']) && !empty($_POST['nome_tabela']) && !empty($_POST['numero_coluna'])) {

            $nome_tabela = $_POST['nome_tabela'];
            $numero_coluna = $_POST['numero_coluna'];
            $nome_banco = $_GET['nome_banco'];
        ?>

            <form action="../../controllers/controller.php" method="post">

                <p>Nome da tabela: <?= $nome_tabela ?></p>
                <p>Número de tabelas: <?= $numero_coluna ?></p>

                <input type="hidden" name="nome_tabela" value="<?= $nome_tabela ?>">
                <input type="hidden" name="nome_banco" value="<?= $nome_banco ?>">
                <table>
                    <tr>
                        <td>Nome</td>
                        <td>Tipo</td>
                        <td>Tamanho</td>
                        <td>Não nulo</td>
                        <td>Auto-incrementavel</td>
                        <td>Primaria</td>
                    </tr>

                    <?php
                    $i = $numero_coluna;
                    while ($i >= 1) {
                    ?>

                        <tr>
                            <td><input type="text" name="nome_coluna" id="criartabelajs" required></td>
                            <td>
                                <select name="tipo_coluna" required>
                                    <option value="INT">INT</option>
                                    <option value="VARCHAR">VARCHAR</option>
                                    <option value="TEXT">TEXT</option>
                                    <option value="TIME">TIME</option>
                                    <option value="DATE">DATE</option>
                                </select>
                            </td>
                            <td><input type="number" name="tamanho_coluna"></td>
                            <td><input type="checkbox" name="nao_nulo_coluna" value="NOT NULL"></td>
                            <td><input type="checkbox" name="auto_incre_coluna" value="PRIMARY KEY"></td>
                            <td><input type="radio" name="primario_coluna" value="AUTO_INCREMENT"></td>
                        </tr>
                    <?php
                        $i--;
                    }
                    ?>
                </table>
                <button type="submit" name="criar_tabela">Criar tabela</button>
            </form>
        <?php } else {

            header('location:../../index.php');
        } ?>

        <script>
            const input = document.getElementById('criartabelajs');

            input.addEventListener('input', function() {
                if (/^\d/.test(this.value)) {
                    this.value = this.value.slice(1);
                }
            });
            const espaco = document.getElementById('criartabelajs');

            input.addEventListener('keypress', function(event) {
                if (event.key === ' ') {
                    event.preventDefault();
                }
            });
        </script>
    </section>
</body>

</html>