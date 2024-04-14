<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de succès</title>
    <style>
        .success-message {
            background-color: #4caf50; /* Couleur de fond */
            color: white; /* Couleur du texte */
            padding: 10px 20px; /* Espacement intérieur */
            text-align: center; /* Alignement du texte */
            position: fixed; /* Position fixe */
            top: -100px; /* Initialisation à une position au-dessus de l'écran */
            left: 0; /* Alignement à gauche */
            width: 100%; /* Largeur totale */
            z-index: 9999; /* Z-index pour être au-dessus de tous les autres éléments */
            transition: top 0.5s ease-in-out; /* Transition pour le déplacement en douceur */
        }

        .success-message.show {
            top: 0; /* Déplacement vers le haut pour afficher le message */
            animation: fade-in 0.5s ease-in-out forwards; /* Animation de fondu */
        }

        @keyframes fade-in {
            from {
                opacity: 0; /* Début de l'animation avec une opacité de 0 */
            }
            to {
                opacity: 1; /* Fin de l'animation avec une opacité de 1 */
            }
        }
    </style>
</head>
<body>
    <div class="success-message show">Profil créé avec succès!</div>

    <!-- Votre contenu HTML peut être placé ici -->

    <!-- Lien vers un fichier JavaScript si nécessaire -->
</body>
</html>
