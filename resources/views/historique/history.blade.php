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
    <style>
        .pagination {
            margin: 40px 0;
            list-style: none;
            text-align: center;
        }
    
        .pagination li {
            display: inline-block;
            margin-right: 5px;
        }
    
        .pagination li a,
        .pagination li span {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
            color: #333;
            text-decoration: none;
        }
    
        .pagination li.active a,
        .pagination li.active span {
            background-color: #007bff;
            color: #fff;
        }
        button {
        padding: 10px 20px;
        background-color: #007BFF;
        color: black;
        border: 3px solid #ADB2B5;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-container {
        display: flex;
        align-items: center;
    }

    /* Style for the input */
    input[type="date"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }

    /* Style for the accompanying text */
    .filter-text {
        font-size: 16px;
        font-weight:bold;
    }
    /* Hover effect for the button */
    button:hover {
        background-color: #5b8d9f;
    }

    .input-container {
        display: flex;
        align-items: center;
    }

  
    /* Style for the input */
    input[type="date"] {
       width: 200px;
       background: #ADB2B5 url("images/calendar.png");
       background-size: 20px;
       background-repeat: no-repeat;
       background-position: 90%;
        padding: 7px 9px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        outline: none;
    }
   
    input[type="date"]::-webkit-calendar-picker-indicator{
        opacity: 0;
    }

    /* Style for the icon */
    


.histor_auj {
    width: 100%;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    background: #ADB2B5
}
.histor_auj1 {
    width: 95%;
    overflow: hidden;
    margin-left: 25px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    background: #ADB2B5
}

.histor_auj table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 4px;
    padding:  3px;
    
}
.histor_auj1 table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 4px;
    padding:  3px;
    
}

.histor_auj th,
.histor_auj td {
    padding: 15px;
    text-align: center;
}
.histor_auj1 th,
.histor_auj1 td {
    padding: 15px;
    text-align: center;
}

.histor_auj th {
    background-color: #8ab1da;
}
.histor_auj1 th {
    background-color: #8ab1da;
}

.histor_auj tbody tr:nth-child(odd) {
    background-color: #EDF0F2;
}
.histor_auj1 tbody tr:nth-child(odd) {
    background-color: #EDF0F2;
}
.histor_auj1 tbody tr:nth-child(even) {
    background-color: #cbd8e0;
}


    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="containerHistory">
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
            <div class="section_white" style="padding-bottom: 100px;">
                <div style="padding:20px 25px">
                    <div style="margin-bottom:10px">

                        <div style="display: flex; justify-content:space-between">
                           
                            <button onclick='resetDate()'Style="font-weight:bold;spa">Tout </button>
                            <div class="input-container">

                                <div class="input-wrapper">
                                    <div class="date-picker-wrapper">
                                        <input type="date" id="datePicker" onchange="filterByDate(this)" >
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <h1 style="font-size: 20px;margin-top: 30px;font-weight: bolder">Aujourd’hui</h1>
                        <div style="display: flex; justify-content:flex-start;align-items:center ;gap:100px;padding:20px 0">
                           
                            <div class="histor_auj">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Mesure</th>
                                            <th>Débit</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($averageDebitToday)
                                        <tr>
                                            <td>1</td>
                                            <td><span class="status-delivered">{{$averageDebitToday}} </span></td>
                                            <td>{{ date('Y-m-d') }} </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
    
                
            </div>
        </div>
        <h1 style="font-size: 20px;margin-left: 24px;font-weight: bolder">Récent</h1>

  <div style="padding:15px 0">
            
    <div class="histor_auj1">
              <table >
                <thead>
                    <tr>
                        <th>Mesure</th>
                        <th>Débit</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($averageDebitPrecedingDays as $data)
                  <tr>
                      <td>1</td>
                      <td> <span class="status-delivered"> {{ $data->average_debit }}</span></td>
                      <td >{{ $data->date }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
                 
    </div>
    <nav>
        {{ $averageDebitPrecedingDays->appends(['page' => $averageDebitPrecedingDays->currentPage()])->links() }}

    </nav>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>    
    <script>

    var date = new Date();
      var year = date.getFullYear();
      var month = String(date.getMonth()+1).padStart(2,'0');
      var todayDate = String(date.getDate()).padStart(2,'0');
      var datePattern = year + '-' + month + '-' + todayDate;
      document.getElementById("datePicker").value = datePattern;



        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "{{ route('logout') }}";
            }
        }

        function filterByDate(input) {
        var selectedDate = input.value;
        // Redirect to the same page with the selected date as a query parameter
        window.location.href = '{{ route("history") }}?date=' + selectedDate;
    }
    function resetDate() {
    
        window.location.href = '{{ route("history") }}';
    }

    
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>