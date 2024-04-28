<!DOCTYPE html>
<html>

<head>
    <title>{{$mailData['appname']}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <style type="text/css">
        textarea
        {
        width: 100%;
        height: 100%;
        border-color: Transparent;

        }
        </style>


</head>

<body>

 <h3>{{$mailData['subject']}}</h3>

</br>
<textarea rows="50" cols="50">{{$mailData['bulkemailbody']}}</textarea>

</body>

</html>
