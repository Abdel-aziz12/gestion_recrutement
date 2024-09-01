<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f5f9f0;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 1px;
            text-align: center;
        }

        .content {
            margin: 20px 0;
        }

        .content p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        #para1,
        #para2,
        #para3,
        #para4 {
            text-align: justify;
            text-indent: 35px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888888;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Accusé de Réception</h2>
        </div>
        <div class="content">
            <p id="para1">Chèr/Chère <strong>{{ $depot['name'] }} {{ $depot['firstname'] }}</strong></p>
            <p id="para2">
                Nous vous remercions d'avoir postulé à l'offre d'emploi
                <strong> {{ $depot['nom'] }}</strong> au sein de notre entreprise, <strong>{{ $depot['nomentre'] }}</strong>.Nous vous confirmons par la
                présente que nous avons bien reçu votre candidature en date du
                <strong> {{ $depot['date'] }}</strong>.
            </p>
            <p id="para3">
                Votre profil a retenu notre attention, et nous étudierons votre
                dossier avec soins. Nous vous informerons de la suite donnée à votre
                candidature dans les meilleurs délais.
            </p>
            <p id="para4">
                En attendant, nous vous remercions de l'intérêt que vous portez à
                notre entreprise.
            </p>
            <div class="footer">
                <p>Cordialement,</p>
                <p><strong>{{ $depot['nomuse'] }}</strong> <br />
                    {{ $depot['nomentre'] }}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
