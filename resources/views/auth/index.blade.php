<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TaskMaster - Plataforma de Tareas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    :root {
      --color-naranja: #ff6b00;
      --color-azul: #1e3a8a;
      --color-verde: #10b981;
      --color-fondo: #f0f4f8;
      --color-texto: #1f2937;
      --color-card: #ffffff;
    }

    body {
      background-color: var(--color-fondo);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--color-texto);
    }

    .navbar {
      background: linear-gradient(90deg, var(--color-naranja), var(--color-azul));
      padding: 15px 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .navbar h1 {
      color: #fff;
      font-weight: bold;
      font-size: 2rem;
      margin: 0;
    }

    .login-button {
      background-color: #fff;
      color: var(--color-naranja);
      padding: 10px 25px;
      border-radius: 25px;
      font-weight: 600;
      border: none;
      transition: 0.3s;
      text-decoration: none;
    }

    .login-button:hover {
      background-color: var(--color-verde);
      color: white;
    }

    .hero {
      background: linear-gradient(135deg, var(--color-azul), var(--color-naranja));
      color: white;
      padding: 100px 20px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero h1 {
      font-size: 3em;
      font-weight: bold;
    }

    .hero img {
      height: 70px;
      margin-left: 10px;
      vertical-align: middle;
    }

    .hero p {
      font-size: 1.3rem;
      margin-top: 20px;
    }

    .hero .btn-primary {
      margin-top: 30px;
      background-color: white;
      color: var(--color-azul);
      padding: 12px 28px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 30px;
      border: none;
      transition: 0.3s ease;
    }

    .hero .btn-primary:hover {
      background-color: var(--color-verde);
      color: white;
    }

    .features {
      padding: 80px 20px;
    }

    .feature {
      background: var(--color-card);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
      transition: 0.4s ease;
      text-align: center;
    }

    .feature:hover {
      transform: scale(1.05);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .feature i {
      font-size: 2.8em;
      margin-bottom: 15px;
      color: var(--color-verde);
    }

    .testimonials {
      background-color: #fff;
      padding: 80px 20px;
    }

    .testimonial {
      font-style: italic;
      font-size: 1.1rem;
      max-width: 700px;
      margin: 0 auto 50px auto;
      color: #555;
    }

    .testimonial span {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      color: var(--color-naranja);
    }

    .cta {
      background: linear-gradient(90deg, var(--color-verde), var(--color-naranja));
      color: white;
      padding: 80px 20px;
      text-align: center;
    }

    .cta .btn-light {
      background-color: #fff;
      color: var(--color-verde);
      padding: 12px 28px;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 30px;
      border: none;
      transition: 0.3s ease;
    }

    .cta .btn-light:hover {
      background-color: var(--color-azul);
      color: #fff;
    }

    footer {
      background-color: #1f2937;
      color: #ccc;
      padding: 60px 20px;
      text-align: center;
    }

    footer h2 {
      color: #fff;
      margin-bottom: 30px;
    }

    footer i {
      color: var(--color-verde);
    }

    footer p {
      margin: 10px 0;
    }
  </style>
</head>
<body>

  <header>
    <div class="navbar d-flex justify-content-between align-items-center">
      <h1>TaskMaster</h1>
      <a href="{{ route('login') }}" class="login-button">Iniciar Sesión</a>
    </div>
  </header>

  <section class="hero">
    <h1>Organiza tu Vida con TaskMaster <img src="{{ asset('images/TaskMaster-logo.png') }}" alt="TaskMaster Logo"/></h1>
    <p>Gestiona tus tareas de manera eficiente y colabora con tu equipo sin esfuerzo.</p>
    <a href="{{ route('register') }}" class="btn btn-primary">Regístrate Gratis</a>
  </section>

  <section class="container features">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature">
          <i class="fas fa-tasks"></i>
          <h3>Gestión de Tareas</h3>
          <p>Organiza, prioriza y mantén el control de tus tareas diarias con facilidad.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature">
          <i class="fas fa-users-cog"></i>
          <h3>Trabajo en Equipo</h3>
          <p>Comparte tus proyectos y coordina responsabilidades con tu equipo.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature">
          <i class="fas fa-chart-pie"></i>
          <h3>Panel de Progreso</h3>
          <p>Visualiza el estado de tus tareas en un solo lugar y mejora tu productividad.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials">
    <h2>Lo que dicen nuestros usuarios</h2>
    <div class="testimonial">
      “Desde que uso TaskMaster, mis días son mucho más organizados y productivos.”
      <span>- Laura M., Project Manager</span>
    </div>
    <div class="testimonial">
      “Mi equipo y yo colaboramos sin perder tiempo. ¡Excelente plataforma!”
      <span>- Carlos G., Desarrollador</span>
    </div>
  </section>

  <section class="cta">
    <h2>¿Listo para transformar tu productividad?</h2>
    <p>Únete a cientos de usuarios que ya organizan sus tareas con TaskMaster.</p>
    <a href="{{ route('register') }}" class="btn btn-light">Comienza Ahora</a>
  </section>

  <footer>
    <h2>Contáctanos</h2>
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4">
        <i class="fas fa-phone fa-2x"></i>
        <h5>Teléfono</h5>
        <p>+57 321 239 8851</p>
      </div>
      <div class="col-md-4 mb-4">
        <i class="fas fa-envelope fa-2x"></i>
        <h5>Correo Electrónico</h5>
        <p>taskmaster962@gmail.com</p>
      </div>
    </div>
    <p class="mt-4">&copy; 2025 TaskMaster. Todos los derechos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
