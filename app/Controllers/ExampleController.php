<?php
namespace App\Controllers;

use App\Services\APIService;
use App\Services\MailService;

class ExampleController extends Controller
{
	public function __construct()
	{

	}

	public function index()
	{
		$title = 'Example View';
		view('example.index', compact('title'));
	}

	public function sendMail()
	{
		$mail = new MailService;
		$to = "Kyaw Kyaw Soe <kyawkyaw@global-connect.asia>";
		$subject = "This is Subject";
		$mail->html('mail.example',['title'=>"Newsletter"])->send($to, $subject);
	}

	public function consumeAPI()
	{
		$api_service = new APIService;
		$access_token = $api_service->requestToken('client_credentials')['access_token'];
		$invitee_url = config('api.base_url')."services/events/".config('event.id').'/invitees';
		pd($api_service->request($invitee_url,'GET' ,['page'=>'2'] ,$access_token));
	}

}