<!DOCTYPE html>
<html>
<head>
    <title>Resignation Request Approval Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #777;
            font-size: 18px;
            line-height: 1.5;
        }

        .approval-message {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resignation Approval Notification</h1>
        <p>
            Dear   {{$mailData['profile_Full_name']}},</br>

            We are writing to inform you that your resignation request submitted on {{$mailData['resignation_request_date']}} has been approved.

            Your last working day will be on {{$mailData['resignation_approval_date']}}. Please ensure a smooth transition of your responsibilities during this period.

            We appreciate your contributions to the company and wish you the best in your future endeavors.,</br>

            Sincerely,,</br>
            {{$mailData['companyName']}}
        </p>
        
    </div>
</body>
</html>
