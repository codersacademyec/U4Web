<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inicioController extends Controller
{
    public function mensaje(Request $request){

     $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required',
            'asunto' => 'required',
            'mensaje' => 'required',
        ]);

     $email_to = 'info@u4crm.com';
     $email_subject = $request->input('asunto');
	 $email_from = $request->input('email');

    $email_message = "Detalles del formulario de contacto:\n\n";
	$email_message .= "Nombre y Apellido: " . $request->input('nombre') . "\n";
	$email_message .= "E-mail: " . $request->input('email') . "\n";
	$email_message .= "Mensaje: " . $request->input('mensaje') . "\n\n";

    $headers = "From: " . " <" . $email_from . ">" . "\r\n" ;
	$headers.= "Reply-To: " . " <" . $email_from . ">" . "\r\n" ;

	$headers.= "cc: " . $email_from . " <" . $email_from . ">" . "\r\n" ;
	mail($email_to, $email_subject, $email_message, $headers);

    return redirect()->route('index');
    //->with('message', 'Mensaje enviado');
    //dd($request->all());
    }
}
