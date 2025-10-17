<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todos os Chamados - FastHelp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =================================================================
           1. VARIÁVEIS GLOBAIS E CONFIGURAÇÕES DO BODY
        ================================================================= */
        :root {
            --brand-color: #399400;
            --brand-gradient: linear-gradient(90deg, #5FEA00, #399400);
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --bg-color: #F9FAFB;
            --bg-sidebar: #FFFFFF;
            --bg-card: #FFFFFF;
            --hover-color: #F3F4F6;
            --border-color: #E5E7EB;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --sidebar-width-expanded: 260px;
            --sidebar-width-collapsed: 85px;
            --transition-speed: 0.3s;
        }

        body.dark {
            --text-primary: #F9FAFB;
            --text-secondary: #9CA3AF;
            --bg-color: #111827;
            --bg-sidebar: #1F2937;
            --bg-card: #1F2937;
            --hover-color: #374151;
            --border-color: #374151;
        }

        html, body { height: 100%; }

        body {
            display: flex;
            background-color: var(--bg-color);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-primary);
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        /* =================================================================
           2. SIDEBAR
        ================================================================= */
        .sidebar{width:var(--sidebar-width-collapsed);height:100%;background-color:var(--bg-sidebar);border-right:1px solid var(--border-color);display:flex;flex-direction:column;padding:1rem 0;transition:width var(--transition-speed) ease-in-out,background-color var(--transition-speed);position:sticky;top:0;flex-shrink:0;z-index:1030}.sidebar.expanded{width:var(--sidebar-width-expanded)}.sidebar-header{display:flex;align-items:center;justify-content:space-between;padding:0 1.5rem;margin-bottom:2rem;min-height:48px}.sidebar:not(.expanded) .sidebar-header{justify-content:center;padding:0}.logo{font-size:1.75rem;font-weight:700;background:var(--brand-gradient);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;white-space:nowrap;opacity:0;width:0;transition:opacity .2s,width .2s;overflow:hidden}.sidebar.expanded .logo{opacity:1;width:auto;margin-right:1rem}.sidebar-toggle{background:0 0;border:none;color:var(--text-secondary);font-size:1.5rem;cursor:pointer;padding:.5rem;border-radius:50%;transition:transform var(--transition-speed),background-color .2s;flex-shrink:0}.sidebar-toggle:hover{background-color:var(--hover-color)}.sidebar.expanded .sidebar-toggle{transform:rotate(180deg)}.nav-menu{flex-grow:1}.sidebar-footer{margin-top:auto}.nav-link{display:flex;align-items:center;height:56px;color:var(--text-secondary);font-weight:500;text-decoration:none;white-space:nowrap;border-radius:28px;margin:.25rem 1rem;padding:0 1.5rem;transition:background-color .2s,color .2s}.nav-link:hover{background-color:var(--hover-color);color:var(--text-primary)}.nav-link.active{color:#fff;background-color:var(--brand-color)}.nav-link.active .bi{color:#fff}.sidebar:not(.expanded) .nav-link{display:grid;place-items:center;padding:0;margin:.25rem auto;width:50px;height:50px;border-radius:50%}.sidebar:not(.expanded) .nav-text{display:none}.sidebar:not(.expanded) .nav-link .bi{margin-right:0}.nav-link .bi{font-size:1.25rem;color:var(--brand-color);transition:margin-right var(--transition-speed) ease-in-out,color .2s}.sidebar.expanded .nav-link .bi{margin-right:1.5rem}.nav-text{opacity:0;width:0;transition:opacity .2s,width .2s}.sidebar.expanded .nav-text{opacity:1;width:auto}

        /* =================================================================
           3. CONTEÚDO PRINCIPAL E COMPONENTES GERAIS
        ================================================================= */
        .main-content {
            flex-grow: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }
        .btn-brand {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
            color: #fff;
        }
        .btn-brand:hover {
            background-color: #2d7a00;
            border-color: #2d7a00;
            color: #fff;
        }
        .card {
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            box-shadow: var(--shadow-sm);
            border-radius: 12px;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, border-color var(--transition-speed), background-color var(--transition-speed);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        /* =================================================================
           4. DARK MODE E ESTILOS DE COMPONENTES ESPECÍFICOS
        ================================================================= */

        /* Tabela no Dark Mode */
        body.dark .table th,
        body.dark .table td {
            background-color: transparent !important;
            color: var(--text-primary);
            border-color: var(--border-color) !important;
        }
        body.dark .card-header { color: var(--text-primary); }
        body.dark .table-hover > tbody > tr:hover {
            background-color: rgba(255, 255, 255, 0.075);
            color: var(--text-primary);
        }
        body.dark .table .btn-outline-secondary{color:#a0aec0;border-color:#4a5568}
        body.dark .table .btn-outline-secondary:hover{background-color:#4a5568;color:#e2e8f0}
        body.dark .badge.bg-success{background-color:#2F855A!important;color:#F0FFF4!important}
        body.dark .badge.bg-danger{background-color:#C53030!important;color:#FFF5F5!important}
        body.dark .badge.bg-warning.text-dark{background-color:#D69E2E!important;color:#1A202C!important}

        /* =================================================================
           5. ESTILOS DA PÁGINA/MODAL DE DETALHES DO CHAMADO
        ================================================================= */
        .ticket-thread .thread-item{display:flex;gap:1rem;margin-bottom:2rem}.ticket-thread .post-avatar{font-size:2rem;color:var(--brand-color)}.ticket-thread .post-content{flex:1}.ticket-thread .post-header{margin-bottom:.5rem;font-size:.875rem}.ticket-thread .post-body{padding:1rem;border-radius:8px;background-color:#f8f9fa}.ticket-thread .agent-post .post-body{background-color:#e6f3e6;border-left:3px solid var(--brand-color)}.is-internal-note{background-color:#fffbe6;border:1px solid #ffe58f;padding:.75rem;border-radius:6px;font-size:.875rem;margin-top:1rem}.is-internal-note i{color:#f59e0b;margin-right:.5rem}.details-list .details-item{display:flex;justify-content:space-between;align-items:center;padding:.75rem 0;border-bottom:1px solid var(--border-color)}.details-list .details-item:last-child{border-bottom:none}.details-list span{color:var(--text-secondary)}body.dark .ticket-thread .post-body{background-color:#2c3546}body.dark .ticket-thread .agent-post .post-body{background-color:#223722}body.dark .is-internal-note{background-color:#4a4128;border-color:#a17d3b}body.dark .details-list .details-item{border-bottom-color:var(--border-color)}

        /* =================================================================
           6. ESTILOS DO MODAL
        ================================================================= */
        body.dark .modal-content{background-color:#2d3748;border-color:var(--border-color)}body.dark .modal-header,body.dark .modal-footer{border-color:var(--border-color)}body.dark .form-control,body.dark .form-select{background-color:#1a202c;color:var(--text-primary);border-color:var(--border-color)}body.dark .form-control:focus,body.dark .form-select:focus{background-color:#1a202c;color:var(--text-primary);border-color:var(--brand-color);box-shadow:0 0 0 .25rem rgba(57,148,0,.25)}body.dark .btn-close{filter:invert(1) grayscale(100) brightness(200%)}
    </style>
</head>
<body>

    {{-- Componente da Sidebar --}}
    <x-side.menu />
    
    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Todos os Chamados</h1>
            <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modalCriarChamado">
                <i class="bi bi-plus-circle-fill me-2"></i>Novo Chamado
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Opa!</strong> Algo deu errado com sua última ação:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card">
            <div class="card-header bg-transparent border-0 py-3">
                <h5 class="mb-0">Histórico de Chamados</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Assunto</th>
                                <th>Status</th>
                                <th>Prioridade</th> 
                                <th>Usuário</th>
                                <th class="pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chamados as $chamado)
                                <tr>
                                    <td class="ps-4 fw-bold">#{{ $chamado->id }}</td>
                                    <td>{{ $chamado->assunto }}</td>
                                    <td>
                                        @php
                                            $statusValue = $chamado->status instanceof \App\Models\ChamadoStatus ? $chamado->status->value : $chamado->status;
                                        @endphp
                                        @if ($statusValue == 'concluido')
                                            <span class="badge bg-success rounded-pill">Concluído</span>
                                        @elseif ($statusValue == 'em_andamento')
                                            <span class="badge bg-warning text-dark rounded-pill">Em Andamento</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill">{{ ucfirst($statusValue) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $prioridadeValue = $chamado->prioridade instanceof \App\Models\ChamadoPrioridade ? $chamado->prioridade->value : $chamado->prioridade;
                                        @endphp
                                        <span class="text-capitalize">{{ $prioridadeValue }}</span>
                                    </td>
                                    <td>{{ $chamado->user->name ?? 'N/A' }}</td>
                                    <td class="pe-4">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-secondary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalVerChamado"
                                                data-url="{{ route('chamados.getJsonData', $chamado) }}">
                                            Ver
                                        </button>
                                        <form action="{{ route('chamados.destroy', $chamado->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    data-bs-toggle="tooltip" title="Excluir"
                                                    onclick="return confirm('Tem certeza?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-4">Nenhum chamado encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-center">
                    {{ $chamados->links() }}
                </div>
                
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalCriarChamado" tabindex="-1" aria-labelledby="modalCriarChamadoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title" id="modalCriarChamadoLabel">Criar Novo Chamado</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <form id="formCriarChamado" action="{{ route('chamados.store') }}" method="POST">
                    @csrf 
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="chamadoAssunto" class="form-label">Assunto</label>
                            <input type="text" class="form-control" id="chamadoAssunto" name="assunto" placeholder="Ex: Computador não liga" required value="{{ old('assunto') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="chamadoCategoria" class="form-label">Categoria</label>
                                <select class="form-select" id="chamadoCategoria" name="categoria" required>
                                    <option selected disabled value="">Selecione...</option>
                                    <option value="hardware" @selected(old('categoria') == 'hardware')>Hardware</option>
                                    <option value="software" @selected(old('categoria') == 'software')>Software</option>
                                    <option value="rede" @selected(old('categoria') == 'rede')>Rede</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="chamadoPrioridade" class="form-label">Prioridade</label>
                                <select class="form-select" id="chamadoPrioridade" name="prioridade" required>
                                    <option selected disabled value="">Selecione...</option>
                                    <option value="baixa" @selected(old('prioridade') == 'baixa')>Baixa</option>
                                    <option value="media" @selected(old('prioridade') == 'media')>Média</option>
                                    <option value="alta" @selected(old('prioridade') == 'alta')>Alta</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="chamadoDescricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="chamadoDescricao" name="descricao" rows="4" placeholder="Descreva o problema...">{{ old('descricao') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-brand">Criar Chamado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVerChamado" tabindex="-1" aria-labelledby="modalVerChamadoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVerChamadoLabel">Carregando...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="ticket-thread"><div class="text-center p-5"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div></div></div>
                            <hr class="my-4">
                            <div class="reply-box">
                                <h5 class="mb-3">Adicionar uma Resposta</h5>
                                <form id="formResponderChamado" method="POST">
                                    @csrf 
                                    <div class="mb-3"><textarea class="form-control" id="chamadoResposta" name="mensagem" rows="5" placeholder="Digite sua resposta..." required></textarea></div>
                                    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-brand">Enviar Resposta</button></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-none">
                                <div class="card-header"><h5 class="mb-0">Detalhes do Chamado</h5></div>
                                <div class="card-body">
                                    <div class="details-list">Carregando...</div>
                                    <hr>
                                    <form id="formResolverChamado" method="POST" class="d-grid gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="concluido">
                                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill me-2"></i> Marcar como Resolvido</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Seletores de elementos
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');
            const themeToggle = document.getElementById('theme-toggle');
            const body = document.body;

            // --- 1. LÓGICA DA SIDEBAR E TOOLTIPS ---
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipInstances = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl); });
            
            function handleTooltips() { 
                if (!sidebar) return; 
                const isExpanded = sidebar.classList.contains('expanded'); 
                const toggleButtonTooltip = bootstrap.Tooltip.getInstance(toggleButton); 
                tooltipInstances.forEach(tooltip => { 
                    if (tooltip._element.id !== 'sidebar-toggle') { 
                        isExpanded ? tooltip.disable() : tooltip.enable(); 
                    } 
                }); 
                if (toggleButtonTooltip) { 
                    toggleButton.setAttribute('data-bs-original-title', isExpanded ? 'Recolher' : 'Expandir'); 
                    toggleButtonTooltip.update(); 
                } 
            }
            
            if (toggleButton) { 
                toggleButton.addEventListener('click', () => { 
                    sidebar.classList.toggle('expanded'); 
                    setTimeout(handleTooltips, 150); 
                    localStorage.setItem('sidebarState', sidebar.classList.contains('expanded') ? 'expanded' : 'collapsed'); 
                }); 
            }
            
            function applySidebarState() { 
                if (localStorage.getItem('sidebarState') === 'expanded') { 
                    sidebar.classList.add('expanded'); 
                } 
            }

            // --- 2. LÓGICA DO MODO ESCURO ---
            if (themeToggle) { 
                const icon = themeToggle.querySelector('i'); 
                const themeText = themeToggle.querySelector('.nav-text'); 
                const applySavedTheme = () => { 
                    const savedTheme = localStorage.getItem('theme'); 
                    if (savedTheme === 'dark') { 
                        body.classList.add('dark'); 
                        icon.classList.replace('bi-moon-fill', 'bi-sun-fill'); 
                        if (themeText) themeText.textContent = 'Modo Claro'; 
                    } else { 
                        body.classList.remove('dark'); 
                        icon.classList.replace('bi-sun-fill', 'bi-moon-fill'); 
                        if (themeText) themeText.textContent = 'Modo Escuro'; 
                    } 
                }; 
                themeToggle.addEventListener('click', (e) => { 
                    e.preventDefault(); 
                    body.classList.toggle('dark'); 
                    if (body.classList.contains('dark')) { 
                        localStorage.setItem('theme', 'dark'); 
                        icon.classList.replace('bi-moon-fill', 'bi-sun-fill'); 
                        if (themeText) themeText.textContent = 'Modo Claro'; 
                    } else { 
                        localStorage.setItem('theme', 'light'); 
                        icon.classList.replace('bi-sun-fill', 'bi-moon-fill'); 
                        if (themeText) themeText.textContent = 'Modo Escuro'; 
                    } 
                }); 
                applySavedTheme(); 
            }
            
            // --- 3. LÓGICA DO MODAL DE VISUALIZAÇÃO DE CHAMADO (AJAX) ---
            const viewTicketModal = document.getElementById('modalVerChamado');
            if (viewTicketModal) {
                const modalTitle = viewTicketModal.querySelector('.modal-title');
                const ticketThread = viewTicketModal.querySelector('.ticket-thread');
                const detailsList = viewTicketModal.querySelector('.details-list');
                const formResponder = viewTicketModal.querySelector('#formResponderChamado');
                const formResolver = viewTicketModal.querySelector('#formResolverChamado');
                const spinner = `<div class="text-center p-5"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div></div>`;

                viewTicketModal.addEventListener('show.bs.modal', async function (event) {
                    const button = event.relatedTarget;
                    const url = button.dataset.url;

                    modalTitle.textContent = 'Carregando...';
                    ticketThread.innerHTML = spinner;
                    detailsList.innerHTML = 'Carregando...';
                    formResponder.action = '#'; 
                    formResolver.action = '#';
                    formResolver.style.display = 'none'; 

                    try {
                        const response = await fetch(url);
                        if (!response.ok) { throw new Error('Falha ao carregar os dados.'); }
                        const data = await response.json();
                        
                        modalTitle.textContent = `#${data.id} - ${data.assunto}`;
                        detailsList.innerHTML = `
                            <div class="details-item"><span>Status</span><strong>${data.status_label}</strong></div>
                            <div class="details-item"><span>Prioridade</span><strong>${data.prioridade_label}</strong></div>
                            <div class="details-item"><span>Categoria</span><strong>${data.categoria_label}</strong></div>
                            <div class="details-item"><span>Solicitante</span><strong>${data.user.name}</strong></div>
                            <div class="details-item"><span>Responsável</span><strong>${data.agent ? data.agent.name : 'N/A'}</strong></div>
                        `;

                        ticketThread.innerHTML = ''; 
                        if(data.respostas.length === 0) {
                            ticketThread.innerHTML = '<p class="text-center text-muted">Nenhum histórico de conversa encontrado.</p>';
                        } else {
                            data.respostas.forEach(post => {
                                const postClass = post.is_agent ? 'agent-post' : 'user-post';
                                const postIcon = post.is_agent ? 'bi-headset' : 'bi-person-circle';
                                ticketThread.innerHTML += `
                                    <div class="thread-item ${postClass}">
                                        <div class="post-avatar"><i class="bi ${postIcon}"></i></div>
                                        <div class="post-content">
                                            <div class="post-header">
                                                <strong>${post.user.name}</strong> 
                                                <span class="text-muted ms-2">${post.created_at_human}</span>
                                            </div>
                                            <div class="post-body">
                                                <p style="white-space: pre-wrap;">${post.mensagem}</p>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                        }

                        formResponder.action = data.urls.responder_url;
                        formResolver.action = data.urls.resolver_url;
                        
                        if (data.status !== 'concluido') {
                            formResolver.style.display = 'block';
                        }
                    } catch (error) {
                        console.error(error);
                        modalTitle.textContent = 'Erro';
                        ticketThread.innerHTML = '<p class="text-danger">Não foi possível carregar os dados do chamado.</p>';
                    }
                });

                viewTicketModal.addEventListener('hidden.bs.modal', function() {
                    formResponder.reset();
                });
            }

            // --- 4. INICIALIZAÇÃO ---
            applySidebarState();
            handleTooltips();
        });
    </script>
</body>
</html>