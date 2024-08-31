<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        ul {
            list-style: none;
        }

        ul li::before {
            content: "• ";
            color: #333;
        }
    </style>
    <title>{{$mailData['title']}}</title>
</head>

<body>
    <div class="email-container">
        <h2>Off-Boarding Tasks and Transition Plan</h2>

        <p>Dear {{$mailData['infromto']}} and Relevant Team Members,</p>

        <p>I hope this message finds you well. As we navigate the off-boarding process for {{$mailData['offbord']}}, it's essential to ensure a smooth transition. To facilitate this transition, we've outlined a set of off-boarding tasks and a timeline for all relevant parties involved.</p>

        <h3>Off-Boarding Task List:</h3>
        <p> <p>{!!  html_entity_decode($mailData['requstings']) !!} </p></p>

        <h3>Timeline:</h3>
    

        <p>Please ensure active participation in this transition process, as your collaboration is critical to its success. If you have any concerns or questions about these tasks or the timeline, please don't hesitate to reach out.</p>

        <p>{{$mailData['offbord']}}, your dedication and contributions have been invaluable to our organization, and we extend our heartfelt appreciation for your professionalism during this transition. We wish you the very best in your future endeavors and hope to stay in touch.</p>

        <p>Warm regards,</p>

        <p>{{$mailData['appname']}}<br>
            {{$mailData['subdiary']}}<br>
            </p>
    </div>
</body>

</html>
