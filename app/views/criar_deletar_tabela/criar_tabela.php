<?php
//requerindo o arquivo para estanciar a class
require_once('../../controllers/controller_usuario.php');
//estanciando a class e chamando a função
$usuario = new controller_usuario;
$matriz_banco = $usuario->list_database();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USGBD - Sistema de Gerenciamento de Banco de Dados</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* Navegação */
        nav {
            background-color: var(--background-dark);
            color: var(--text-light);
            padding: 1.5rem;
            width: 280px;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        nav h1 {
            margin-bottom: 2rem;
        }

        nav h1 a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1.75rem;
            font-weight: 700;
        }

        nav ul {
            list-style: none;
            margin-bottom: 1rem;
        }

        nav p {
            color: var(--text-light);
            font-weight: 600;
            margin: 1rem 0;
            font-size: 1.1rem;
        }

        nav li {
            margin: 0.5rem 0;
        }

        nav a {
            color: var(--text-light);
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 4px;
            display: block;
            transition: all 0.2s ease;
        }

        nav a:hover {
            background-color: var(--secondary-color);
            transform: translateX(5px);
        }

        /* Details/Summary */
        details {
            margin: 0.5rem 0;
        }

        summary {
            padding: 0.75rem;
            cursor: pointer;
            border-radius: 4px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            font-weight: 500;
            transition: background-color 0.2s;
        }

        summary:hover {
            background-color: var(--primary-color);
        }

        details[open] summary {
            margin-bottom: 0.5rem;
        }

        details ul {
            margin-left: 1rem;
        }

        /* Seção principal */
        section {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Formulário */
        form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 2rem auto;
        }

        form label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        form input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        form input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }

        form button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
            width: 100%;
        }

        form button:hover {
            background-color: var(--secondary-color);
        }

        /* Mensagens */
        .message {
            padding: 1rem;
            border-radius: 4px;
            margin: 1rem 0;
            text-align: center;
            font-weight: 500;
        }

        .message.error {
            background-color: var(--danger);
            color: white;
        }

        .message.success {
            background-color: var(--success);
            color: white;
        }

        /* Links de ação */
        .action-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--danger);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 1rem;
            transition: background-color 0.2s;
        }

        .action-link:hover {
            background-color: #b91c1c;
        }
    </style>
</head>

<body>
    <nav>
        <h1><a href="../../index.php">USGBD</a></h1>
        <p>Databases</p>
        <ul>
            <li><a href="../criar_deletar_banco/criar_banco.php">Novo Banco</a></li>

            <!--imprimindo todos os bancos que existe-->
            <?php foreach ($matriz_banco as $banco) { ?>
                <li>
                    <details>
                        <summary><?= htmlspecialchars($banco['Database']) ?></summary>
                        <ul>
                            <li><a href="criar_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>">Nova Tabela</a>
                            </li>

                            <?php
                            //chamando a função para pegar todas as tabelas que existem em um banco
                            $matriz_tabela = $usuario->list_table($banco['Database']);
                               //imprimindo todas as tabelas do banco
                            foreach ($matriz_tabela as $tabela) {
                                $tabela_nome = $tabela['Tables_in_' . $banco['Database']];
                            ?>
                                <li>
                                    <a
                                        href="../info_banco_tabela/info_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>&nome_tabela=<?= urlencode($tabela_nome) ?>">
                                        <?= htmlspecialchars($tabela_nome) ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="deletar_tabela.php?nome_banco=<?= urlencode($banco['Database']) ?>"
                                    class="action-link">
                                    Deletar tabela
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            <?php } ?>
        </ul>

        <a href="../criar_deletar_banco/deletar_banco.php" class="action-link">Deletar banco</a>
    </nav>

    <section>
        <?php
        $nome_banco = $_GET['nome_banco'] ?? '';
        if ($nome_banco) {
        ?>
            <form action="criar_colunas.php?nome_banco=<?= urlencode($nome_banco) ?>" method="post">
                <h2>Criar Nova Tabela</h2>
                <div class="form-group">
                    <label for="nome">Nome da tabela:</label>
                    <input type="text" name="nome_tabela" id="criartabelajs" required placeholder="Digite o nome da tabela">
                </div>

                <div class="form-group">
                    <label for="numero">Número de colunas:</label>
                    <input type="number" name="numero_coluna" id="numero" required placeholder="Digite o número de colunas">
                </div>

                <button type="submit" name="nome_numero_tabela">Continuar</button>
            </form>

            <?php
            if (isset($_GET['result'])) {
                $result = $_GET['result'];
                $messageClass = '';
                $message = '';

                switch ($result) {
                    case 'ja_existe':
                        $messageClass = 'error';
                        $message = "A tabela já existe!";
                        break;
                    case 'certo':
                        $messageClass = 'success';
                        $message = "Tabela criada com sucesso!";
                        break;
                    case 'erro':
                        $messageClass = 'error';
                        $message = "Erro ao criar a tabela!";
                        break;
                }

                echo "<div class='message {$messageClass}'>{$message}</div>";
            }
            ?>
        <?php } else { ?>
            <div class="message error">Selecione um banco de dados primeiro.</div>
        <?php } ?>
    </section>

    <script>
        // Previne números no início do nome da tabela
        const input = document.getElementById('criartabelajs');
        input.addEventListener('input', function() {
            if (/^\d/.test(this.value)) {
                this.value = this.value.slice(1);
            }
        });

        // Previne espaços no nome da tabela
        input.addEventListener('keypress', function(event) {
            if (event.key === ' ') {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>