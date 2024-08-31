<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leave Job Replacement Alert</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    p {
      color: #555;
    }

    .cta-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
    }

    .cta-button:hover {
      background-color: #1e87d3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Leave Job Replacement Alert</h1>
    <p>Hello {{$mailData['recovery_person_Name']}},</p>
    <p>We hope this email finds you well. We regret to inform you that {{$mailData['requster_name']}} will be taking a leave from {{$mailData['leave_requsts_start_date']}} to {{$mailData['leave_requsts_end_date']}}. During this period, you will be responsible for {{$mailData['requster_name']}}'s job   .</p>
    <p>Please feel free to reach out to HR OR Your reporting Manager  for any work-related matters during the job </p>

  </div>
