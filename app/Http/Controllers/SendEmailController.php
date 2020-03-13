<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Mail\SendEmail;

class SendEmailController extends Controller

{
    //
    function index()
    {
        return view('Filieres.send');
    }
    public function sendmail(Request $request){
        $data["email"]=$request->get("email");
        $data["email"] = str_replace(' ', '', $data["email"]);
        $data["name"]=$request->get("name");
        $data["message"]=$request->get("message");
        $data["subject"]="Subject test";

        $pdf = PDF::loadView('Filieres.mail', $data);
       // Mail::to($data["email"])->send(new SendEmail($data["message"],$data["subject"]));
       // return back()->with('success', 'Thanks for contacting us!');

       try{
            Mail::send('Filieres.mail', $data, function($message)use($data,$pdf) {
                $message->to($data["email"], $data["name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";

        }else{

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }
}

