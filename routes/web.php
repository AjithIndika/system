<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SubsidiariesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\OfficeLocationController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\EmployeeEnrolmentTypeController;
use App\Http\Controllers\EnrolmentLeaveSetup;
use App\Http\Controllers\EnrolmentLeaveSetupController;
use App\Http\Controllers\JobDescriptionController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AccountDetailsController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\IncresmentController;
use App\Http\Controllers\UserLeaveSetupController;
use App\Http\Controllers\DocumentControllController;
use App\Http\Controllers\LeaveRequstController;
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProbationaryPerformnceAppraisalFormJuniorStaffController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\EqupmentTypeController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\NewsAlertController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrganizationChartController;
use App\Http\Controllers\ReportChartController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\EducationdetailsController;
use App\Http\Controllers\TraningDevelopController;
use App\Http\Controllers\LeaveRequestAlertController;
use App\Http\Controllers\RepairReceiveController;
use App\Http\Controllers\OnbordController;
use App\Http\Controllers\ShedulejobsController;
use App\Http\Controllers\OffbordTaskController;
use App\Http\Controllers\ProjctnameController;
use App\Http\Controllers\Outsiderejester;










use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
//use Image;
Use Alert;
use Redirect;
use Illuminate\Support\Carbon;
use App\Http\Controllers\BulkEmailSendController;





Auth::routes();




Route::get('/', function () {
  // return view('users/login');
    $data['title'] = 'Login';
     $data['template'] = 'users/login';
   return view('/users/login', compact('data'));
});



  Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');

 });

/*

 Route::any('/login', function(){
    $data['title'] = 'Login';
    $data['template'] = 'users/login';
    return Redirect::to('/');
 });


*/

 Route::get('/dashbord', [HomeController::class, 'index'])->middleware('auth');
 Route::get('/home', [HomeController::class, 'index'])->middleware('auth');



//reportchart

