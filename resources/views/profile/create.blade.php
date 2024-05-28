
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>HydroSentry</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
            @csrf
            <h1>create users</h1>
            <div class="input_box">
                <div class="input_field">
                    <input type="text" placeholder="Full name" name="nomClient" required>
                    <i class='bx bxs-user' ></i>
                </div>
                <div class="input_field">
                    <input type="text" placeholder="username" name="client_id" required>
                    <i class='bx bxs-user' ></i>
                </div>
            </div>
            <div class="input_box">
                <div class="input_field">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
                <div class="input_field">
                    <input type="tel" placeholder="phone number" name="telephone" required>
                    <i class='bx bxs-phone' ></i>
                </div>
            </div>
            <div class="input_box">
                <div class="input_field">
                    <input type="password" placeholder="password"  name="password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input_field">
                    <input type="file" id="photo_upload" name="photo_path" onchange="previewPhoto(this);" required accept="image/*">
                    <div id="photo_preview"></div>
                    <i class='bx bxs-image'></i>
                </div>
            </div>
            <label for="">
                <input type="checkbox"> I hereby declare that the above information provided is true and correct
            </label>
            <button type="submit" class="btn">Enregistrer</button>
        </form>
        <!-- message.blade.php -->

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>
