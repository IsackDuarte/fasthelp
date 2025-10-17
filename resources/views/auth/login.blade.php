<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - FastHelp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* MENTOR'S NOTES: Base do Estilo
     * Reutilizamos a base do tema claro para manter a consistência.
     * O display: flex no body nos ajuda a centralizar o card de login verticalmente e horizontalmente.
    */
    body {
      background-color: #F9FAFB;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }

    /* MENTOR'S NOTES: Card de Login
     * O card é o container principal. Usamos 'box-shadow' para elevá-lo da página,
     * dando profundidade. O 'border-radius' suaviza as bordas. 'max-width' garante
     * que ele não fique excessivamente largo em desktops.
    */
    .login-card {
      background-color: #FFFFFF;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      border: 1px solid #E5E7EB;
      width: 100%;
      max-width: 420px;
    }

    .login-card-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    /* MENTOR'S NOTES: Título com Gradiente
     * Aplicamos EXATAMENTE a mesma classe de gradiente da página inicial
     * ao nome "FastHelp". Isso cria uma conexão visual imediata e reforça a marca.
    */
    .highlight-gradient {
      background: linear-gradient(90deg, #5FEA00, #399400);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-fill-color: transparent;
      font-weight: 700;
      font-size: 2.5rem;
    }

    .login-card-header p {
        color: #6B7280; /* Um cinza neutro para a instrução, não compete com a marca */
    }

    /* MENTOR'S NOTES: Campos do Formulário
     * Um bom UX para formulários significa clareza. Aumentamos a altura (padding)
     * e suavizamos as bordas. O estado ':focus' é crucial: mudamos a cor da borda
     * para o verde principal, dando um feedback claro ao usuário de onde ele está digitando.
    */
    .form-control {
      padding: 0.85rem 1rem;
      border: 1px solid #D1D5DB;
      border-radius: 8px;
    }

    .form-control:focus {
      border-color: #4CBE00;
      box-shadow: 0 0 0 3px rgba(76, 190, 0, 0.15); /* Sombra de foco para acessibilidade */
    }

    /* MENTOR'S NOTES: Botão Principal
     * O botão de "Entrar" deve ser o elemento mais chamativo. Reutilizamos o estilo
     * do botão primário, mas com largura total (width: 100%) para deixar a ação inequívoca.
    */
    .btn-primary {
      background-color: #399400;
      color: #FFFFFF;
      border: none;
      font-weight: bold;
      padding: 0.85rem 1rem;
      border-radius: 8px;
      width: 100%;
      transition: background-color 0.2s ease;
    }

    .btn-primary:hover {
      background-color: #4CBE00;
    }

    /* MENTOR'S NOTES: Links Secundários
     * O link "Esqueci minha senha" é uma ação secundária. Usamos um verde sutil
     * da nossa paleta para que seja clicável, mas sem o peso do botão principal.
    */
    .forgot-password-link {
        display: block;
        text-align: right;
        font-size: 0.875rem;
        color: #276C00;
        text-decoration: none;
    }
    .forgot-password-link:hover {
        text-decoration: underline;
    }

    .signup-link {
        text-align: center;
        margin-top: 1.5rem;
        color: #6B7280;
    }
    .signup-link a {
        color: #399400;
        font-weight: 600;
        text-decoration: none;
    }
    .signup-link a:hover {
        text-decoration: underline;
    }

  </style>
</head>
<body>

  <div class="login-card">
    <div class="login-card-header">
      <h1 class="highlight-gradient">FastHelp</h1>
      <p>Faça login para continuar</p>
    </div>

    <form>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="seu email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" placeholder="" required>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Lembrar de mim</label>
        </div>
        <a href="#" class="forgot-password-link">Esqueci minha senha</a>
      </div>

      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>

    <div class="signup-link">
        Não tem uma conta? <a href="#">Cadastre-se</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
