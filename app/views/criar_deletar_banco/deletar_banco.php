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
    <title>USGBD - Deletar Banco de Dados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --background-dark: #1e293b;
            --background-light: #f8fafc;
            --text-light: #f1f5f9;
            --text-dark: #334155;
            --danger: #dc2626;
            --success: #16a34a;
            --warning: #ca8a04;
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
        }

        /* Navegação */
        nav {
            position: fixed;
            width: 280px;
            height: 100vh;
            background: var(--background-dark);
            color: var(--text-light);
            overflow-y: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .nav-header {
            padding: 1.5rem;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-header h1 a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-section {
            padding: 1rem;
        }

        .nav-list {
            list-style: none;
        }

        .nav-item {
            margin: 0.25rem 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.2s;
            border-radius: 0.375rem;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Conteúdo Principal */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            background: white;
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .page-title {
            font-size: 1.875rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Lista de Bancos */
        .database-list {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }

        .database-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }

        .database-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .database-name {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .delete-btn {
            background: var(--danger);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .delete-btn:hover {
            background: #b91c1c;
        }

        /* Mensagens de Status */
        .status-message {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-success {
            background: #dcfce7;
            color: var(--success);
            border: 1px solid #86efac;
        }

        .status-error {
            background: #fee2e2;
            color: var(--danger);
            border: 1px solid #fca5a5;
        }

        /* Modal de Confirmação */
        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }

        /* Animações */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .database-card {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-header">
            <h1>
                <a href="../../index.php">
                    <i class="fas fa-database"></i>
                    USGBD
                </a>
            </h1>
        </div>

        <div class="nav-section">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="criar_banco.php" class="nav-link">
                        <i class="fas fa-plus"></i>
                        Novo Banco
                    </a>
                </li>
                       <!--imprimindo todos os bancos que existe-->
                <?php foreach ($matriz_banco as $banco) { ?>
                    <li class="nav-item">
                        <details>
                            <summary class="nav-link">
                                <i class="fas fa-database"></i>
                                <?= htmlspecialchars($banco['Database']) ?>
                            </summary>
                            <ul class="nav-list">
                                <li class="nav-item">
                                    <a href="../criar_deletar_tabela/criar_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>"
                                        class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        Nova Tabela
                                    </a>
                                </li>
                                <?php
                                   //chamando a função para pegar todas as tabelas que existem em um banco
                                $matriz_tabela = $usuario->list_table($banco['Database']);
                                  //imprimindo todas as tabelas do banco
                                foreach ($matriz_tabela as $tabela) {
                                    ?>
                                    <li class="nav-item">
                                        <a href="../info_banco_tabela/info_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>&nome_tabela=<?= urlencode($tabela['Tables_in_' . $banco['Database']]) ?>"
                                            class="nav-link">
                                            <i class="fas fa-table"></i>
                                            <?= htmlspecialchars($tabela['Tables_in_' . $banco['Database']]) ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a href="../criar_deletar_tabela/deletar_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>"
                                        class="nav-link text-danger">
                                        <i class="fas fa-trash"></i>
                                        Deletar Tabelas
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-trash"></i>
                Deletar Banco de Dados
            </h1>
        </div>

        <?php if (isset($_GET['result'])) { ?>
            <div class="status-message status-<?= $_GET['result'] === 'certo' ? 'success' : 'error' ?>">
                <i class="fas fa-<?= $_GET['result'] === 'certo' ? 'check' : 'times' ?>-circle"></i>
                <?= $_GET['result'] === 'certo' ? 'Banco deletado com sucesso!' : 'Erro ao deletar o banco!' ?>
            </div>
        <?php } ?>

        <div class="database-list">
        <!--chamando a função para mostrar todos os bancos para serem deletados-->
            <?php foreach ($matriz_banco as $banco) { ?>
                <div class="database-card">
                    <div class="database-name">
                        <i class="fas fa-database"></i>
                        <?= htmlspecialchars($banco['Database']) ?>
                    </div>
                    <form action="../../controllers/controller.php" method="post" class="delete-form">
                        <input type="hidden" name="nome_banco" value="<?= htmlspecialchars($banco['Database']) ?>">
                        <button type="submit" name="deleta_banco" class="delete-btn"
                            onclick="return confirmarDelete(event, '<?= htmlspecialchars($banco['Database']) ?>')">
                            <i class="fas fa-trash"></i>
                            Deletar
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </main>

    <div class="modal-backdrop"></div>
    <div class="modal" id="confirmModal">
        <h3 class="modal-title">Confirmar Exclusão</h3>
        <p>Tem certeza que deseja deletar este banco de dados? Esta ação não pode ser desfeita.</p>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
            <button class="btn btn-danger" onclick="confirmDelete()">Deletar</button>
        </div>
    </div>

    <script>
        function confirmarDelete(event, databaseName) {
            if (!confirm(`Tem certeza que deseja deletar o banco "${databaseName}"? Esta ação não pode ser desfeita.`)) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Adiciona animações para os cards
        document.querySelectorAll('.database-card').forEach(card => {
            card.style.animationDelay = Math.random() * 0.5 + 's';
        });

        // Adiciona feedback visual aos botões
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function () {
                this.style.transform = 'scale(1.05)';
            });

            btn.addEventListener('mouseleave', function () {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>