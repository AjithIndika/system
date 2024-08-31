

<style>
/* Make the image fully responsive */
.carousel-inner img {
  width: 100%;
  height: 500px;
}
</style>

<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mb-5 mt-5">


            @foreach ($data['news'] as $row )
            <?php
               $imgs = json_decode($row->news_image);


                ?>

<div id="demo" class="carousel slide" data-ride="carousel">


                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                  </ul>


                <div class="carousel-inner">

                @foreach ($imgs as $key=>$item)


                        <div class="carousel-item  <?php if($key ==0){echo 'active';} ?>">
                          <img class="d-block w-10" src="/{{'news_image/'}}{{$item}}" alt="First slide">
                          <div class="carousel-caption">
                            <h3 class="text-body font-weight-bold" style="text-align: center;">{{ $row->news_titel}}</h3>

                          </div>
                        </div>


                @endforeach
            </div>


              <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>


<div class="mt-5">  {!!  html_entity_decode($row->news_details) !!} </div>





              </div>

@endforeach












          </div>
        </div>
    </div>
</section>




