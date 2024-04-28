
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">









        <!-- Recent Sales -->
        <div class="col-sm-12   ">
            <div class="card recent-sales overflow-auto">
              <div class="card-body ">


                <div class="d-inline-flex p-3  col">
                    <div class="p-2  col-sm-3"></div>
                    <div class="p-2  col">

                <form action="/new_task_save" method="POST" >
                    @csrf

                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                            <label for="email">Name:</label>
                            <input type="text" class="form-control @error('daily_tasks_user_name') is-invalid @enderror" placeholder="Name" id="email" name="daily_tasks_user_name" required>
                          </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control @error('daily_tasks_email') is-invalid @enderror" placeholder="Enter email" id="email" name="daily_tasks_email" required>
                          </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Phone Number :</label>
                                <input type="text" class="form-control  @error('daily_tasks_phone_number') is-invalid @enderror" placeholder="Phone Number" id="email" name="daily_tasks_phone_number" required>
                              </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Organization:</label>
                                <select class="custom-select  @error('daily_tasks_organization') is-invalid @enderror" name="daily_tasks_organization" required>
                                    @foreach ($data['busnus'] as $busnus)
                                    <option value="{{$busnus->subsidiaries_id}}">{{$busnus->subsidiaries_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>



                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Department:</label>
                                <select class="custom-select  @error('daily_tasks_department_name') is-invalid @enderror" name="daily_tasks_department_name" required>
                                    @foreach ($data['departments'] as $departments)
                                    <option value="{{$departments->department_id}}">{{$departments->department_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="email">Device:</label>
                                <select class="custom-select  @error('daily_tasks_equpment_types') is-invalid @enderror" name="daily_tasks_equpment_types" required>
                                    @foreach ($data['equpment_types'] as $equpment_types)
                                    <option value="{{$equpment_types->equpment_types_id}}">{{$equpment_types->equpment_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Issue:</label>
                                <select class="custom-select  @error('daily_tasks_issues_id') is-invalid @enderror" name="daily_tasks_issues_id" required>
                                    @foreach ($data['issues'] as $issues)
                                    <option value="{{$issues->issues_id }}">{{$issues->issues_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Problem Text (Describe Your Issue) :</label>
                                <textarea class="form-control @error('daily_tasks_issues_note') is-invalid @enderror" name="daily_tasks_issues_note" required></textarea>
                              </div>
                        </div>
                    </div>

                <button type="submit" class="btn btn-primary">Save</button>
              </form>




                    </div>
                    <div class="p-2 col-sm-3"></div>
                  </div>
                <section class="section dashboard ">




              </div>
            </div>
          </div>
        </section>

</body>