//ReportChart
Route::get('/reportOrg', [ReportChartController::class, 'index'])->middleware('auth');

 // subdires
 Route::any('/subsidiaries', [SubsidiariesController::class, 'index'])->middleware('auth');
 Route::any('/new_subsidiaries', [SubsidiariesController::class, 'create'])->middleware('auth');
 Route::any('/edit_subsidiaries', [SubsidiariesController::class, 'edit'])->middleware('auth');
 Route::any('/delet_sbu_logo', [SubsidiariesController::class, 'deletlogo'])->middleware('auth');
 Route::any('/uplode_sbu_logo', [SubsidiariesController::class, 'uplodelogo'])->middleware('auth');



 //departments
 Route::any('/departments', [DepartmentController::class, 'index'])->middleware('auth');
 Route::any('/new_department', [DepartmentController::class, 'create'])->middleware('auth');
 Route::any('/edit_department', [DepartmentController::class, 'edit'])->middleware('auth');

 //Designations
 Route::any('/designations', [DesignationsController::class, 'index'])->middleware('auth');
 Route::any('/new_designations', [DesignationsController::class, 'create'])->middleware('auth');
 Route::any('/edit_designations', [DesignationsController::class, 'edit'])->middleware('auth');


 //document type
 Route::any('/documentType', [DocumentTypeController::class, 'index'])->middleware('auth');
 Route::any('/new_documentType', [DocumentTypeController::class, 'create'])->middleware('auth');
 Route::any('/update_documentType', [DocumentTypeController::class, 'edit'])->middleware('auth');

 //office location

 Route::any('/officelocation', [OfficeLocationController::class, 'index'])->middleware('auth');
 Route::any('/new_officelocation', [OfficeLocationController::class, 'create'])->middleware('auth');
 Route::any('/update_officelocation', [OfficeLocationController::class, 'edit'])->middleware('auth');


 //LeaveTypeController
 Route::any('/leaveType', [LeaveTypeController::class, 'index'])->middleware('auth');
 Route::any('/new_leaveType', [LeaveTypeController::class, 'create'])->middleware('auth');
 Route::any('/update_leaveType', [LeaveTypeController::class, 'edit'])->middleware('auth');




 //EmployeeEnrolmentTypeController
 Route::any('/enrolmentType', [EmployeeEnrolmentTypeController::class, 'index'])->middleware('auth');
 Route::any('/new_enrolmentType', [EmployeeEnrolmentTypeController::class, 'create'])->middleware('auth');
 Route::any('/update_enrolmentType', [EmployeeEnrolmentTypeController::class, 'edit'])->middleware('auth');


 // enrolment leve setup
 Route::any('/enrolmentLeave', [EnrolmentLeaveSetupController::class, 'index'])->middleware('auth');
 Route::any('/new_enrolmentLeave', [EnrolmentLeaveSetupController::class, 'create'])->middleware('auth');
 Route::any('/update_enrolmentLeave', [EnrolmentLeaveSetupController::class, 'edit'])->middleware('auth');


 // JobDescriptionController
 Route::any('/jd', [JobDescriptionController::class, 'index'])->middleware('auth');
 Route::any('/new_jd', [JobDescriptionController::class, 'create'])->middleware('auth');
 Route::any('/update_jd', [JobDescriptionController::class, 'edit'])->middleware('auth');
 Route::any('/jd_image_remove', [JobDescriptionController::class, 'destroy'])->middleware('auth');
 Route::any('/jd_image_uplode', [JobDescriptionController::class, 'imageUplode'])->middleware('auth');


 //Profile
 Route::any('/newuser', [Outsiderejester::class,'newprofile']); //new profile crate
 Route::any('/savenewuser', [Outsiderejester::class, 'saveprofile']);


 Route::any('/profile', [ProfileController::class, 'index'])->middleware('auth');
 Route::any('/new-profile', [ProfileController::class, 'create'])->middleware('auth');
 Route::any('/save-profile', [ProfileController::class, 'store'])->middleware('auth');
 Route::any('/view-profile/{profile_sug}', [ProfileController::class, 'show'])->middleware('auth');
 Route::any('/jobjoin', [ProfileController::class, 'jobjoin'])->middleware('auth'); /// update jobjoin
 Route::any('/jobworkupdate', [ProfileController::class, 'jobworkupdate'])->middleware('auth'); /// update jobjoin
 Route::any('/newjobwork', [ProfileController::class, 'newjobwork'])->middleware('auth'); /// update jobjoin
 Route::any('/uplode_profile_image', [ProfileController::class, 'uplodeprofileimage'])->middleware('auth'); /// update jobjoin
 Route::any('/delet_profile_image', [ProfileController::class, 'deletprofileimage'])->middleware('auth'); /// update jobjoin
 Route::any('/edit_profile_personal_details', [ProfileController::class, 'profilePersonaldetailsUpdate'])->middleware('auth'); /// update jobjoin

 Route::any('/view-profile2/{profile_sug}', [ProfileController::class, 'showp'])->middleware('auth');
 Route::any('/allprofileupdaterequst', [ProfileController::class, 'allprofileupdaterequst'])->middleware('auth');
 Route::any('/updaterequst', [ProfileController::class, 'updaterequst'])->middleware('auth');
 Route::any('/resignation', [ProfileController::class, 'resignation'])->middleware('auth');
 Route::any('/resignationStatus', [ProfileController::class, 'resignationStatus'])->middleware('auth');




 //work expireance
 Route::any('/workexperience', [ WorkExperienceController::class, 'workexperience'])->middleware('auth');
 Route::any('/deletexperience', [ WorkExperienceController::class, 'deletexperience'])->middleware('auth');


 //education
 Route::any('/educationadd', [EducationdetailsController::class, 'education'])->middleware('auth');
 Route::any('/deleteducation', [EducationdetailsController::class, 'deleteducation'])->middleware('auth');

 // traning and devlopment

 Route::any('/new_traning_divelopment', [TraningDevelopController::class, 'newtraning'])->middleware('auth');
 Route::any('/deletetraning', [TraningDevelopController::class, 'deletetraning'])->middleware('auth');




 //bank account
 Route::any('/new_bank_account', [AccountDetailsController::class, 'index'])->middleware('auth'); /// new account
 Route::any('/update_bank_account', [AccountDetailsController::class, 'create'])->middleware('auth'); /// update account

