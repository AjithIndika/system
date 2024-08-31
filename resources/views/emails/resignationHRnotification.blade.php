<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
        <h1>Resignation Request Approval Notification</h1>
        <p>
            Dear HR Team, </br>

            We are pleased to inform you that the resignation request submitted by <em style="color: rgb(248, 6, 6);">{{ $hrmailData['profile_Full_name']}} </em>on {{ $hrmailData['resignation_request_date']}} has been approved.

            The last working day for the employee will be on <em style="color: rgb(248, 6, 6);">{{ $hrmailData['resignation_approval_date']}} </em>. Please ensure a smooth transition of their responsibilities during this period.

            We appreciate your attention to this matter and your support in managing this transition.</br>

           <em style="color: rgb(248, 6, 6);"> Please go and schedule a task related persons </em></br></br>

            Sincerely,</br>
            {{ $hrmailData['userName']}}
        </p>
       
        <a href="{{$hrmailData['profile_sug']}}" class="btn">View Details</a>
    </div>
</body>
</html>
