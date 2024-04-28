

<?php 
use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    #email-container {
      max-width: 100%;
      margin: 2px auto;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    #header {
      background-color: #007bff;
      color: #fff;
      padding: 7px;
      text-align: center;
    }

    #tasks {
      padding: 20px;
    }

    .task-item {
      margin-bottom: 10px;
    }

    .task-item p {
      margin: 5px 0;
    }

    #footer {
      background-color: #f4f4f4;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div id="email-container">
    <div id="header">
      <h2> <em style="color: rgb(0, 255, 34)(166, 255, 0)">Hi Good Morning  {{$mailData['techmember'] }} </em> </br>You're uncompleted Tickets Remaining</h2>
    </div>

    <div id="tasks">
      <div class="task-item">

        <style>
            body {
              font-family: Arial, sans-serif;
              background-color: #f4f4f4;
              margin: 0;
              padding: 0;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100%;
            }
        
            table {
              border-collapse: collapse;
              width: 100%;
              margin: 5px;
              background-color: #fff;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              border-radius: 8px;
              overflow: hidden;
            }
        
            th, td {
              padding: 12px;
              text-align: left;
            }
        
            th {
              background-color: #007bff;
              color: #fff;
            }
        
            tr:nth-child(even) {
              background-color: #f2f2f2;
            }
        
            tr:hover {
              background-color: rgb(67, 243, 14);
            }

            a {
      text-decoration: none;
    }
          </style>
        </head>
        <body>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Date </th>
                <th>Target date</th>
                <th>Ticket number </th>                
                <th>Issues of Mentioned</th>
                <th>Last update</th>
                <th>Post By</th>
                <th>Go to System</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($mailData['tasklist'] as $key=>$tasklist)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{ date('Y-m-d', strtotime($tasklist->ticket_date_time)) }}</td>
                <td>{{$tasklist->ticket_target_finish_datetime}}</td>
                <td>{{$tasklist->tickets_number}}</td>
                <td>{{$tasklist->issues_name}}</td>
                <td>
                    {!!  html_entity_decode(DB::table('ticket_timelines')
                   ->orderBy('ticket_timelines_ticket_id', 'desc')                   
                   ->where('ticket_timelines_ticket_id', '=', $tasklist->tickets_id)
                   ->limit(1)
                   ->value('ticket_timelines_ticket_action')) !!} 
                </td>
                <td>{{$tasklist->ticket_user_name}}</td>
                <td><a href="{{$mailData['base_url'].'/oneTicket/'.$tasklist->tickets_number}}">View</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>


       

      
       
      </div>

    

      <!-- Add more task items as needed -->

    </div>

    <div id="footer">
      <p>This an auto-generated email by ticketing system</p>
    </div>
  </div>
</body>
</html>
