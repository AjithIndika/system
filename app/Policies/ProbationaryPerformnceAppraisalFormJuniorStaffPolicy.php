<?php

namespace App\Policies;

use App\Models\Probationary_performnce_appraisal_form_junior_staff;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProbationaryPerformnceAppraisalFormJuniorStaffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Probationary_performnce_appraisal_form_junior_staff  $probationaryPerformnceAppraisalFormJuniorStaff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Probationary_performnce_appraisal_form_junior_staff $probationaryPerformnceAppraisalFormJuniorStaff)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Probationary_performnce_appraisal_form_junior_staff  $probationaryPerformnceAppraisalFormJuniorStaff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Probationary_performnce_appraisal_form_junior_staff $probationaryPerformnceAppraisalFormJuniorStaff)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Probationary_performnce_appraisal_form_junior_staff  $probationaryPerformnceAppraisalFormJuniorStaff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Probationary_performnce_appraisal_form_junior_staff $probationaryPerformnceAppraisalFormJuniorStaff)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Probationary_performnce_appraisal_form_junior_staff  $probationaryPerformnceAppraisalFormJuniorStaff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Probationary_performnce_appraisal_form_junior_staff $probationaryPerformnceAppraisalFormJuniorStaff)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Probationary_performnce_appraisal_form_junior_staff  $probationaryPerformnceAppraisalFormJuniorStaff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Probationary_performnce_appraisal_form_junior_staff $probationaryPerformnceAppraisalFormJuniorStaff)
    {
        //
    }
}
