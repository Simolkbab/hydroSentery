<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HydroSentry</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    </head>
<body >

    <nav class="sidebar ">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </span>
                <div class="text header-text">
                    <span class="name"><h1>HydroSentry</h1></span>
                </div>
            </div>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link"> 
                            <a href="{{ route('index') }}" >
                                <i class='bx bxs-home icon' ></i> 
                                <span class="text nav-text ">Home</span>
                            </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('consult') }}">
                            <i class='bx bxs-data icon' ></i>
                            <span class="text nav-text"> Visualisée Données</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('history') }}">
                            <i class='bx bx-history icon' ></i>
                            <span class="text nav-text">Consulter Historique</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('show') }}" class="profile">
                            <i class='bx bxs-user icon' ></i>
                            <span class="text nav-text">Profil utilisateur</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('notification') }}">
                            <i class='bx bxs-bell icon' ></i>
                            <span class="text nav-text">Notification</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="AI-RS.pdf" download="file.pdf">
                            <i class='bx bxs-file-doc icon' ></i>
                            <span class="text nav-text">Guide</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="#" onclick="confirmLogout()">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Déconnexion</span>
                    </a>
                </li>
            </div>
        </div>
        
    </nav>
    <section class="body">
       
    <h1 class="pro"><span class="ph">photo de</span> profil</h1>
  <main>
    <section class="photo-profil">
        <img src="{{ asset('storage/' . $user->photo_path) }}" id="profile-image" alt="Photo de profil">
        <div class="button-container">
            <form id="delete-profile-image-form" action="{{ route('delete-profile-image') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" id="supprimer-photo" onclick="confirmDelete()">Supprimer la photo</button>
            </form>
            <div>
                <form id="update-profile-image-form" action="{{ route('update-profile-image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="file" name="profile_image" accept="image/*" id="profile-image-input">
                </form>
                @error('profile_image')
                <p class="error-message">
                    {{ $message }}
                </p>
            </div>
           
            @enderror
        </div>
    </section>
    
    
   
    <section class="informations">
      <ul>
        <hr>
        <li>
          <label for="email">Adresse mail</label>
          <input type="email" id="email" value="{{ $user->email }}">
          <button id="modifier-email"> <a href="{{ route('editEmail') }}">Modifier</a></button>
        </li>
        <hr>
        <li>
          <label for="telephone">Numéro de téléphone</label>
          <input type="tel" id="telephone" value="{{ $user->telephone }}">
          <button id="modifier-telephone"><a href="{{ route('ediTelephone') }}">Modifier</a></button>
        </li>
        <hr>
        <li>
            
          <label for="identifiant">Nom d'utilisateur (IDCLIENT)</label>
          <input type="text" id="identifiant" value="{{ $user->client_id }}">
          <button id="modifier-identifiant" disabled>non cliquable</button>
        </li>
        <hr>
        <li>
            <label for="password">mot de passe</label>
            <input type="password" id="password" value="{{ $user->password }}">
            <button id="modifier-password"><a href="{{ route('editPassword') }}">Modifier</a></button>        </li>
      </ul>
    </section>
  </main>
    </section>
   
</body>

<script>
    document.getElementById('profile-image-input').addEventListener('change', function() {
        document.getElementById('update-profile-image-form').submit();
    });

    function confirmLogout() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "{{ route('logout') }}";
        }
    }
    function confirmDelete() {
        if (confirm("Are you sure you want to delete the profile image?")) {
            document.getElementById('delete-profile-image-form').submit();
        }
    }
</script>
</html>