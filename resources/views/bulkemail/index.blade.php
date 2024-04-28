

<div class="card-body">
<form method="post" action="/one_email_send" enctype="multipart/form-data">
    @csrf
<div class="form-group">
    <label for="email">Email address:</label>
    <input type="text" class="form-control col-sm-6" placeholder="Subject"  name="emailaddress">
  </div>

  <div class="form-group">
    <label for="email">Email Subject:</label>
    <input type="text" class="form-control col-sm-6" placeholder="Subject"  name="subject">
  </div>

  <div class="form-group">
    <label for="email">Email Body</label>
    <textarea class="form-control" name="bulkemailbody" rows="10" cols="30"></textarea>

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>








