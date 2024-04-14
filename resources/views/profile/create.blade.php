<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon profil</title>
  <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
  <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Username:</label>
        <input type="text" name="client_id">
    </div>
    <div>
        <label>Nom du client:</label>
        <input type="text" name="nomClient">
    </div>
    <div>
      <label>Téléphone:</label>
      <input type="tel" name="telephone">
  </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email">
    </div>
    <div>
        <label>Mot de passe:</label>
        <input type="password" name="password">
    </div>
    <div>
        <label>Photo:</label>
        <input type="file" name="photo_path">
    </div>
    <button type="submit">Enregistrer</button>
</form>
<!-- message.blade.php -->

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</body>
</html>
