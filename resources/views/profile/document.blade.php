
<?php 

use App\Http\Controllers\DocumentControllController ;
?>
@if ($profile[0]->profile_id==Auth::user()->profile_id)
<button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal" data-target="#uplodedocument">  <i class="bi bi-cloud-arrow-up-fill" style=""> &nbsp;Uplode Document</i></button>
@else

@if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
<button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal" data-target="#uplodedocument">  <i class="bi bi-cloud-arrow-up-fill" style=""> &nbsp;Uplode Document</i></button>
@endif
  
@endif

  

    <?php
         $document =   DB::table('document_controlls')->select('*')
        ->where('profile_id','=',$profile[0]->profile_id)
        ->get();
    ?>


    <table class="table table-hover mt-4">
        <thead>
          <tr>
            <th>#</th>
            <th>Document Name</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($document  as $ketDocument =>$document )
            <tr>
                <td>{{$ketDocument + 1}}</td>
                <td>{{DocumentControllController::document_name($document->document_uplode_types_id)}}</td>
                <td>
                    <i class="bi bi-filetype-pdf text-success" style="font-size: 1.5rem" data-toggle="modal" data-target="#viewdocument{{$document->document_controlls_id}}" title="View PDF"></i>
                    @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
                    <i class="bi bi-trash3 text-danger" style="font-size: 1.5rem" data-toggle="modal" data-target="#removedocument{{$document->document_controlls_id}}"></i>
                    @endif
                  </td>
            </tr>






                   <!-- removedocument -->
    <div class="modal fade" id="removedocument{{$document->document_controlls_id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Do You Want to Remove  ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/delet_document" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$document->document_controlls_pdf_name}}" name="document_controlls_pdf_name">
                    <input type="hidden" value="{{$document->document_controlls_id}}" name="document_controlls_id">
                    <input type="hidden" value="{{$document->document_uplode_types_id}}" name="document_uplode_types_id">
                    <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                    <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                    <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                    <input type="hidden" value="{{$document->document_controlls_pdf_name}}" name="document_types_name">
                    <div class="row">
                        <button type="submit" class="btn btn-success col-sm-1 ml-2">Yes </button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>





    <!-- viewdocument -->
    <div class="modal fade" id="viewdocument{{$document->document_controlls_id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Document View</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
               <iframe src="/document_storage/{{$document->document_controlls_pdf_name}}"  class="col" height="800px">
               </iframe>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


           






            @endforeach




        </tbody>
    </table>





    <!--- uploade document !---------->

              <!-- The Modal -->
              <div class="modal fade" id="uplodedocument">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Uplode Documents</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="/uplode_document" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="form-group">
                              <label for="email">File (PDF Only):</label>
                              <input type="file" class="form-control" placeholder="Document" id="email" name="file" required>
                            </div>
                            </div>

                            <div class="row">                          

                                  
                                  <select  class="custom-select  @error('document_types_id') is-invalid @enderror document_types_id" name="document_types_id" value="{{ old('document_types_id') }}" required style="width: 100%">                                    
                                       {{DocumentControllController::documentlist()}}
                                </select>


                                 
                                </div>
                                </div>
                            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                            <div class="row">
                                <button type="submit" class="btn btn-success col-sm-1 ml-5">Save</button>

                            </div>


                        </form>


                 

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                  </div>
              
              </div>
              </div>
              




    <script>
      // In your Javascript (external .js resource or <script> tag)
      $(document).ready(function() {
          $('.document_types_id').select2();
      });     

   </script>

   <style>
  .select2-selection__rendered {
      line-height: 31px !important;
  }
  .select2-container .select2-selection--single {
      height: 40px !important;
  }
  .select2-selection__arrow {
      height: 34px !important;
  }
   </style>