//salary
Route::any('/addtosalary', [SalaryController::class,'create']); /// update account
Route::any('/editsalary/{profile_id}', [SalaryController::class,'edit']); /// update account
Route::any('/updatetosalary', [SalaryController::class,'update']); /// update account
Route::any('/SalaryReport', [SalaryController::class,'SalaryReport']); /// update account

//Allowance
Route::any('/addtoAllowance', [ProfileController::class,'addtoAllowance']); /// update account


// bonusBulkadd
Route::any('/bonusBulkadd', [BonusController::class,'index']); /// bonusBulkadd
Route::any('/bonusBulkaddnew', [BonusController::class,'bonusBulkaddnew']); /// update account
Route::any('/bonusBulk_befor', [BonusController::class,'bonusBulkbefor']); /// update account
Route::any('/run_bonusBulk_befor', [BonusController::class,'runbonusBulkbefor']); /// update account



//incrsment
Route::any('/addtoincresment', [IncresmentController::class,'create']); /// update account
Route::any('/editincresment/{incresments_id}', [IncresmentController::class,'index']); /// edit  incresment
Route::any('/updatetoincresment', [IncresmentController::class,'edit']); /// update account



 // UserLeaveSetupController

 Route::any('/addNewLeaveRule', [UserLeaveSetupController::class,'create'])->middleware('auth'); /// add leave rule
 Route::any('/updateLeaveRule', [UserLeaveSetupController::class,'update'])->middleware('auth'); /// update leave rule


 // uplode document

 Route::any('/uplode_document', [DocumentControllController::class,'create'])->middleware('auth'); /// update account
 Route::any('/delet_document', [DocumentControllController::class,'destroy'])->middleware('auth'); /// update account


 //newaccount
 Route::any('/newaccount', [UserContollAccountController::class,'create'])->middleware('auth'); /// update account
 Route::any('/editaccount', [UserContollAccountController::class,'edit'])->middleware('auth'); /// update account
 Route::any('/deletaccount', [UserContollAccountController::class,'destroy'])->middleware('auth'); /// update account
 Route::any('/password_chage', [UserContollAccountController::class,'password'])->middleware('auth'); /// update account
  /// update account




//user permition update
 Route::any('/userlist', [UserContollAccountController::class,'userlist'])->middleware('auth'); /// it user permition
 Route::any('/userupdate', [UserContollAccountController::class,'userupdate'])->middleware('auth'); /// it user permition



 //invoicenumberupdate



 //leve all

 Route::any('/leaveFrom', [LeaveRequstController::class,'index'])->middleware('auth');
 Route::any('/leaverequst', [LeaveRequstController::class,'create'])->middleware('auth');
 Route::any('/subsidiaries-leave', [LeaveRequstController::class,'show'])->middleware('auth'); /// leave requst list
 Route::any('/leavehedupdate', [LeaveRequstController::class,'edit'])->middleware('auth');

 Route::any('/approved-leave', [LeaveRequstController::class,'approvedLeave'])->middleware('auth'); /// approved leave
 Route::any('/reject-leave', [LeaveRequstController::class,'rejectLeave'])->middleware('auth'); /// reject leave
 Route::any('/leveallorg/{year}', [LeaveRequstController::class, 'leveallorg'])->middleware('auth'); // leave al org
 Route::any('/subdiaryleavereport/{org}/{date}', [LeaveRequstController::class, 'subdiaryleavereport'])->middleware('auth'); // leave al org


 //religion
 Route::any('/religion', [ReligionController::class,'index'])->middleware('auth');
 Route::any('/new-religon', [ReligionController::class,'create'])->middleware('auth');
 Route::any('/edit-religon', [ReligionController::class,'edit'])->middleware('auth');

 Route::any('/religions', [ReligionController::class,'religionsAll'])->middleware('auth');
 Route::any('/religenCount/{religion_id}', [ReligionController::class,'religionscount'])->middleware('auth');


 // report
 Route::any('/subwice-profile', [ReportAllController::class,'subwiceprofile'])->middleware('auth');
 Route::any('/deparmrnt-wice', [ReportAllController::class,'departmentWice'])->middleware('auth');
 Route::any('/sbu-deparmrnt-wice', [ReportAllController::class,'sudepartmentWice'])->middleware('auth');
 Route::any('/office-location-wice', [ReportAllController::class,'officelocationwice'])->middleware('auth');
 Route::any('/reportDashbord', [ReportAllController::class,'reportDashbord'])->middleware('auth');
 Route::any('/allactivecontact', [ReportAllController::class,'allactivecontact'])->middleware('auth');
 Route::any('/CustomReport', [ReportAllController::class,'CustomReport'])->middleware('auth');


 //live serch
 Route::any('/live-serch', [SearchController::class,'index'])->middleware('auth');



 //// Performnce Appraisal Form

 Route::get('appraisal_form_junior_staff/{profile_sug}', [ProbationaryPerformnceAppraisalFormJuniorStaffController::class, 'index'])->middleware('auth');
 Route::any('appraisalFormJuniorStaffSave', [ProbationaryPerformnceAppraisalFormJuniorStaffController::class, 'create'])->middleware('auth');


