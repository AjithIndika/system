<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Approval Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .content {
            text-align: center;
        }

        .content p {
            font-size: 16px;
            color: #666;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Leave Approval Alert</h1>
        </div>
        <div class="content">
            <p>Dear Sir / Madam,</p>
            <p> Leave application has been approved. Please find the details below:</p>
            <p>{{$mailData['title']}}</p>         
            <p>Start Date: {{$mailData['leave_requsts_start_date']}}</p>
            <p>End Date: {{$mailData['leave_requsts_end_date']}}</p>
            <p>Requst Date: {{$mailData['leave_requsts_need_date']}}</p>
            <p>Leave Reson: {{$mailData['leave_requsts_reson']}}</p>

            
            <p>Leave Approved : {{$mailData['requster_profile_update']}}</p>


            
            <p>Please note that this is an automated email. If you have any questions or concerns, please contact your HR department.</p>
        </div>
        <div class="footer">
            <p>Best Regards,</p>
            <p>HR