<?php
namespace App\Repositories\GuestRepositories;
 
use App\Guest\GuestTicket;
use App\Mail\Guest\WelcomeMail;
use App\Mail\SupportAgent\ReplyMail;
use App\Repositories\BaseRepository\BaseRepository;
use App\Repositories\GuestRepositories\GuestTicketRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
/**
 * 
 */

class GuestTicketRepository extends BaseRepository implements GuestTicketRepositoryInterface
{

	protected $model;

	public function __construct(GuestTicket $guestTicket)
	{
		$this->model = $guestTicket;
	}
 
    public function store(array $data)
    {
    	DB::beginTransaction();
    	try {
    		$reference_number = $this->createRefNumber();
    		$data['reference_number'] = $reference_number;
    		$this->create($data);
    		$data['password']=bcrypt($reference_number);
    	  $this->createUser($data);
        $this->sendEmail($reference_number,$data['email']);
    		DB::commit();
    		return true;
    	} catch (Exception $e) {
    		DB::rollBack();
    		return false;
    	}
    	
    }


    public function createRefNumber()
    {
      
      $time=time();
      $reference_number = "".str_random(5)."".$time."";
      
      //used recursion algorithm
      $check_reference_number = GuestTicket::where('reference_number',$reference_number)->first();
      if(is_null($check_reference_number)){
      	return $reference_number;
      }else{
      	$this->createRefNumber();
      }
    }


	public function sendEmail($reference_number,$customerEmail)
	{
	  $data = [ 
	   "reference_number"=> $reference_number
	  ];
	  Mail::send(new WelcomeMail($data,$customerEmail));
	}


	public function createUser(array $data)
	{
		User::create($data);	
	}


  public function viewByAgent($id)
  {
    $ticket = $this->find($id);
    $ticket->is_open = 1 ;
    $ticket->save();
  }


  public function sendReply($referenceNumber,$reply,$customerMail)
  {
    DB::beginTransaction();
    try {
      $ticket =  GuestTicket::where('reference_number',$referenceNumber)->first();
      $this->viewByAgent($ticket->id);
      $ticket->reply = $reply;
      $ticket->save();
      $this->sendReplyMail($referenceNumber,$reply,$customerMail);
      DB::commit();
      return true;
    } catch (Exception $e) {
      DB::rollBack();
      return false;
    }
  }


  public function sendReplyMail($reference_number,$reply,$customerMail)
  {
    $data = [ 
     "reference_number"=> $reference_number,
     "reply" => $reply
    ];
    Mail::send(new ReplyMail($data,$customerMail));
  }


}