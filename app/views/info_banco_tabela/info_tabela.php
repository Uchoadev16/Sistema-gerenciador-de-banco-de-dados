<?php
//requerindo o arquivo para estanciar a class
require_once('../../controllers/controller_usuario.php');
//estanciando a class e chamando a função
$usuario = new controller_usuario;
$matriz_banco = $usuario->list_database();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USGBD - Sistema de Gerenciamento de Banco de Dados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #4338ca;
            --background-dark: #1e1b4b;
            --background-light: #f8fafc;
            --text-light: #f1f5f9;
            --text-dark: #1e293b;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-light);
            display: flex;
            min-height: 100vh;
            color: var(--text-dark);
        }

        nav {
            position: fixed;
            width: 280px;
            height: 200vh;
            background: linear-gradient(180deg, var(--background-dark) 0%, #2d2a5d 100%);
            color: var(--text-light);
            overflow-y: auto;
            transition: var(--transition);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .nav-section {
            padding: 1.5rem;
            max-height: calc(100vh - 2rem);
            overflow-y: auto;
        }

        .database-list {
            list-style: none;
            max-height: 500px;
            overflow-y: auto;
        }

        .brand-container h1 a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .section-title {
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            margin: 1rem 0 0.75rem;
        }

        .database-list {
            list-style: none;
            margin-top: 1.5rem;
        }

        .database-item {
            margin: 0.75rem 0;
            border-radius: 0.75rem;
        }

        .database-item details {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem;
            padding: 0.75rem;
        }

        .database-item summary {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .table-list {
            padding-left: 1.25rem;
        }

        .table-item {
            margin: 0.5rem 0;
            padding: 0.75rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-item a {
            text-decoration: none;
            color: var(--text-light);
        }

        .table-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(8px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 2rem;
            background: white;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .data-table th,
        .data-table td {
            padding: 1rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table th {
            background: #f8fafc;
            font-weight: 600;
            color: var(--text-dark);
            text-transform: uppercase;
        }

        .data-table tr:hover {
            background: #f1f5f9;
        }
    </style>
</head>

<body>

    <nav>
        <div class="brand-container">
            <h1><a href="../../index.php"><i class="fas fa-database"></i> USGBD</a></h1>
        </div>

        <p class="section-title">Databases</p>
        <ul class="database-list">

            <!--imprimindo todos os bancos que existe-->
            <?php foreach ($matriz_banco as $banco) { ?>
                <li class="database-item">
                    <details>
                        <summary><i class="fas fa-database"></i> <?= $banco['Database'] ?></summary>
                        <ul class="table-list">
                            <li>
                                <a href="../criar_deletar_tabela/criar_tabela.php?nome_banco=<?= $banco['Database'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Nova Tabela
                                </a>
                            </li>

                            <?php
                            //chamando a função para pegar todas as tabelas que existem em um banco
                            $matriz_tabela = $usuario->list_table($banco['Database']);
                                  //imprimindo todas as tabelas do banco
                            foreach ($matriz_tabela as $tabela) {
                            ?>
                                <li class="table-item">
                                    <a href="info_tabela.php?nome_banco=<?= $banco['Database'] ?>&nome_tabela=<?= $tabela['Tables_in_' . $banco['Database']] ?>">
                                        <i class="fas fa-table"></i> <?= $tabela['Tables_in_' . $banco['Database']] ?>
                                    </a>
                                </li>
                            <?php } ?>

                            <li class="table-item">
                                <a href="../criar_deletar_tabela/deletar_tabela.php?nome_banco=<?= $banco['Database'] ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Deletar Tabelas
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">Descrição da Tabela</h1>
        </div>

        <?php
        if (isset($_GET['nome_banco']) && isset($_GET['nome_tabela']) && !empty($_GET['nome_banco']) && !empty($_GET['nome_tabela'])) {
            $nome_banco = $_GET['nome_banco'];
            $nome_tabela = $_GET['nome_tabela'];
        ?>

            <h3>Descrição da tabela:</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Não Nulo</th>
                        <th>Chave</th>
                        <th>Default</th>
                        <th>Extra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //chamando a função para mostra a descrição da tabela
                    $desc_table = $usuario->desc_table($nome_banco, $nome_tabela);
                    foreach ($desc_table as $value) {
                    ?>
                        <tr>
                            <td><?= $value['Field'] ?></td>
                            <td><?= $value['Type'] ?></td>
                            <td><?= $value['Null'] ?></td>
                            <td><?= $value['Key'] ?></td>
                            <td><?= $value['Default'] ?></td>
                            <td><?= $value['Extra'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h3>Dados da tabela:</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <?php
                        $desc_table = $usuario->desc_table($nome_banco, $nome_tabela);
                        foreach ($desc_table as $value) {
                        ?>
                            <th><?= $value['Field'] ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //chamando as funções para mostrar os dados de uma tabela
                    $select_table = $usuario->select_table($nome_banco, $nome_tabela);
                    foreach ($select_table as $dados) {
                    ?>
                        <tr>
                            <?php
                            foreach ($desc_table as $value) {
                            ?>
                                <td><?= $dados[$value['Field']] ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.database-item summary').click(function() {
                $(this).parent().toggleClass('active');
            });
        });
    </script>

</body>

</html>