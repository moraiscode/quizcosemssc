<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo SweetAlert2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="text-center">
        <h1 class="mb-4">Exemplo SweetAlert2</h1>
        <button class="btn btn-primary" onclick="exibirAlerta()">Clique aqui</button>
    </div>

    <script>
        function exibirAlerta() {
            Swal.fire({
                icon: 'success',
                title: 'Alerta SweetAlert2',
                text: 'Este é um exemplo simples!',
                confirmButtonText: 'OK'
            });
        }
    </script>
    <script>
        Swal.fire({
                icon: 'success',
                title: 'Alerta SweetAlert2',
                text: 'Este é um exemplo simples!',
                confirmButtonText: 'OK'
            });
    </script>
</body>
</html>
