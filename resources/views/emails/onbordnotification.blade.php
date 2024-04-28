<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .content {
            padding: 20px;
        }

        .message {
            margin-top: 20px;
        }

        .signature {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Onboarding Notification</h1>
    </div>
    <div class="content">
        <p><strong>Dear {{$mailData['infromto']}},</strong></p>
        <p>I am delighted to inform you that we have successfully onboarded a new team member, {{$mailData['new_onbord']}}, who will be taking on the role of {{$mailData['jobroll']}} within our {{$mailData['subdiary']}}.</p>
     
        <p>{!!  html_entity_decode($mailData['requstings']) !!} </p>
       
       
    </div>
    <div class="signature">
        <p><strong>Best regards,</strong></p>
        <p>This Email was auto-generated by the HR System</p>
    </div>
</div>
</body>
</html>