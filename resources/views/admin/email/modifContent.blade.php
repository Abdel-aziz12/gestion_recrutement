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
            background-color: #ffc107;
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
            <h2>Modification de votre Entretien</h2>
        </div>
        <div class="content">
            <p id="para1">Chèr/Chère <strong>{{ $modif['name'] }} {{ $modif['firstname'] }}</strong>,</p>
            <p id="para2">
                Nous tenons à vous informer que l'entretien initialement prévu pour le
                <strong>{{ $modif['datee'] }}</strong> a été modifié.
            </p>
            <div class="details">
                <p><strong>Nouveaux détails de l'entretien :</strong></p>
                <p>Date : <strong>{{ $modif['date'] }}</strong></p>
                <p>Heure : <strong>{{ $modif['time'] }}</strong></p>
                <p>Lieu : <strong>l'accueil</strong></p>
                <p id="para3">
                    Nous nous excusons pour ce changement de dernière minute et vous
                    remercions pour votre compréhension. Nous vous prions de bien vouloir confirmer
                    votre disponibilité pour cette nouvelle date.
                </p>
            </div>
            <div class="footer">
                <p>Cordialement,</p>
                <p>
                    <strong>{{ $modif['nomuse'] }}</strong><br />
                    {{ $modif['nomentre'] }}
                </p>
            </div>
        </div>
    </div>

</body>

</html>
