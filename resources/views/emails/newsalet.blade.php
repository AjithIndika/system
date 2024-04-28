<!DOCTYPE html>
<html>

<head>
    <title>{{$mailData['appname']}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
    .parent {
  display: flex;
  justify-content: center;
  align-items: center;
}

.center {
  /* optional */
  width: 50%;
}

</style>
</head>

<body >


    <section class="recentNews">
        <div class="container parent">
            <h2 class="news-title " style="text-align: center;">
                {{$mailData['title']}}
            </h2>
            <div class="row center">

<?php
 $imgs = json_decode($mailData['images']);

    ?>

                @foreach ( $imgs as $item)
                <div class="ct-blog col-sm-6 col-md-4 mt-5 mb-5" style="margin-top: 10px;margin-botom: 10px;">
                    <div class="inner">
                        <div class="fauxcrop">
                            <img alt="News Entry" src="{{url('news_image')}}/{{$item}}" width="400" height="400">
                        </div>
                    </div>
                </div>
                @endforeach





            </div>
            <div class="btn-news btn-contests mt-3">
                {!!  html_entity_decode($mailData['newsBody']) !!}
            </div>
        </div>
    </section>

</body>

</html>
