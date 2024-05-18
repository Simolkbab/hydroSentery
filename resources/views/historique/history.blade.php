<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

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
                    <a href="{{ route('history') }}" class="home">
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
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="section_white">
                <ul style="list-style-type: none; padding: 0;">
                    <!-- Display sensor data -->
                    @forelse ($sensorData as $data)
                    <li style="margin-bottom: 10px; padding: 10px; background-color: #f9f9f9; border-radius: 5px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
                        <span style="display: inline-block; width: 80px; font-weight: bold;">Mesure:</span>
                        <span style="display: inline-block; width: 100px;">{{ $data->id }}</span>
                        <span style="display: inline-block; width: 80px; font-weight: bold;">Débit:</span>
                        <span style="display: inline-block; width: 100px;">{{ $data->debit }}</span>
                        <span style="display: inline-block; width: 80px; font-weight: bold;">Date:</span>
                        <span>{{ $data->created_at }}</span>
                    </li>
                    @empty
                    <p style="padding:10px">No sensor data available.</p>
                    @endforelse
                </ul>
            
                <!-- Pagination links -->
                @if (!$sensorData->isEmpty())
                <ul class="pagination" style="list-style: none; display: flex; justify-content: center; padding: 0; margin-top: 20px;">
                    @if ($sensorData->onFirstPage())
                    <!-- If on the first page, disable previous button -->
                    <li class="page-item" style="margin-right: 10px;"><span class="page-link">&laquo;</span></li>
                    @else
                    <!-- If not on the first page, show previous button -->
                    <li class="page-item" style="margin-right: 10px;"><a class="page-link" href="{{ $sensorData->previousPageUrl() }}">&laquo;</a></li>
                    @endif
            
                    <!-- Pagination links -->
                    @foreach ($sensorData->getUrlRange(1, $sensorData->lastPage()) as $page => $url)
                    <!-- Highlight current page -->
                    <li class="page-item {{ $page == $sensorData->currentPage() ? 'active' : '' }}" style="margin-right: 10px;"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endforeach
            
                    @if ($sensorData->hasMorePages())
                    <!-- If there are more pages, show next button -->
                    <li class="page-item" style="margin-right: 10px;"><a class="page-link" href="{{ $sensorData->nextPageUrl() }}">&raquo;</a></li>
                    @else
                    <!-- If on the last page, disable next button -->
                    <li class="page-item" style="margin-right: 10px;"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
                @endif
            </div>
            
            

                
         </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>    <script>

        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "{{ route('logout') }}";
            }
        }
    
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>