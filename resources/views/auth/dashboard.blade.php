<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        main {
            padding: 2rem;
        }
        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 700px;
            margin: 2rem auto;
        }
        .nav-links {
            margin-top: 1rem;
        }
        .nav-links a {
            display: block;
            margin: 0.5rem 0;
            color: #2c3e50;
            text-decoration: none;
            font-weight: bold;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
    </header>

    <main>
        <div class="card">
            <h2>Bienvenido, Administrador</h2>
            <p>Desde aquí puedes gestionar distintas secciones del sistema:</p>

            <div class="nav-links">
                <a href="{{ url('/admin/users') }}">👥 Gestionar Usuarios</a>
                <a href="{{ url('/admin/roles') }}">🔐 Gestionar Roles</a>
                <a href="{{ url('/admin/tareas') }}">🗂️ Gestionar Tareas</a>
                <a href="{{ url('/') }}">🏠 Ir al sitio principal</a>
            </div>
        </div>
    </main>
</body>
</html>
