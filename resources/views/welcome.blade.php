<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-vindo ao FastHelp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #F9FAFB;
      color: #174600;
      font-family: 'Segoe UI', sans-serif;
    }

    .hero {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .highlight-gradient {

      background: linear-gradient(90deg, #5FEA00, #399400);

      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-fill-color: transparent;
      font-weight: 700;
    }

    .lead {
      color: #276C00;
      max-width: 600px;
    }

    .btn-primary {
      background-color: #399400;
      color: #FFFFFF;
      border: none;
      font-weight: bold;
      padding: 12px 28px;
      transition: transform 0.2s ease;
    }

    .btn-primary:hover {
      background-color: #4CBE00;
      transform: translateY(-2px); /* Efeito sutil de elevação */
    }

    .btn-outline-custom {
      color: #399400;
      border-color: #399400;
      font-weight: bold;
      padding: 12px 28px;
    }

    .btn-outline-custom:hover {
      background-color: #399400;
      color: #FFFFFF;
    }
  </style>
</head>
<body>

  <div class="hero container">
    <h1 class="display-3 mb-3 highlight-gradient">
      Bem-vindo ao FastHelp!
    </h1>
    <p class="lead mb-4">Inclua o FastHelp na sua empresa e transforme a experiência dos seus colaboradores. Mais rapidez, mais eficiência!</p>
    <div>
      <a href="#" class="btn btn-primary btn-lg me-2">Saiba Mais</a>
      <a href="#" class="btn btn-outline-custom btn-lg">Começar Agora</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

