<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FastHelp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            /* SUAS CORES E FONTES ORIGINAIS */
            --brand-color: #399400;
            --brand-gradient: linear-gradient(90deg, #5FEA00, #399400 );
            --text-color: #4B5563;
            --bg-color: #FFFFFF;
            --bg-color-sidebar: #F9FAFB;
            --hover-color: #F0F4F9;
            --border-color: #E5E7EB; /* Cor de borda para uso geral */

            /* SOMBRAS PARA OS CARDS "FLUTUANTES" */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);

            /* TAMANHOS DO LAYOUT */
            --sidebar-width-expanded: 260px;
            --sidebar-width-collapsed: 85px;
        }

        body {
            background-color: var(--bg-color); /* Fundo branco para a página toda */
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-color);
            display: flex;
        }

        /* --- SIDEBAR (SEM MUDANÇAS) --- */
        .sidebar {
            width: var(--sidebar-width-collapsed);
            height: 100vh;
            background-color: var(--bg-color-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 1.5rem 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            transition: width 0.3s ease;
            overflow-x: hidden;
        }
        .main-content {
            flex-grow: 1;
            padding: 2.5rem;
            margin-left: var(--sidebar-width-collapsed);
            transition: margin-left 0.3s ease;
        }
        .sidebar.expanded { width: var(--sidebar-width-expanded); }
        .sidebar.expanded + .main-content { margin-left: var(--sidebar-width-expanded); }
        .sidebar-header { display: flex; align-items: center; padding: 0 1.5rem; margin-bottom: 2rem; min-height: 40px; }
        .sidebar:not(.expanded) .sidebar-header { justify-content: center; padding: 0; }
        .logo { font-size: 1.75rem; font-weight: 700; background: var(--brand-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; white-space: nowrap; opacity: 0; transition: opacity 0.2s ease; margin-left: 1rem; }
        .sidebar.expanded .logo { opacity: 1; }
        .sidebar-toggle { background: none; border: none; color: var(--text-color); font-size: 1.5rem; cursor: pointer; padding: 0.5rem; border-radius: 50%; display: flex; transition: transform 0.3s ease; }
        .sidebar-toggle:hover { background-color: var(--hover-color); }
        .sidebar.expanded .sidebar-toggle { transform: rotate(180deg); }
        .nav-menu { flex-grow: 1; }
        .sidebar-footer { margin-top: auto; }
        .nav-link { display: flex; align-items: center; color: var(--text-color); font-weight: 500; height: 56px; text-decoration: none; white-space: nowrap; margin: 0.25rem 1rem; padding: 0 1.5rem; border-radius: 28px; }
        .nav-link:hover { background-color: var(--hover-color); }
        .nav-link.active { color: #fff; background-color: var(--brand-color); }
        .nav-link.active .bi { color: #fff; }
        .nav-link .bi { font-size: 1.25rem; min-width: 24px; margin-right: 1.5rem; color: var(--brand-color); }
        .nav-link .nav-text { opacity: 0; transition: opacity 0.2s ease; }
        .sidebar.expanded .nav-text { opacity: 1; }

        /* --- ESTILO DO TÍTULO E BOTÃO (Do seu design original) --- */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .highlight-gradient {
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }
        .btn-custom-green {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
            color: #fff;
            font-weight: 600; /* Mais negrito para o texto do botão */
            padding: 0.6rem 1.25rem; /* Ajuste no padding */
            border-radius: 0.5rem; /* Cantos arredondados */
            transition: all 0.2s ease; /* Transição suave para hover */
        }
        .btn-custom-green:hover {
            background-color: #2d7a00; /* Um tom de verde um pouco mais escuro no hover */
            border-color: #2d7a00;
            color: #fff;
            transform: translateY(-2px); /* Pequeno efeito "flutuante" no hover */
            box-shadow: var(--shadow-md); /* Sombra mais forte no hover */
        }

        /* --- CARDS DE ESTATÍSTICA (Voltando ao estilo "flutuante" com algumas adaptações) --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--bg-color); /* Fundo branco para os cards */
            padding: 1.5rem;
            border-radius: 0.75rem; /* Cantos arredondados */
            border: 1px solid var(--border-color); /* Borda sutil */
            box-shadow: var(--shadow-sm); /* Sombra suave para "flutuar" */
            transition: transform 0.2s ease, box-shadow 0.2s ease; /* Transição para o hover */
        }
        .stat-card:hover {
            transform: translateY(-5px); /* Efeito de elevação no hover */
            box-shadow: var(--shadow-md); /* Sombra maior no hover */
        }
        .stat-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .stat-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #6B7280; /* Um cinza um pouco mais escuro para o título do card */
        }

        /* Ícone com fundo colorido e verde da sua marca */
        .stat-card .card-icon {
            font-size: 1.25rem;
            padding: 0.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-color); /* Ícone no verde da sua marca */
            background-color: #E6F3E6; /* Um verde bem claro para o fundo do ícone */
        }

        .stat-card .card-value {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1F2937; /* Cor escura para o número */
        }
        .stat-card .card-footer-text {
            font-size: 0.875rem;
            color: #9CA3AF; /* Cor mais clara para o texto de rodapé */
        }

    </style>
</head>
<body>

    {{-- 1. COMPONENTE DA SIDEBAR --}}
    <x-side.menu />

    {{-- 2. CONTEÚDO PRINCIPAL --}}
    <main class="main-content">

        {{-- CABEÇALHO DA PÁGINA --}}
        <div class="page-header">
            <h1 class="h2 highlight-gradient">Dashboard</h1>
            <!-- <a href="#" class="btn btn-custom-green d-flex align-items-center">
                <i class="bi bi-plus-circle-fill me-2"></i>Novo Chamado
            </a> -->
        </div>

        {{-- CONTEÚDO DO DASHBOARD COM CARDS FLUTUANTES --}}
        <div class="stats-grid">

            {{-- CARD 1: CHAMADOS ABERTOS --}}
            <div class="stat-card">
                <div class="card-header">
                    <span class="card-title">Chamados Abertos</span>
                    <div class="card-icon"><i class="bi bi-ticket-detailed"></i></div>
                </div>
                <p class="card-value">12</p>
                <span class="card-footer-text">3 novos nas últimas 24h</span>
            </div>

            {{-- CARD 2: RESOLVIDOS HOJE --}}
            <div class="stat-card">
                <div class="card-header">
                    <span class="card-title">Resolvidos Hoje</span>
                    <div class="card-icon"><i class="bi bi-patch-check"></i></div>
                </div>
                <p class="card-value">8</p>
                <span class="card-footer-text">Meta de 15</span>
            </div>

            {{-- CARD 3: PENDENTES --}}
            <div class="stat-card">
                <div class="card-header">
                    <span class="card-title">Aguardando Resposta</span>
                    <div class="card-icon"><i class="bi bi-hourglass-split"></i></div>
                </div>
                <p class="card-value">4</p>
                <span class="card-footer-text">2 com SLA em risco</span>
            </div>

            {{-- CARD 4: CLIENTES ATIVOS --}}
            <div class="stat-card">
                <div class="card-header">
                    <span class="card-title">Clientes Ativos</span>
                    <div class="card-icon"><i class="bi bi-people"></i></div>
                </div>
                <p class="card-value">73</p>
                <span class="card-footer-text">+2 nesta semana</span>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
