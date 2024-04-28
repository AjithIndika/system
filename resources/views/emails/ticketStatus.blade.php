



<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .header {
      text-align: center;
    }
    .content {
      margin-top: 20px;
    }
    .button {
      display: inline-block;
      background-color: #007bff;
      color: #ffffff;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Service Ticket Update</h1>
    </div>
    <div class="content">
      <p>Dear {{$mailData['ticket_user_name']}} ,</p>
      <p>We are pleased to inform you that your service ticket, <strong>Ticket # {{$mailData['tickets_number']}}</strong>, has been successfully resolved and is now marked as complete.</p>
      <p><strong>Issue:</strong>{!!  html_entity_decode($mailData['tickets_issued']) !!}  </p>

      <p><strong>Solution </strong> {{$mailData['ticketaction']}}</p>
      <p>Our technical team has worked diligently to address the concerns you reported. We appreciate your patience throughout this process and are delighted to confirm that the necessary actions have been taken to resolve the issue.</p>
      <p>If you encounter any further difficulties or have any questions, please do not hesitate to reach out to our support team. We are here to assist you.</p>
      <p>Your feedback is valuable to us as we continually strive to enhance our services. If you have a moment, we would appreciate your thoughts on the support experience you received.</p>
      <p>Thank you for choosing our services. We look forward to serving you in the future.</p>
      <p>Best regards,<br>
        {{$mailData['ticket_finish_user']}}  <br>
           <br>
           {{$mailData['appname']}} </p>
      <p style="text-align: center;">
        <a class="button" href="{{$mailData['base_url']}}">Contact Us</a>
      </p>
    </div>
  </div>
</body>
</html>
