<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="{{ asset('images/logo.png') }}" width="70px" >
                        </span>
                        <span class="title title0" >HydroSentry</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('index') }}" >
                        <span class="icon "><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Accueil</span>
                        

                    </a>
                </li>
                <li class="pg1">
                    <a href="{{ route('consult') }}">
                        <span class="icon"><ion-icon name="server-outline"></ion-icon></span>
                        <span class="title">Visualisée Données</span>
                        

                    </a>
                </li>
                <li class="pg1">
                    <a href="{{ route('history') }}">
                        <span class="icon"><ion-icon name="timer-outline"></ion-icon></span>
                        <span class="title">Consulter Historique</span>
                        

                    </a>
                </li>
                <li>
                    <a href="{{ route('show') }}" class="home">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Profil utilisateur</span>
                        

                    </a>
                </li>
                <li>
                    <a href="{{ route('notification') }}">
                        <span class="icon"><ion-icon name="notifications-outline"></ion-icon></span>
                        <span class="title">Notification</span>
                        

                    </a>
                </li>
                
                <li>
                    <a href="AI-RS.pdf" download="file.pdf">
                        <span class="icon"><ion-icon name="document-attach-outline"></ion-icon></span>
                        <span class="title">Guide</span>
                        

                    </a>
                </li>
                <li>
                    <a href="#" onclick="confirmLogout()">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Déconnexion</span>
                        

                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
           <div class="section_white" >

            <h1 class="pro"><span class="ph">Votre</span> Profil</h1>
            <main class="main_white">
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
                                <input type="file" name="profile_image"  accept="image/*" id="profile-image-input">
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
                            <p id="email" class="content">{{ $user->email }}</p>
                            <button id="modifier-email" class="buttons"> <a href="{{ route('editEmail') }}"><b>Modifier</b></a></button>
                        </li>
                        <hr>
                        <li>
                            <label for="telephone">Numéro de téléphone</label>
                            <p id="telephone" class="content">{{ $user->telephone }}</p>
                            <button id="modifier-telephone" class="buttons"><a href="{{ route('ediTelephone') }}"><b>Modifier</b></a></button>
                        </li>
                        <hr>
                        <li> 
                            <label for="identifiant">Nom de Client</label>
                            <p id="identifiant" class="content">{{ $user->nomClient }}</p>
                            <button id="modifier-identifiant" class="buttons"><a href="{{ route('editNom') }}"><b>Modifier</b></a></button>
                        </li>
                        <hr>
                        <li> 
                           
                            <label for="password">mot de passe</label>
                            <p  id="password-stars" class="content">{{ str_repeat("*", ($user->password_length)) }}</p>
                            <button ><a href="{{ route('editPassword') }}"><b>Modifier</b></a></button>
                        </li>
                        <hr>
                    </ul>
                </section>
            </main>
                    
           </div>

                
         </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>    <script>
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

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>