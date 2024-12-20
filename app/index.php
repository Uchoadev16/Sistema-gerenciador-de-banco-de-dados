<?php
//requerindo o arquivo para estanciar a class
require_once('controllers/controller_usuario.php');
//estanciando a class e chamando a função
$usuario = new controller_usuario;
$matriz_banco = $usuario->list_database();
?>

<!DOCTYPE html>
<html lang="en">

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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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
            height: 100vh;
            background: linear-gradient(180deg, var(--background-dark) 0%, #2d2a5d 100%);
            color: var(--text-light);
            overflow-y: auto;
            transition: var(--transition);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .brand-container {
            padding: 1.5rem;
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-container h1 a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            letter-spacing: -0.5px;
            transition: transform 0.3s ease;
        }

        .brand-container h1 a:hover {
            transform: scale(1.05);
        }

        .brand-container h1 a i {
            color: var(--primary-color);
        }

        .nav-section {
            padding: 1.5rem;
        }

        .section-title {
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            margin: 1rem 0 0.75rem;
            letter-spacing: 0.05em;
        }

        .database-list {
            list-style: none;
        }

        .database-item {
            margin: 0.5rem 0;
            border-radius: 0.75rem;
            transition: var(--transition);
        }

        .database-item details {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem;
            margin: 0.75rem 0;
            transition: var(--transition);
        }

        .database-item details[open] {
            background: rgba(255, 255, 255, 0.08);
            padding-bottom: 0.5rem;
        }

        .database-item summary {
            padding: 1rem 1.25rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            transition: var(--transition);
            border-radius: 0.75rem;
        }

        .database-item summary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .database-item summary i {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .table-list {
            padding: 0.75rem 1.25rem 0.5rem 2.5rem;
        }

        .table-item {
            margin: 0.5rem 0;
            padding: 0.75rem;
            border-radius: 0.5rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            text-decoration: none;
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
            transition: var(--transition);
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn:hover::after {
            left: 100%;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
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
            letter-spacing: -0.025em;
        }

        .action-bar {
            display: flex;
            gap: 1rem;
            margin: 1.5rem 0;
            padding: 1.25rem;
            background: #f8fafc;
            border-radius: 1rem;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .data-table tr:hover {
            background: #f1f5f9;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background: #dcfce7;
            color: var(--success);
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-top: 0.5rem;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.5rem 0.75rem;
            background: var(--background-dark);
            color: white;
            font-size: 0.75rem;
            border-radius: 0.375rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            z-index: 1000;
        }

        [data-tooltip]:hover:before {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-8px);
        }

        @media (max-width: 768px) {
            nav {
                width: 240px;
                transform: translateX(-100%);
            }

            nav.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease forwards;
        }
    </style>
</head>

<body>
    <nav>
        <div class="brand-container">
            <h1><a href="index.php">
                    <i class="fas fa-database"></i>
                    USGBD
                </a></h1>
        </div>

        <div class="nav-section">
            <p class="section-title">Gerenciamento</p>
            <div class="action-bar">
                <a href="views/criar_deletar_banco/criar_banco.php" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Novo Banco
                </a>
            </div>

            <p class="section-title">Databases</p>
            <ul class="database-list">

                <!--imprimindo todos os bancos que existe-->
                <?php foreach ($matriz_banco as $banco) { ?>
                    <li class="database-item">
                        <details>
                            <summary>
                                <i class="fas fa-database"></i>
                                <?= $banco['Database'] ?>
                            </summary>
                            <ul class="table-list">
                                <li>
                                    <a href="views/criar_deletar_tabela/criar_tabela.php?nome_banco=<?= $banco['Database'] ?>"
                                        class="btn btn-primary btn-sm">
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
                                        <a
                                            href="views/info_banco_tabela/info_tabela.php?nome_banco=<?= $banco['Database'] ?>&nome_tabela=<?= $tabela['Tables_in_' . $banco['Database']] ?>">
                                            <i class="fas fa-table"></i>
                                            <?= $tabela['Tables_in_' . $banco['Database']] ?>
                                        </a>
                                    </li>
                                <?php } ?>

                                <li class="table-item">
                                    <a href="views/criar_deletar_tabela/deletar_tabela.php?nome_banco=<?= $banco['Database'] ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Deletar Tabelas
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="nav-section">
            <a href="views/criar_deletar_banco/deletar_banco.php" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Deletar Banco
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">Bem vindo ao <b>USGBD</b></h1>
        </div>

        <div class="dashboard-stats">
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.database-item summary').click(function(e) {
                $(this).parent().toggleClass('active');
            });
        });
    </script>
</body>

</html>