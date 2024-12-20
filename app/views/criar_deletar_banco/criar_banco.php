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
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --background-dark: #1e293b;
            --background-light: #f8fafc;
            --text-light: #f1f5f9;
            --text-dark: #334155;
            --danger: #dc2626;
            --success: #16a34a;
            --warning: #ca8a04;
            --border-color: #e2e8f0;
            --hover-color: #f1f5f9;
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
            z-index: 1000;
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

        .nav-header h1 a i {
            color: var(--primary-color);
        }

        .nav-section {
            padding: 1rem;
        }

        .nav-title {
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            margin: 1rem 0 0.5rem;
            padding: 0 0.5rem;
        }

        .nav-list {
            list-style: none;
        }

        .nav-item {
            margin: 0.25rem 0;
            border-radius: 0.375rem;
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

        .nav-link i {
            width: 1.5rem;
            text-align: center;
        }

        /* Conteúdo Principal */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            background: white;
            min-height: 100vh;
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

        /* Formulário */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Botões */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
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
            background: #b91c1c;
        }

        /* Mensagens de Status */
        .status-message {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideIn 0.3s ease-out;
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

        .status-warning {
            background: #fef3c7;
            color: var(--warning);
            border: 1px solid #fcd34d;
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

        /* Database List */
        .database-list {
            margin-top: 2rem;
        }

        .database-item {
            background: white;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .database-item:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .database-header {
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .database-name {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .database-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Tooltips */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.5rem;
            background: var(--background-dark);
            color: white;
            font-size: 0.75rem;
            border-radius: 0.25rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
        }

        [data-tooltip]:hover:before {
            opacity: 1;
            visibility: visible;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            nav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .form-container {
                padding: 1rem;
            }
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
            <p class="nav-title">Databases</p>
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
                                    <a href="../criar_deletar_tabela/criar_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>" class="nav-link">
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
                                        <a href="../info_banco_tabela/info_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>&nome_tabela=<?= urlencode($tabela['Tables_in_' . $banco['Database']]) ?>" class="nav-link">
                                            <i class="fas fa-table"></i>
                                            <?= htmlspecialchars($tabela['Tables_in_' . $banco['Database']]) ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a href="../criar_deletar_tabela/deletar_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>" class="nav-link text-danger">
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

        <div class="nav-section">
            <a href="deletar_banco.php" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                Deletar Banco
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <h2 class="page-title">
                <i class="fas fa-plus-circle"></i>
                Criar Novo Banco de Dados
            </h2>
        </div>

        <div class="form-container">
            <form action="../../controllers/controller.php" method="post" id="createDatabaseForm">
                <div class="form-group">
                    <label for="criarbancojs" class="form-label">Nome do Banco de Dados</label>
                    <input
                        type="text"
                        name="nome_banco"
                        id="criarbancojs"
                        class="form-input"
                        required
                        pattern="\S+"
                        placeholder="Digite o nome do banco de dados"
                        autocomplete="off">
                    <small class="form-text text-muted">
                        O nome não pode começar com números ou conter espaços
                    </small>
                </div>

                <button type="submit" name="criar_banco" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Criar Banco de Dados
                </button>
            </form>

            <?php if (isset($_GET['result'])) { ?>
                <div class="status-message status-<?php
                                                    echo ($_GET['result'] === 'certo' ? 'success' : ($_GET['result'] === 'erro' ? 'error' : 'warning'));
                                                    ?>">
                    <?php
                    switch ($_GET['result']) {
                        case 'certo':
                            echo "<i class='fas fa-check-circle'></i> Banco criado com sucesso!";
                            break;
                        case 'erro':
                            echo "<i class='fas fa-times-circle'></i> Erro ao criar o banco!";
                            break;
                        case 'ja_existe':
                            echo "<i class='fas fa-exclamation-circle'></i> Já existe um banco com esse nome!";
                            break;
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </main>

    <script>
        // Validação do formulário
        const input = document.getElementById('criarbancojs');
        const form = document.getElementById('createDatabaseForm');

        input.addEventListener('input', function() {
            // Remove números do início
            if (/^\d/.test(this.value)) {
                this.value = this.value.slice(1);
            }

            // Remove caracteres especiais e espaços
            this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '');
        });

        form.addEventListener('submit', function(event) {
            const button = this.querySelector('button[type="submit"]');

            if (!input.value.trim()) {
                event.preventDefault();
                showMessage('error', 'O nome do banco não pode estar vazio');
                return;
            }

            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Criando...';
        });

        messageDiv.className = `status-message status-${type}`;
        messageDiv.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i> ${message}`;

        const form = document.getElementById('createDatabaseForm');
        const existingMessage = document.querySelector('.status-message');

        if (existingMessage) {
            existingMessage.remove();
        }

        form.insertAdjacentElement('afterend', messageDiv);

        // Remove a mensagem após 5 segundos
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
        }

        // Animações para os detalhes da navegação
        document.querySelectorAll('details').forEach(detail => {
            detail.addEventListener('toggle', function() {
                const summary = this.querySelector('summary');
                if (this.open) {
                    summary.classList.add('active');
                } else {
                    summary.classList.remove('active');
                }
            });
        });

        // Adiciona tooltips dinâmicos
        document.querySelectorAll('[data-tooltip]').forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = this.dataset.tooltip;
                document.body.appendChild(tooltip);

                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
            });

            element.addEventListener('mouseleave', function() {
                const tooltip = document.querySelector('.tooltip');
                if (tooltip) {
                    tooltip.remove();
                }
            });
        });

        // Adiciona confirmação para ações destrutivas
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Tem certeza que deseja realizar esta ação? Esta ação não pode ser desfeita.')) {
                    e.preventDefault();
                }
            });
        });

        // Adiciona feedback visual ao hover dos itens da navegação
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });

            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        // Adiciona funcionalidade de busca (opcional)
        function addSearchFunctionality() {
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.placeholder = 'Buscar banco de dados...';
            searchInput.className = 'form-input search-input';

            const navSection = document.querySelector('.nav-section');
            navSection.insertBefore(searchInput, navSection.firstChild);

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('.nav-item').forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Adiciona funcionalidade de tema escuro (opcional)
        function addDarkModeToggle() {
            const toggle = document.createElement('button');
            toggle.className = 'btn btn-secondary dark-mode-toggle';
            toggle.innerHTML = '<i class="fas fa-moon"></i>';
            toggle.setAttribute('data-tooltip', 'Alternar tema escuro');

            document.querySelector('.nav-header').appendChild(toggle);

            toggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                this.innerHTML = document.body.classList.contains('dark-mode') ?
                    '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            });
        }

        // Inicializa funcionalidades extras
        document.addEventListener('DOMContentLoaded', function() {
            addSearchFunctionality();
            addDarkModeToggle();
        });
    </script>

    <!-- Estilos adicionais para funcionalidades extras -->
    <style>
        /* Estilo para o modo escuro */
        .dark-mode {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .dark-mode .main-content {
            background-color: #2d2d2d;
        }

        .dark-mode .form-container {
            background-color: #333333;
        }

        .dark-mode .form-input {
            background-color: #404040;
            color: #ffffff;
            border-color: #505050;
        }

        .dark-mode .btn-primary {
            background-color: #3182ce;
        }

        .dark-mode .status-message {
            background-color: #2d2d2d;
        }

        /* Estilo para a barra de busca */
        .search-input {
            margin: 1rem 0;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Estilo para o botão de tema */
        .dark-mode-toggle {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-light);
            padding: 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .dark-mode-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Animações melhoradas */
        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(5px);
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn:active {
            transform: translateY(0);
        }
    </style>
</body>

</html>