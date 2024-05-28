<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
            display: flex;
            background: url("../images/background.jpg") no-repeat center center;
            background-size: cover;
        }

        .container {
            background-size: cover;
            width: 90%;
            height: 100vh;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border: 1px solid transparent;
        }

        .table th, .table td {
    vertical-align: middle;
    text-align: center;
}
.float-right {
    float: right !important;
    margin-bottom: 20px !important;
}

        .btn {
            margin-right: 5px;
        }

        .alert-success {
            margin-top: 20px;
        }

        .Title {
            margin-bottom: 20px;
        }

        .btn-edit {
    background-color: #4CAF50; /* Green shade */
    border-color: #4CAF50;
    color: white;
}

.btn-delete {
    background-color: #ef4444; /* Red shade */
 
    color: white;
}

.btn-add {
    background-color: #0284c7; /* Blue shade */
    color: white;
}

.btn:hover {
    opacity: 0.8;
}
    </style>
    <script>
        $(document).ready(function() {
            $('.delete-client').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var clientName = $(this).data('name');
                if (confirm('Êtes-vous sûr de vouloir supprimer le client ' + clientName + '?')) {
                    form.submit();
                }
            });
        });


    </script>
</head>

<body>
    <div class="container">
        <h1 class="Title">Liste des Clients</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <a href="{{ route('clients.create') }}" class="btn btn-add mb-3 float-right">
            <i class="fas fa-user-plus"></i> Ajouter un client
        </a>
        
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->client_id }}</td>
                    <td>{{ $client->nomClient }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete delete-client" data-name="{{ $client->nomClient }}">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
