<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;


class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



     // pending tickets
 public function invoicableTicket(){
    $data['title'] = 'Ticket Invoice Pending';
    $data['ticketDetails']= DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.ticket_status','=','Finish')
                            ->where('tickets.ticket_invoisable','=','Yes')
                             ->where('tickets.ticket_invoice_number',null)
                            //->whereRaw('tickets.invoice_amount = ""')

                            ->get();
    $data['template'] = 'invoice/ticketInvoice';
    return view('template/template', compact('data'));
 }

 public function invoicenumberupdate(Request $request)
 {

    $request->validate([
        'ticket_invoice_number' => ['required', 'string', 'max:255'],
    ]);

     $data=array(
       'ticket_invoice_number'=>$request->ticket_invoice_number,
       'ticket_invoice_by'=>Auth::user()->name,
       'ticket_invoice_date'=>date('Y-m-d H:i:s'),
     );
     DB::table('tickets')->where('tickets_id', $request->tickets_id)->update($data);
     return redirect('/invoicable_Ticket')->with('success',$request->ticket_invoice_number.'&nbsp;&nbsp; Save Sucess Full');

 }



 public static function invoicePending(){
    echo DB::table('tickets')
     ->select('*')
     ->where('ticket_invoisable','=','Yes')
    // ->where('ticket_invoice_number','=','')
    ->whereRaw('ticket_invoice_number = "" OR ticket_invoice_number IS NULL')
     ->count();
  }


  public static function sum(){

  $total=  DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.ticket_status','=','Finish')
                            ->where('tickets.ticket_invoisable','=','Yes')
                             ->where('tickets.ticket_invoice_amount','>=',0)
                            //->whereRaw('tickets.invoice_amount = ""')
                            ->sum('ticket_invoice_amount');


    if(!empty($total)){

        echo 'Rs:/  '.number_format($total,2);
    }

  }






}
