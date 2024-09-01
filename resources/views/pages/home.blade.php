<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidature</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/intlTelInput.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/pages/style.css') }}">
</head>

<body>
    <div class="container-alert">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="principal row">

            <div class="gauche col-md-12 col-lg-6">
                <form action="/index/home" method="POST" enctype="multipart/form-data">
                    <h2 class="title">Candidature</h2>
                    @csrf

                    <div class="row">
                        <div class="column col-12 col-md-6">
                            <div class="input-box">
                                <span for="name">Nom: </span>
                                <input type="text" name="name" id="name" placeholder="Jacob" required />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span for="sexe">Sexe: </span>
                                <select name="sexe" id="sexe" required>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span for="category_id">Profil: </span>
                                <select name="category_id" id="category_id" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span for="email" >Email: </span>
                                <input type="email" name="email" id="email" placeholder="exemple@exemple.com"
                                    required />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span for="file">CV (au format PDF): </span>
                                <input type="file" name="file" id="file" required/>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="column col-12 col-md-6">
                            <div class="input-box">
                                <span for="firstname">Prénom: </span>
                                <input type="text" name="firstname" id="firstname" placeholder="Aiden" required />
                                @error('firstname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span for="adresse">Adresse: </span>
                                <input type="text" name="adresse" id="adresse" placeholder="ville" required />
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span for="phone">Téléphone: </span>
                                <input type="tel" name="phone" id="phone" placeholder="693025401" required />
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span for="motivation">Motivation: </span>
                                <textarea name="motivation" id="motivation" rows="4" required></textarea>
                                @error('motivation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn1">Enregistrer</button>
                </form>
            </div>
            <div class="droite col-md-12 col-lg-6">
                <img src="{{ asset('/istockphoto-1349094945-1024x1024.jpg') }}" alt="">
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/intlTelInput.min.js"></script>
    <script>
        const input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "cm",
            separateDialCode: true,
            utilsScript: "/intl-tel-input/js/utils.js?1723068208252" // just for formatting/placeholders etc
        });
    </script>
</body>

</html>
