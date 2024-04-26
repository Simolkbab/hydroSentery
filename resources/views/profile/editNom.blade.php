<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="stylesheet" href="{{ asset('css/EditEmailStyle.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
</head>
<body>
  <div class="GoProfil">
    <a href="{{ route('show') }}" >
       <i class="fa-solid fa-backward"></i>
      <span class="text nav-text ">Revenir a votre profil</span>                                                   
    </a>
  </div>
  <div class="main">
    
    <div class="signup">
      <form action="{{ route('UpdateNom') }}" method="POST">
          <label for="chk" aria-hidden="true" class="title">Modifier le nom de Client</label>
          @csrf
          @method('PATCH')
          <div>
            <label for="password">Mot de passe actuel:</label>
            <input type="password" name="password" id="password" required>  
          </div>
          <div>
            <label for="current_name">Ancien Nom:</label>
            <input type="text" name="current_name" id="current_name" required>
          </div>
          <div>
            <label for="nomClient">Nouvel Nom:</label>
            <input type="text" id="nomClient" name="nomClient" value="{{ old('nomClient') }}" required>
          </div>
          <div>
            <label for="confirm_name">Confirmer Nom:</label>
            <input type="text" name="confirm_name" id="confirm_name" required>
          </div>
          <button type="submit">Mettre à jour</button>
        </form>
        
        @if ($errors->any())
        <div class="erreur">
                @foreach ($errors->all() as $error)
                    <b>{{ $error }}</b>
                @endforeach
        </div>
        @endif

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        @if(session('success'))
            <p style="color: green;">{{ session('success') }} <i class='bx bxs-check-circle'></i></p>
        @endif
    </div> 
 </div>
</body>
</html>