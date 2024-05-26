<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry Notifications</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <style>
        .section_white {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .notification {
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 10px;
            position: relative;
            text-align: center;
            margin-top:20px;
            
        }

        .notification:hover {
            background-color: #f9f9f9;
        }

        .notification-icon {
            margin: 0 auto;
            width: 50px;
            height: 50px;
        }

        .notification-content {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        .show-more-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .show-more-button:hover {
            background-color: #0056b3;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .modal-header {
            background-color: #007bff;
            padding: 10px 0;
            text-align: center;
            color: #ffffff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .modal-body {
            padding: 20px;
            font-size: 16px;
            color: #333333;
        }

        .modal-body p {
            margin: 0 0 10px;
        }

        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }

        .modal-footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777777;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .badge {
    position: absolute;
    top: 10px;
    right: 0px;
    padding: 5px 8px;
    border-radius: 50%;
    background-color: red;
    color: white;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
    text-align: center;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="{{ asset('images/logo.png') }}" width="70px">
                        </span>
                        <span class="title title0">HydroSentry</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('index') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
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
                    <a href="{{ route('notification') }}" class="home">
                        <span class="icon" style="position: relative;">
                            <ion-icon name="notifications-outline"></ion-icon>
                            @if($unreadCount > 0)
                                <span class="badge">{{ $unreadCount }}</span>
                            @endif
                        </span>
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
                <h2>Notifications</h2>
                <div id="notifications">
                    @if($alert)
                    <div class="notification">
                        <div class="notification-icon">
                            <img src="{{ asset('images/alert.png') }}" width="50" height="50" alt="Alert Icon">
                        </div>
                        <div class="notification-content">
                            <p>{{ \Illuminate\Support\Str::limit($alert->message, 50) }}</p>
                            <button class="show-more-button" onclick="showModal('alertModal{{ $alert->id }}', {{ $alert->id }})">Afficher plus</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="alertModal{{ $alert->id }}" class="modal">
                        <div class="modal-content">
                            <span class="modal-close" onclick="closeModal('alertModal{{ $alert->id }}')">&times;</span>
                            {{-- <div class="modal-header"> --}}
                                <h1>Notification d'alerte</h1>
                            {{-- </div> --}}
                            <div class="modal-body">
                                <div class="alert" role="alert">
                                    <p>Une fuite a été détectée dans le réseau de distribution d'eau le {{ $alert->created_at->format('d/m/Y') }} à {{ $alert->created_at->format('H:i') }}. Veuillez prendre les mesures nécessaires pour inspecter et réparer la fuite afin de prévenir tout dommage supplémentaire.</p>
                                    {{-- <p><strong>Message :</strong> {{ $alert->message }}</p> --}}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @else
                    <p>No unread alerts found.</p>
                    @endif
                </div>
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
        function showModal(id, alertId) {
    document.getElementById(id).style.display = "block";
    markAsRead(alertId);
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

function markAsRead(alertId) {
    fetch(`/mark-as-read/${alertId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    }).then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    }).then(data => {
        console.log(data.message);
        updateBadgeCount();
    }).catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

function updateBadgeCount() {
    let badge = document.querySelector('.badge');
    if (badge) {
        let count = parseInt(badge.textContent, 10);
        if (count > 1) {
            badge.textContent = count - 1;
        } else {
            badge.remove();
        }
    }
}

window.onclick = function(event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}


    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
