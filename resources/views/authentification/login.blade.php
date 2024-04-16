<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="background">
        <div class="container">
            <div class="content">
                <h2 class="logo"><img src="{{ asset('images/logo.png') }}" alt=""><b>HydroSentry</b></h2>
                <div class="text">
                    <h2>welcome ! <br> <span> To HydroSentry </span></h2>
                    <q>L'eau : vie , santé, prospérité , précieuse resource.</q>
                    <div class="social-icons">
                        <a href="#"><i class='bx bxl-linkedin'></i></a>
                        <a href="#"><i class='bx bxl-instagram'></i></a>
                        <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>
            </div>
            <div class="logreg-box">
                <div class="form-box">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <h1>Se connecter</h1>
                        
                        <!-- Affichage des erreurs de validation -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-box">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                            </div>
                        @endif
                        
                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-user'></i></span>
                            <input type="text" name="client_id" placeholder="Nom d'utilisateur" required>
                        </div>
                       
                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                            <input type="password" name="password" placeholder="Mot de passe" required>
                        </div>
                        
                        <div class="submit">
                            <input type="submit" value="Se connecter" name="boutton-valide">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
