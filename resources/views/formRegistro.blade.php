<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário de Cadastro de Contato</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="https://www.alfasoft.pt/assets/images/logo.png" alt="" class="navbar-brand">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-auto" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminContatos') }}">Contatos</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container col-md-4 mt-5 border border-dark rounded">
        <h3 class="text-center mb-4">Cadastrar novo contacto</h3>
        <form action="{{ route('contatos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome"
                    name="nome" value="{{ old('nome') }}" required>
            </div>
            <div class="form-group">
                <label for="contato">Contacto</label>
                <input type="text" class="form-control @error('contato') is-invalid @enderror" id="contato"
                    name="contato" value="{{ old('contato') }}" required>
                <small class="form-text text-muted">Formato: XXXXXXXXX</small>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-3">Cadastrar Contacto</button>
        </form>

        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertMessage">
            {{ session('status') }}
        </div>
        @elseif($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertMessage">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        @if(session('status'))
            setTimeout(function() {
                $('#alertMessage').fadeOut('slow');
            }, 5000);
        @endif
    </script>
</body>

</html>
