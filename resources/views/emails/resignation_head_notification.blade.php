<!DOCTYPE html>
<html>
<head>
    <title>Resignation Request Notification</title>
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
        <h1>Resignation Request Notification</h1>
        <p>
            Dear {{$mailData['reportingManager']}},

            This is to inform you that I am submitting my resignation from my position at {{$mailData['sbu']}}.
            My last working day will be {{$mailData['resignation_date']}}, and I will ensure a smooth transition of my responsibilities during this period.

            I have truly appreciated the opportunities and experiences I've had at {{$mailData['sbu']}} and have enjoyed working with the team.

            Thank you for your support during my time here.

            Sincerely,

            {{$mailData['empname']}},

        </p>
        <a href="{{$mailData['resignation_letter']}}" class="btn">View Later</a>
        <a href="{{$mailData['profile_sug']}}" class="btn">Go to Confirm Resignation</a>
    </div>
</body>
</html>
