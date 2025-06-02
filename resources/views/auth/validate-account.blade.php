<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tp-Salaire-Employe</title>
</head>

<body>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" type="text/css" />

    <form method="post" action="{{ route('submitDefineAccess', $email) }}">

        @csrf
        @method('POST')
        <div class="box">
            <h1>Definissez vos access</h1>
            {{--  {{ Hash::make('qwerty') }} --}}

            @if (Session::has('error_message'))
                <p style="font-size:10px; color:red">{{ Session::get('error_message') }}</p>
            @endif
            @if (Session::has('success_message'))
                <p style="font-size:10px; color:green">{{ Session::get('success_message') }}</p>
            @endif

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="email" value="{{ $email }}" readonly />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Code</label>
                <input type="text" name="code" class="email" value="{{ old('code') }}" />
                @error('code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" name="password" class="email" />
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Mot de passe de confirmation</label>
                <input type="password" name="confirm_password" class="email" />

                @error('confirm_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="btn-container">
                <button type="submit"> Valider</button>
            </div>
            <!-- End Btn -->
            <!-- End Btn2 -->
        </div>
        <!-- End Box -->
    </form>
</body>

</html>
<style>
    .box {
        padding: 30px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
        /* Ajoute de l'espace en bas de chaque groupe */
    }

    .form-group label {
        margin-bottom: 5px;
        /* Espace entre le label et l'input */
        font-weight: bold;
        color: #555;
        /* Couleur de texte pour les labels */
    }

    .email {
        background: #ecf0f1;
        border: 1px solid #ccc;
        border-bottom: 2px solid #ccc;
        padding: 10px;
        /* Augmente le padding */
        width: 100%;
        /* L'input prend toute la largeur du conteneur */
        box-sizing: border-box;
        /* Inclure padding et border dans la largeur */
        color: #333;
        /* Couleur de texte */
        font-size: 1em;
        border-radius: 4px;
        margin-top: 0;
    }

    .email:focus {
        outline: none;
        border-color: #3498db;
        /* Couleur de bordure au focus */
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        /* Ombre au focus */
    }

    .text-danger {
        color: red !important;
        font-size: 0.9em;
        /* Taille de texte légèrement plus petite */
        margin-top: 5px;
        /* Espace au-dessus du message */
    }

    .btn-container {
        padding: 1rem 0;
        /* Ajuste le padding */
        text-align: center;
        /* Centre le bouton si souhaité, bien que flex-direction column soit utilisé*/
    }

    button {
        background: #3498db;
        /* Change la couleur du bouton */
        width: 100%;
        /* Bouton prend toute la largeur */
        max-width: 200px;
        /* Limite la largeur du bouton */
        padding: 10px 15px;
        /* Ajuste le padding */
        color: white;
        border-radius: 4px;
        border: none;
        /* Supprime la bordure par défaut */
        font-weight: bold;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
        /* Ajoute une transition */
    }

    button:hover {
        background: #2980b9;
        /* Couleur au survol */
    }

    /* Styles pour les messages de session */
    .box p {
        font-size: 1em;
        /* Ajuste la taille de la police */
        margin-bottom: 15px;
        /* Ajoute un peu de marge en bas */
        padding: 10px;
        border-radius: 4px;
        text-align: center;
    }

    .box p[style*="color:red"] {
        background-color: #f8d7da;
        /* Fond rouge clair pour les erreurs */
        color: #721c24 !important;
        /* Texte rouge foncé */
        border: 1px solid #f5c6cb;
    }

    .box p[style*="color:green"] {
        background-color: #d4edda;
        /* Fond vert clair pour les succès */
        color: #155724 !important;
        /* Texte vert foncé */
        border: 1px solid #c3e6cb;
    }
</style>
