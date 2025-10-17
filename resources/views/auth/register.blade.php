
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crie sua Conta - FastHelp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

    body {
      background-color: #F9FAFB;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 2rem 0; /* Adicionado padding para melhor visualização em mobile quando o teclado aparece */
    }

    .register-card {
      background-color: #FFFFFF;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      border: 1px solid #E5E7EB;
      width: 100%;
      max-width: 450px; /* Um pouco mais largo para acomodar o formulário maior */
    }

    .register-card-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .highlight-gradient {
      background: linear-gradient(90deg, #5FEA00, #399400);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-fill-color: transparent;
      font-weight: 700;
      font-size: 2.5rem;
    }

    .register-card-header p {
        color: #6B7280;
    }

    .form-control {
      padding: 0.85rem 1rem;
      border: 1px solid #D1D5DB;
      border-radius: 8px;
    }

    .form-control:focus {
      border-color: #4CBE00;
      box-shadow: 0 0 0 3px rgba(76, 190, 0, 0.15);
    }

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

    .terms-text {
        font-size: 0.875rem;
        color: #6B7280;
    }

    .terms-text a {
        color: #399400;
        font-weight: 600;
        text-decoration: none;
    }
    .terms-text a:hover {
        text-decoration: underline;
    }

    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        color: #6B7280;
    }
    .login-link a {
        color: #399400;
        font-weight: 600;
        text-decoration: none;
    }
    .login-link a:hover {
        text-decoration: underline;
    }

  </style>
</head>
<body>

  <div class="register-card">
    <div class="register-card-header">
      <h1 class="highlight-gradient">Crie sua Conta</h1>
      <p>Rápido e fácil, vamos começar.</p>
    </div>

    <form>
      <div class="mb-3">
        <label for="fullName" class="form-label">Nome completo</label>
        <input type="text" class="form-control" id="fullName" placeholder="Seu nome completo" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="voce@exemplo.com" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" placeholder="Mínimo 8 caracteres" required>
      </div>

      <div class="mb-4">
        <label for="confirmPassword" class="form-label">Confirme sua senha</label>
        <input type="password" class="form-control" id="confirmPassword" placeholder="Repita a senha" required>
      </div>

      <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="terms" required>
        <label class="form-check-label terms-text" for="terms">
          Eu li e concordo com os <a href="#">Termos de Serviço</a> e a <a href="#">Política de Privacidade</a>.
        </label>
      </div>

      <button type="submit" class="btn btn-primary">Criar Conta</button>
    </form>

    <div class="login-link">
        Já tem uma conta? <a href="#">Faça login</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
