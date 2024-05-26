<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroSentry</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/consult.css') }}">
    <style>
        /* Custom styles for the chart */
        #sensorChartContainer {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Custom styles for the chart title */
        .chart-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul >
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
                    <a href="{{ route('consult') }}" class="home">
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
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
           <div class="section_white"  >
           
                <h1 style="font-size:20px;text-align:center;padding:7px 0;">Bienvenue dans le Dashboard</h1>

            <div class="cardBox" style="width: 100%">
                @php
                $colors = ['#75BBF2', '#9AC1FA', '#1D629F']; // Define an array of colors
  

            @endphp
            
            @foreach ($lastThreeSensorData as $key => $sensorData)
             
            
                <div class="card" style="background-color: {{ $colors[$key % count($colors)] }}">
                    <div class="numbers">Valeur = {{ $sensorData->debit }}</div>
                    <div class="iconBx">
                        <img src="{{ asset('images/sensor_water_flow.png') }}" style="width:90px;">
                    </div>
                </div>
            @endforeach

             
            </div>

           
                <div class="graph" >
               

                        
                        <h2 class="chart-title">Débitmètre</h2>
                        <canvas id="sensorChart" height="100" ></canvas>
                        
            
                   
                </div>

                
         
            
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the chart (replace this with your actual data)
        var averageDebitPerOfEachDay = {!! json_encode($averageDebitPerOfEachDay) !!};
        var labels = Object.keys(averageDebitPerOfEachDay); // Dates as labels
        var values = Object.values(averageDebitPerOfEachDay); // Average debit values
    
      
        // Create the chart
        var ctx = document.getElementById('sensorChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Average Débit',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Light background color for bars
                    borderColor: 'rgb(75, 192, 192)', // Border color for bars
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.8, // Adjust the width of the bars (80% of available space)
                        categoryPercentage: 0.9, // Adjust the space between bars (90% of available space)
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Average Débit'
                        }
                    }]
                }
            }
        });
    </script>
    
    
    
    

</body>

</html>