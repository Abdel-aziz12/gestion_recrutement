<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Entretien Programmé</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f5f9f0;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #28a745;
            color: #ffffff;
            padding: 10px;
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
        #para3 {
            text-align: justify;
            text-indent: 35px;
        }

        .details {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #dddddd;
            margin-bottom: 20px;
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
            <h2>Convocation à un Entretien</h2>
        </div>
        <div class="content">
            <p id="para1">Chèr/Chère <strong>{{ $inter['name'] }} {{ $inter['firstname'] }}</strong>,</p>
            <p id="para2">
                Nous avons le plaisir de vous informer que votre candidature pour le
                poste de <strong>{{ $inter['nom'] }}</strong> a été retenue pour la
                prochaine étape du processus de recrutement.
            </p>
            <div class="details">
                <p><strong>Détails de l'entretien :</strong></p>
                <p>Date : <strong>{{ $inter['date'] }}</strong></p>
                <p>Heure : <strong>{{ $inter['time'] }}</strong></p>
                <p>Lieu : <strong>l'accueil</strong></p>
                <p id="para3">
                    Nous vous prions de bien vouloir confirmer votre disponibilité à
                    cette date.
                </p>
            </div>
            <div class="footer">
                <p>Cordialement,</p>
                <p>
                    <strong>{{ $inter['nomuse'] }}</strong><br />
                    {{ $inter['nomentre'] }}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
