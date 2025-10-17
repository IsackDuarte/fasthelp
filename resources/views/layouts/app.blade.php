<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- O @yield('title') permitirá que cada página defina seu próprio título --}}
    <title>@yield('title', 'FastHelp')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            /* SUAS CORES E FONTES */
            --brand-color: #399400;
            --brand-gradient: linear-gradient(90deg, #5FEA00, #399400 );
            --text-color: #4B5563;
            --bg-color: #FFFFFF;
            --bg-color-sidebar: #F9FAFB;
            --hover-color: #F0F4F9;
            --border-color: #E5E7EB;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);

            /* LAYOUT SIZES */
            --sidebar-width-expanded: 260px;
            --sidebar-width-collapsed: 85px;
            --transition-speed: 0.3s;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-color);
            display: flex;
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width-collapsed);
            height: 100vh;
            background-color: var(--bg-color-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            transition: width var(--transition-speed) ease-in-out;
            padding: 1rem 0;
        }
        .sidebar.expanded {
            width: var(--sidebar-width-expanded);
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            margin-bottom: 2rem;
            min-height: 48px;
        }
        .sidebar:not(.expanded) .sidebar-header {
            justify-content: center;
            padding: 0;
        }
        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease-in-out, width 0.2s ease-in-out;
            width: 0;
            overflow: hidden;
        }
        .sidebar.expanded .logo {
            opacity: 1;
            width: auto;
            margin-right: 1rem;
        }
        .sidebar-toggle {
            background: none; border: none; color: var(--text-color); font-size: 1.5rem; cursor: pointer; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: transform var(--transition-speed) ease, background-color 0.2s; flex-shrink: 0;
        }
        .sidebar-toggle:hover { background-color: var(--hover-color); }
        .sidebar.expanded .sidebar-toggle { transform: rotate(180deg); }
        .nav-menu { flex-grow: 1; }
        .sidebar-footer { margin-top: auto; }
        .nav-link { display: flex; align-items: center; height: 56px; color: var(--text-color); font-weight: 500; text-decoration: none; white-space: nowrap; border-radius: 28px; margin: 0.25rem 1rem; padding: 0 1.5rem; transition: background-color 0.2s; }
        .nav-link:hover { background-color: var(--hover-color); }
        .nav-link.active { color: #fff; background-color: var(--brand-color); }
        .nav-link.active .bi { color: #fff; }
        .sidebar:not(.expanded) .nav-link { display: grid; place-items: center; padding: 0; margin: 0.25rem auto; width: 50px; height: 50px; border-radius: 50%; overflow: hidden; }
        .nav-link .bi { font-size: 1.25rem; min-width: 24px; color: var(--brand-color); transition: margin-right var(--transition-speed) ease-in-out; }
        .sidebar.expanded .nav-link .bi { margin-right: 1.5rem; }
        .nav-link .nav-text { opacity: 0; width: 0; transition: opacity 0.2s ease-in-out, width 0.2s ease-in-out; }
        .sidebar.expanded .nav-text { opacity: 1; width: auto; }

        /* --- CONTEÚDO PRINCIPAL --- */
        .main-content {
            flex-grow: 1;
            padding: 2.5rem;
            margin-left: var(--sidebar-width-collapsed);
            transition: margin-left var(--transition-speed) ease-in-out;
        }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .highlight-gradient { background: var(--brand-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; }
        .btn-custom-green { background-color: var(--brand-color); border-color: var(--brand-color); color: #fff; font-weight: 600; padding: 0.6rem 1.25rem; border-radius: 0.5rem; transition: all 0.2s ease; }
        .btn-custom-green:hover { background-color: #2d7a00; border-color: #2d7a00; color: #fff; transform: translateY(-px); box-shadow: var(--shadow-md); }

        /* --- ESTILO DOS CARDS E TABELAS --- */
        .card {
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            border-radius: 0.75rem;
        }
        .table {
            margin-bottom: 0; /* Remove a margem padrão da tabela dentro do card */
        }

        /* --- ESTILO DOS TOOLTIPS --- */
        .tooltip-inner { background-color: #1F2937; color: #fff; padding: 0.4rem 0.8rem; border-radius: 0.4rem; font-size: 0.875rem; box-shadow: var(--shadow-md); }
        .tooltip.bs-tooltip-end .tooltip-arrow::before, .tooltip.bs-tooltip-right .tooltip-arrow::before { border-right-color: #1F2937; }
    </style>
</head>
<body>

    {{-- A sidebar agora faz parte do layout principal --}}
    @include('components.side.menu') {{-- Ou cole o HTML da sidebar aqui diretamente --}}

    {{-- O conteúdo de cada página será injetado aqui --}}
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');

            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipInstances = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            function handleTooltips() {
                const toggleButtonTooltip = bootstrap.Tooltip.getInstance(toggleButton);
                if (sidebar.classList.contains('expanded')) {
                    tooltipInstances.forEach(tooltip => {
                        if (tooltip._element.id !== 'sidebar-toggle') { tooltip.disable(); }
                    });
                    toggleButton.setAttribute('data-bs-original-title', 'Recolher');
                    toggleButtonTooltip?.update();
                } else {
                    tooltipInstances.forEach(tooltip => tooltip.enable());
                    toggleButton.setAttribute('data-bs-original-title', 'Expandir');
                    toggleButtonTooltip?.update();
                }
            }
            handleTooltips();

            if (toggleButton) {
                toggleButton.addEventListener('click', () => {
                    sidebar.classList.toggle('expanded');
                    handleTooltips();
                });
            }
        });
    </script>
</body>
</html>