//EqupmentTypeController
Route::get('new_equpment_type', [EqupmentTypeController::class, 'index'])->middleware('auth');
Route::any('equpment_save', [EqupmentTypeController::class, 'create'])->middleware('auth');
Route::any('equpmentBrand', [EqupmentTypeController::class, 'equpmentBrand'])->middleware('auth');
Route::any('newequbrand', [EqupmentTypeController::class, 'newequbrand'])->middleware('auth');
Route::any('updateequbrand', [EqupmentTypeController::class, 'updateequbrand'])->middleware('auth');




//IssueController
Route::get('new_issue', [IssueController::class, 'index']);
Route::any('issue_save', [IssueController::class, 'create']);
Route::any('issue_update', [IssueController::class, 'edit']);


 //TicketsController
 Route::get('new_tickts', [TicketsController::class, 'index']);
 Route::any('new_save', [TicketsController::class, 'create']);
 Route::any('pendingticket', [ReportAllController::class, 'pendingticket'])->middleware('auth'); // crate
 Route::any('viewticket', [ReportAllController::class, 'pendingViewticket'])->middleware('auth'); //view
 Route::any('processticket', [ReportAllController::class, 'processticket'])->middleware('auth'); //prosess
 Route::any('finshticket', [ReportAllController::class, 'finshticket'])->middleware('auth'); //finsh
 Route::any('ticket_dashbord', [TicketsController::class, 'tickat_dash'])->middleware('auth'); //dashbord
 Route::any('ticket_update', [ReportAllController::class, 'ticketupdate'])->middleware('auth'); //dashbord
 Route::any('weeklyreport', [TicketsController::class, 'weeklyreport'])->middleware('auth'); //dashbord
 Route::any('allticket', [TicketsController::class, 'allticket'])->middleware('auth'); //dashbord
 Route::any('ticketstatus', [TicketsController::class, 'ticketstatus'])->middleware('auth'); //dashbord
 Route::any('donetickets', [TicketsController::class, 'donetickets'])->middleware('auth'); //dashbord
 Route::any('ticketsave', [TicketsController::class, 'newtickets'])->middleware('auth');
 Route::any('ticketsummaryDate', [TicketsController::class, 'ticketsummaryDate'])->middleware('auth');
 Route::any('ticketOwner', [TicketsController::class, 'ticketOwner'])->middleware('auth');
 Route::any('ticket_ownerWice', [TicketsController::class, 'ticket_ownerWice'])->middleware('auth');
 Route::any('target_date_update', [TicketsController::class, 'target_date_update'])->middleware('auth');


 Route::any('ticket_report', [TicketsController::class, 'ticket_report'])->middleware('auth');
 Route::any('ticket_get_report', [TicketsController::class, 'ticket_get_report'])->middleware('auth');




 /// invoicebale
 Route::any('invoicable_Ticket', [InvoiceController::class, 'invoicableTicket'])->middleware('auth'); //dashbord
 Route::any('invoicenumberupdate', [InvoiceController::class, 'invoicenumberupdate'])->middleware('auth'); //dashbord


 Route::any('oneTicket/{tickets_number}', [ReportAllController::class, 'oneTicket'])->middleware('auth');
 Route::any('ticket_step_save', [ReportAllController::class, 'steprecords'])->middleware('auth');


 ///DailyTaskController
 Route::any('/newtask', [DailyTaskController::class, 'index'])->middleware('auth');
 Route::any('/new_task_save', [DailyTaskController::class, 'create'])->middleware('auth');
 Route::any('/pending_daily_tasks', [DailyTaskController::class, 'pending_daily_tasks'])->middleware('auth');
 Route::any('/pending_Viewd_daily_tasks', [DailyTaskController::class, 'pending_Viewd_aily_tasks'])->middleware('auth');
 Route::any('/process_daily_tasks', [DailyTaskController::class, 'process_daily_tasks'])->middleware('auth');
 Route::any('/finsh_daily_tasks', [DailyTaskController::class, 'finsh_daily_tasks'])->middleware('auth');

 Route::any('daily_tasks_update', [DailyTaskController::class,'daily_tasks_updatesave'])->middleware('auth');
 Route::any('daily_tasks_step_save', [DailyTaskController::class,'steprecords'])->middleware('auth');
 Route::any('invoicable_Task', [DailyTaskController::class,'tikerteTask'])->middleware('auth');
 Route::any('taskinvoiceupdate', [DailyTaskController::class,'daily_tasks_updatesave'])->middleware('auth');


 Route::any('oneDailyTask/{daily_tasks_number}', [DailyTaskController::class,'oneDailyTask'])->middleware('auth');



