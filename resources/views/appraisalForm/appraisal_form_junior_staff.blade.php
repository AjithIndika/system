<?php
use App\Http\Controllers\ProbationaryPerformnceAppraisalFormJuniorStaffController;
?>
<section class="section dashboard">
    <div class="col-12 ">
        <div class="card recent-sales overflow-auto">
    <div class="card-body mt-2">
        <div><h4>PROBATIONARY PERFORMNCE APPRAISAL FORM (JUNIOR STAFF) </h4></div>

<form method="POST" action="/appraisalFormJuniorStaffSave">
    @csrf
        <table class="col-sm-7 mt-3 table table-bordered">
            <tr>
                <td >Name:  </td>
                <td >{{ ProbationaryPerformnceAppraisalFormJuniorStaffController::getprofilname($data['profile_sug']) }}</td>
            </tr>
            <tr>
                <td >Period under review From:
                    <div class="form-group mt-1">
                        <input type="date" class="form-control @error('period_under_review_from') is-invalid @enderror   col-sm-7" id="usr" name="period_under_review_from">
                      </div>

                </td>
                <td >To
                    <div class="form-group mt-1">
                        <input type="date" class="form-control @error('period_under_review_to') is-invalid @enderror   col-sm-7" id="usr" name="period_under_review_to">
                      </div>
                </td>
            </tr>
        </table>


        <table class="col mt-3 table table-bordered">
            <tr>
                <td >Criterion </td>
                <td class="col-sm-1">Poor</td>
                <td class="col-sm-1">Fair</td>
                <td class="col-sm-1">Good</td>
                <td class="col-sm-1">Very Good</td>
                <td class="col-sm-1">Excellent</td>
            </tr>

            <tr>
                <td >Attendance & Punctuality</td>
                <td class="col-sm-1">
                    <select name="attendance_punctuality_poor" class="custom-select custom-select-sm col form-control @error('attendance_punctuality_poor') is-invalid @enderror  ">
                        <option>0</option>
                        <option>2</option>
                        <option>4</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attendance_punctuality_fair" class="custom-select custom-select-sm col form-control @error('attendance_punctuality_fair') is-invalid @enderror  ">
                    <option>6</option>
                    <option>8</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attendance_punctuality_good" class="custom-select custom-select-sm col form-control @error('attendance_punctuality_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>10</option>
                        <option>12</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attendance_punctuality_very_good" class="custom-select custom-select-sm col form-control @error('attendance_punctuality_very_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>14</option>
                        <option>16</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attendance_punctuality_excellent" class="custom-select custom-select-sm col form-control @error('attendance_punctuality_excellent') is-invalid @enderror  ">
                        <option>0</option>
                        <option>18</option>
                        <option>20</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td >Attitude </td>
                <td class="col-sm-1">
                    <select name="attitude_poor" class="custom-select custom-select-sm col form-control @error('attitude_poor') is-invalid @enderror  ">
                    <option>0</option>
                    <option>2</option>
                    <option>4</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attitude_fair" class="custom-select custom-select-sm col form-control @error('attitude_fair') is-invalid @enderror  ">
                        <option>0</option>
                        <option>6</option>
                        <option>8</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attitude_good" class="custom-select custom-select-sm col form-control @error('attitude_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>10</option>
                        <option>12</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attitude_very_good" class="custom-select custom-select-sm col form-control @error('attitude_very_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>14</option>
                        <option>16</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="attitude_excellent" class="custom-select custom-select-sm col form-control @error('attitude_excellent') is-invalid @enderror  ">
                        <option>0</option>
                        <option>18</option>
                        <option>20</option>
                    </select>
                </td>
            </tr>


            <tr>
                <td >Commitment to Task</td>
                <td class="col-sm-1">
                    <select name="commitment_to_task_poor" class="custom-select custom-select-sm col form-control @error('commitment_to_task_poor') is-invalid @enderror  ">
                        <option>0</option>
                        <option>2</option>
                        <option>4</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="commitment_to_task_fair" class="custom-select custom-select-sm col form-control @error('commitment_to_task_fair') is-invalid @enderror  ">
                        <option>0</option>
                        <option>6</option>
                        <option>8</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="commitment_to_task_good" class="custom-select custom-select-sm col form-control @error('commitment_to_task_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>10</option>
                        <option>12</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="commitment_to_taskvery_good" class="custom-select custom-select-sm col form-control @error('commitment_to_taskvery_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>14</option>
                        <option>16</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="commitment_to_taskexcellent" class="custom-select custom-select-sm col form-control @error('commitment_to_taskexcellent') is-invalid @enderror  ">
                        <option>0</option>
                        <option>18</option>
                       <option>20</option>
                    </select>
                </td>


            </tr>

            <tr>
                <td >Job Knowledge </td>
                <td class="col-sm-1">
                    <select name="job_knowledge_poor" class="custom-select custom-select-sm col form-control @error('job_knowledge_poor') is-invalid @enderror  ">
                        <option>0</option>
                        <option>2</option>
                        <option>4</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="job_knowledge_fair" class="custom-select custom-select-sm col form-control @error('job_knowledge_fair') is-invalid @enderror  ">
                        <option>0</option>
                        <option>6</option>
                        <option>8</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="job_knowledge_good" class="custom-select custom-select-sm col form-control @error('job_knowledge_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>10</option>
                        <option>12</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="job_knowledge_good" class="custom-select custom-select-sm col form-control @error('job_knowledge_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>14</option>
                        <option>16</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="job_knowledge_taskexcellent" class="custom-select custom-select-sm col form-control @error('job_knowledge_taskexcellent') is-invalid @enderror  ">
                        <option>0</option>
                        <option>18</option>
                        <option>20</option>
                    </select>
                </td>

            </tr>

            <tr>
                <td >Reliability & Trustworthiness  </td>
                <td class="col-sm-1">
                    <select name="reliability_trustworthiness_poor" class="custom-select custom-select-sm col form-control @error('reliability_trustworthiness_poor') is-invalid @enderror  ">
                        <option>0</option>
                        <option>2</option>
                        <option>4</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="reliability_trustworthiness_fair" class="custom-select custom-select-sm col form-control @error('reliability_trustworthiness_fair') is-invalid @enderror  ">
                        <option>0</option>
                        <option>6</option>
                        <option>8</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="reliability_trustworthiness_good" class="custom-select custom-select-sm col form-control @error('reliability_trustworthiness_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>10</option>
                        <option>12</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="reliability_trustworthiness_good" class="custom-select custom-select-sm col form-control @error('reliability_trustworthiness_good') is-invalid @enderror  ">
                        <option>0</option>
                        <option>14</option>
                        <option>16</option>
                    </select>
                </td>

                <td class="col-sm-1">
                    <select name="reliability_trustworthiness_taskexcellent" class="custom-select custom-select-sm col form-control @error('reliability_trustworthiness_taskexcellent') is-invalid @enderror  ">
                        <option>0</option>
                        <option>18</option>
                        <option>20</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td >Overall Performance (Total Marks)</td>
                <td class="col-sm-1" colspan="5">%</td>

            </tr>
            <tr>

                <td class="col-sm-1" colspan="6">Poor 0-45       |    Average 46-65    |      Good 66 – 75    |        Very Good 76–90    |       Excellent  91 - 100</td>

            </tr>




        </table>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">Significant Achievements:</label>
                    <textarea class="form-control @error('significant_achievements') is-invalid @enderror  " name="significant_achievements"></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="email">Significant Misses/Lapses:</label>
                    <textarea class="form-control @error('significant_misses_or_lapses') is-invalid @enderror  " name="significant_misses_or_lapses"></textarea>
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">Strengths and Special Skills:</label>
                    <textarea class="form-control @error('strengths_and_special_skills') is-invalid @enderror  " name="strengths_and_special_skills"></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="email">Areas of Improvement:</label>
                    <textarea class="form-control @error('areas_of_improvement') is-invalid @enderror  " name="areas_of_improvement"></textarea>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">Any Other Comments:</label>
                    <textarea class="form-control @error('any_other_comments') is-invalid @enderror  " name="any_other_comments"></textarea>
                </div>
            </div>
        </div>


        <div class="row mt-5">
        </hr>
            <h4>Progress Summery</h4>
         <div class="col mt-2">
                 <h5>Below the standard (0-45)</h5>
            <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input @error('any_other_comments') is-invalid @enderror " type="radio"  name="progress_summery" value="The intern failed to complete duties to minima acceptable levels or The intern’s conduct or attitude is unsatisfactory or The intern fails to act on constructive guidance"> The intern failed to complete duties to minima acceptable levels or The intern’s conduct or attitude is unsatisfactory or The intern fails to act on constructive guidance
                </label>
              </div>
         </div>
        </div>
        <div class="row">
         <div class="col mt-2">
            <h5>Meets the Standard with considerable guidance (46-75)</h5>
            <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input @error('progress_summery') is-invalid @enderror " type="radio"  name="progress_summery" value="Performed duties to an acceptable level with a considerable guidance. Improvement is required"> Performed duties to an acceptable level with a considerable guidance. Improvement is required
                </label>
              </div>
         </div>
        </div>
        <div class="row">
         <div class="col mt-2">
            <h5>Up to the standard (76-85)</h5>
            <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input @error('progress_summery') is-invalid @enderror " type="radio"  name="progress_summery" value="The intern was responsible, reliable and performed duties with a minimum of guidance. "> Performed duties to an acceptable level with a considerable guidance. Improvement is required
                </label>
              </div>
         </div>

        </div>

        <div class="row">
            <div class="col mt-2">
               <h5>Merit (86-100)</h5>
               <div class="form-check">
                   <label class="form-check-label">
                     <input class="form-check-input @error('progress_summery') is-invalid @enderror " type="radio"  name="progress_summery" value="Performed beyond expectations. The intern’s work and attitude indicate an ability to take on further responsibility">Performed beyond expectations. The intern’s work and attitude indicate an ability to take on further responsibility.
                   </label>
                 </div>
            </div>





           </div>


           <div class="row mt-5">
            <div class="col">
                <div class="form-group">
                    <label for="email">Any Other Comments:</label>
                    <textarea class="form-control @error('any_other_comments_2') is-invalid @enderror  " name="any_other_comments_2"></textarea>
                </div>
            </div>
        </div>


        <div class="row mt-2">

            <p class="mt-1 mb-3">I have reviewed the person named above and provided a constructive feed-back to the appraisee highlighting his/her strengths & weaknesses.</p>

            <div class="col">
                <div class="form-group">
                    <input type="text" value="{{   ProbationaryPerformnceAppraisalFormJuniorStaffController::getNameofAppraiser() }}"    class="form-control   col-sm-8" readonly>
                    <label for="email">Name of Appraiser:</label>

                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="text" value="{{ date('Y-m-d')}}" name="appraiser_enter_date"  class="form-control  col-sm-4" readonly>
                    <label for="email">Date: :</label>

                </div>
            </div>

        </div>



         <input type="hidden" value="{{Auth::user()->profile_id}}" name="appraiser_profile_id">
         <input type="hidden" value="{{ProbationaryPerformnceAppraisalFormJuniorStaffController::getprofileid($data['profile_sug'])}}" name="employee_profile_id">


         <button type="submit">Save</button>
        </form>
    </div>
</div>
</div>

</section>
