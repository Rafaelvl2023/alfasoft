<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contatos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background: linear-gradient(to bottom, #d3d3d3, #999999, #c5c5c5);
        }

        .navbar-brand img {
            height: 0px;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .container {
            margin-top: 0px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #343a40;
        }

        table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 0px;
            overflow: hidden;
        }

        table th {
            background: linear-gradient(to bottom, #a0c4ff, #6a9bff, #3e75ff);

            color: white;
            text-align: center;
            font-weight: bold;
        }

        table td {
            text-align: center;
            vertical-align: middle;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .btn {
            font-size: 0.9rem;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination .page-link {
            color: #007bff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #f1f1f1;
            color: #007bff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <img src="https://www.alfasoft.pt/assets/images/logo.png" alt="" class="navbar-brand">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-auto" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('formRegistro') }}">Formulário</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm ml-3" onclick="return confirm('Você deseja sair?')">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-2">
        <h5>Lista de Contatos</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Contato</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contatos as $contato)
                    <tr>
                        <td>{{ $contato->id }}</td>
                        <td>{{ $contato->nome }}</td>
                        <td>{{ $contato->contato }}</td>
                        <td>{{ $contato->email }}</td>
                        <td>
                            <a  class="btn btn-warning btn-sm">Editar</a>
                            <form method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <ul class="pagination">
                {{ $contatos->links('vendor.pagination.bootstrap-4') }}
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