//new notes

Route::any('new-notes-addd', [NoteController::class,'create'])->middleware('auth');



 //email
 Route::get('send-mail', [MailController::class, 'build'])->middleware('auth');
 Route::get('send-password-mail', [MailController::class, 'build'])->middleware('auth');

 // bulk email sender


 Route::any('one_email', [BulkEmailSendController::class, 'index'])->middleware('auth');
 Route::any('one_email_send', [BulkEmailSendController::class, 'create'])->middleware('auth');
 Route::any('activeuseremail', [BulkEmailSendController::class, 'activeuseremail'])->middleware('auth');
 Route::any('activeuseremailSend', [BulkEmailSendController::class, 'activeuseremailSend'])->middleware('auth');


//news
Route::any('new_news', [NewsAlertController::class, 'index'])->middleware('auth');
Route::any('newsCrate',[NewsAlertController::class, 'store'])->middleware('auth');
Route::any('newsRead/{news_slug}',[NewsAlertController::class, 'newsRead'])->middleware('auth');
Route::any('allNews',[NewsAlertController::class, 'newslist'])->middleware('auth');


// new equpment
Route::any('new_qupment',[EquipmentController::class, 'index'])->middleware('auth');
Route::any('equpment_crate',[EquipmentController::class, 'create'])->middleware('auth');
Route::any('equlist',[EquipmentController::class, 'equlist'])->middleware('auth');
Route::any('organization_pc',[EquipmentController::class, 'organizationPc'])->middleware('auth');
Route::any('organization_pc',[EquipmentController::class, 'organizationPc'])->middleware('auth');
Route::any('equpment/{qupmentID}',[EquipmentController::class, 'equpment_view'])->middleware('auth');
Route::any('equpment_update',[EquipmentController::class, 'equpment_update'])->middleware('auth');
Route::any('venderInvoiceDelete',[EquipmentController::class, 'venderInvoiceDelete'])->middleware('auth');
Route::any('vander_invoice_upload',[EquipmentController::class, 'vander_invoice_upload'])->middleware('auth');
Route::any('asset_invoice_upload',[EquipmentController::class, 'asset_invoice_upload'])->middleware('auth');
Route::any('live_pcview', [EquipmentController::class, 'live_pcview'])->middleware('auth');
Route::any("equpmentuserupdate", [EquipmentController::class,"equpmentuserupdate"])->middleware('auth');
Route::any("removeEqu", [EquipmentController::class,"removeEqu"])->middleware('auth'); // from user
Route::any("allorganizationpc", [EquipmentController::class,"allorganizationpc"])->middleware('auth'); // from user
Route::any("organization_it_equipment_list", [EquipmentController::class,"organization_it_equipment_list"])->middleware('auth'); // equpment controler
Route::any("location_it_equipment_list", [EquipmentController::class,"location_it_equipment_list"])->middleware('auth'); // equpment controler




//venders_rejestration

