<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le numéro de téléphone</title>
    <style>
        /* Basic styles for a clean and modern look */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

h1 {
  font-size: 2em;
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] { /* Target all three input types */
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button[type="submit"] {
  background-color: #4CAF50; /* Green */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}

/* Error message styling (if applicable) */
.error-message {
  color: red;
  font-size: 0.8em;
  margin-top: 5px;
}

/* Optional: Center the form horizontally */
form {
  max-width: 400px;
  margin: 0 auto;
}

    </style>
    
</head>
<body>
    <h1>Modifier le numéro de téléphone</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('updateTelephone') }}" method="POST">
        @csrf
        @method('Patch')
        <label for="telephone">Nouveau numéro de téléphone :</label>
        <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}">
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
