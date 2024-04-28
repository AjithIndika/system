<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Request Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

        .ticket-info {
            background-color: #f7f7f7;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .ticket-info p {
            font-size: 18px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .terms {
            margin-top: 20px;
            padding: 20px;
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .terms h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .terms p {
            font-size: 14px;
            color: #777;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
          <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/Asset_network_banner.png'))) }}" class="logo" >

         
        </div>
        <h1>Repair Request Ticket</h1>
        <p>Hello {{$mailData['ticket_user_name']}},</p>
        <p>Your repair request has been received and is being processed. Below are the details of your request:</p>

        <div class="ticket-info">
            <p><strong>Ticket Number:</strong> {{$mailData['tickets_number']}}</p>
            <p><strong>Request Date:</strong> {{date('Y-M-d')}}</p>
            <p><strong>Issue Description:</strong> {!!  html_entity_decode($mailData['ticket_issues_note']) !!} </p>
            <p><strong>Service Center:</strong> {{ env('IT_NAME')}}</p>
        </div>

        <p>We will get in touch with you shortly to provide further details and updates on the status of your repair request. In the meantime, feel free to contact us if you have any questions or require additional information.</p>

        <a class="button" href="#">Track Request</a>

        <div class="terms">
            <h3>Terms and Conditions:</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            <p>By using our repair request service, you agree to our terms and conditions.</p>
        </div>

        <p>Thank you for choosing our services.</p>
        <p>Best regards,</p>
        <p>The {{ env('IT_NAME')}} Team</p>
    </div>
</body>
</html>