Route::any('venders_rejestration',[SupplierController::class, 'index'])->middleware('auth');
Route::any('new_venders',[SupplierController::class, 'create'])->middleware('auth');
Route::any('update_venders',[SupplierController::class, 'store'])->middleware('auth');


Route::any('setup_organization',[OrganizationChartController::class, 'index'])->middleware('auth');
Route::any('newOrganatiazion/{subdiary}',[OrganizationChartController::class, 'newOrganatiazion'])->middleware('auth');
Route::any('viewOrganatiazion/{subdiary}',[OrganizationChartController::class, 'viewOrganatiazion'])->middleware('auth');
Route::any('orgChartCrate',[OrganizationChartController::class, 'orgChartCrate'])->middleware('auth');
Route::any('editOrganatiazion/{subdiary}',[OrganizationChartController::class, 'editOrganatiazion'])->middleware('auth');
Route::any('updateOrganatiazion',[OrganizationChartController::class, 'updateOrganatiazion'])->middleware('auth');

Route::any('deletOrganatiazion',[OrganizationChartController::class, 'deletOrganatiazion'])->middleware('auth');



 // leave request allert
 Route::any('/leaveRequestAlert', [LeaveRequestAlertController::class,'leaveRequestAlert'])->middleware('auth');
 Route::any('/cratenewleaveRequestAlert', [LeaveRequestAlertController::class,'cratenew'])->middleware('auth');
 Route::any('/removealeert', [LeaveRequestAlertController::class,'removealeert'])->middleware('auth');



//recive all


Route::any('/to_repair_receive', [RepairReceiveController::class,'index'])->middleware('auth');
Route::any('/reciveitems', [RepairReceiveController::class,'cratenew'])->middleware('auth');
Route::any('/sedtoRepirForm', [RepairReceiveController::class,'sedtoRepirForm'])->middleware('auth');
Route::any('/addservicecenter', [RepairReceiveController::class,'addservicecenter'])->middleware('auth');
Route::any('/addsendingItems', [RepairReceiveController::class,'addsendingItems'])->middleware('auth');
Route::any('/addsendingItemsremove', [RepairReceiveController::class,'addsendingItemsremove'])->middleware('auth');
Route::any('/addsendingItemsprocess', [RepairReceiveController::class,'addsendingItemsprocess'])->middleware('auth');
Route::any('/repirsendPrint/{hitorynumber}', [RepairReceiveController::class,'repirsendPrint'])->middleware('auth');
Route::any('/repierReciveRepierCenter', [RepairReceiveController::class,'repierReciveRepierCenter'])->middleware('auth');

//onbord
Route::any('/newonbord', [OnbordController::class,'newonbord'])->middleware('auth');
Route::any('/removeonbord', [OnbordController::class,'removeonbord'])->middleware('auth');

// offbord

Route::any('/newoffbord', [OffbordTaskController::class,'newoffbord'])->middleware('auth');
Route::any('/removeoffbord', [OffbordTaskController::class,'removeoffbord'])->middleware('auth');





//shedule
Route::any('/onbordnotification', [ShedulejobsController::class,'onbordnotification']);
Route::any('/onbordnotification_daily', [ShedulejobsController::class,'onbordnotification_daily']);

Route::any('/offbordnotification', [ShedulejobsController::class,'offbordnotification']);
Route::any('/offbordnotification_daily', [ShedulejobsController::class,'offbordnotification_daily']);
Route::any('/bithdaywishtoday', [ShedulejobsController::class,'bithdaywishtoday']);
Route::any('/pandingJobsallert', [ShedulejobsController::class,'pandingJobsallert']);
Route::any('/invoiceremaind', [ShedulejobsController::class,'invoiceremaind']);

//project
Route::any('/project', [ProjctnameController::class,'index']);
Route::any('/saveproject', [ProjctnameController::class,'saveproject']);
Route::any('/projectlist', [ProjctnameController::class,'projectlist']);
Route::any('/editproject', [ProjctnameController::class,'editproject']);











/*
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_USERNAME=it@assetnetworks.net
MAIL_PASSWORD=MageAmma@1989
MAIL_ENCRYPTION=STARTTLS
MAIL_FROM_ADDRESS="it@assetnetworks.net"
MAIL_FROM_NAME="${APP_NAME}"
*/
