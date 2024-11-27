<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            text-align: center;
            margin-top: 15px;
            color: #555;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            margin-top: 10px;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div>
        <h1>Cadastro</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Senha:</label>
            <input type="password" name="password" required>
            <label>Confirme a Senha:</label>
            <input type="password" name="password_confirmation" required>
            <button type="submit">Cadastrar</button>

            <div class="message-container">
                @if ($errors->any())
                    <div class="message error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </form>
        <p>Já tem uma conta? <a href="{{ route('login.form') }}">Faça login</a></p>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const messageContainer = document.querySelector('.message-container');
            const message = document.querySelector('.message');

            if (message) {
                setTimeout(function () {
                    message.style.transition = 'opacity 1s ease-out';
                    message.style.opacity = '0';

                    setTimeout(function () {
                        messageContainer.removeChild(message);
                    }, 1000);
                }, 5000);
            }
        });
    </script>
</body>

</html>
