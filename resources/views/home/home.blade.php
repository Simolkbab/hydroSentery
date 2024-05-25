<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                    <a href="{{ route('index') }}" class="home">
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
                    <a href="{{ route('show') }}">
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
         <div class="main" >
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="section_white">
               
            </div>
        
            

                
         </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>

        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "{{ route('logout') }}";
            }
        }
    
    </script>
     <script src="app.js"></script>  

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>