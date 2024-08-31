<section class="section ">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mb-5 mt-5">

            <form action="/newsCrate" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                @csrf

                <div class="form-group">
                  <label for="email">News Title</label>
                  <input type="text" class="form-control col-sm-6" placeholder="News Title" id="email" name="newstitel">
                </div>
                  <div class="form-group">
                    <div class="custom-file col-sm-5">
                        <input type="file" class="custom-file-input " id="customFile" name="files[]" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div>
                <div class="form-group">
                  <label for="pwd">News Body</label>
                  <textarea class="ckeditor form-control"  name="news_body"></textarea>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
              </form>


          </div>
        </div>
    </div>
</section>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>


