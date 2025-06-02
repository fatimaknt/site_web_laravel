<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de Paiement</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            /* Peut ne pas être supporté par tous les générateurs de PDF */
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }

        .invoice-box h1 {
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .section-title {
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <h1>Facture de paiement</h1>

        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Identifiant employer: {{ $fullPaymentInfos->employe->id ?? 'N/A' }}<br>
                                Nom & prénom: {{ $fullPaymentInfos->employe->nom ?? 'N/A' }}
                                {{ $fullPaymentInfos->employe->prenom ?? '' }}<br>
                                Département: {{ $fullPaymentInfos->employe->departement->nom ?? 'N/A' }}<br>
                                Mois & Année: {{ $fullPaymentInfos->month ?? 'N/A' }}
                                {{ $fullPaymentInfos->year ?? 'N/A' }}
                            </td>
                            {{-- Ces informations sont statiques ou viennent d'ailleurs? Placeholder pour l'instant --}}
                            {{-- Identifiant ici<br>
                            Nom & Prénom ici (email ici)<br>
                            Département ici<br>
                            Mois / Année ici --}}
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="section-title">Résumé de la transaction</div>
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>Description</td>
                <td>Frais</td>
            </tr>
            <tr class="item">
                <td>Frais</td>
                <td>{{ $total_fees ?? '0' }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Total frais: {{ $total_fees ?? '0' }}
                </td>
            </tr>
        </table>

        <div class="section-title">DÉTAILS DU PAIEMENT</div>
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>Date</td>
                <td>Montant</td>
            </tr>
            @if ($fullPaymentInfos)
                <tr class="item last">
                    <td>{{ $fullPaymentInfos->launch_date ?? 'N/A' }}</td>
                    <td>{{ $fullPaymentInfos->amount ?? '0' }}</td>
                </tr>
            @else
                <tr class="item last">
                    <td>Aucun détail de paiement</td>
                    <td></td>
                </tr>
            @endif

            <tr class="total">
                <td></td>
                <td>
                    Total Montant du paiement -FRANCS: {{ $fullPaymentInfos->amount ?? '0' }}
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" style="margin-top: 20px;">
            <tr class="total">
                <td></td>
                <td>
                    Total frais {{ $total_fees ?? '0' }}<br>
                    Total payé {{ $total_paid ?? '0' }}<br>
                    Reste à payer {{ $remaining_to_pay ?? '0' }}
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
