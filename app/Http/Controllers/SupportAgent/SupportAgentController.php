<?php

namespace App\Http\Controllers\SupportAgent;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportAgentRequests\ReplyStore;
use App\Repositories\GuestRepositories\GuestTicketRepositoryInterface;
use Illuminate\Http\Request;

class SupportAgentController extends Controller
{
    protected $guestRepo;
	          
	public function __construct(GuestTicketRepositoryInterface $guestRepository)
	            {
	               $this->guestRepo =  $guestRepository;
	               $this->middleware(['auth','isSupportAgent']);
	            }
    public function index()
    {
    	return view('supportAgent.adminDashboard');
    }
    public function ticketList()
    {
    	 $ticketList = $this->guestRepo->viewAll();
    	 return view('supportAgent.ticket.ticketList',compact('ticketList'));
    }
    public function ticketReply(ReplyStore $request)
    {
        $this->guestRepo->sendReply($request->reference_number,$request->reply,$request->customer_email);
    }
    public function viewTicket($ticketId)
    {
    	
    	$this->guestRepo->viewByAgent($ticketId);
    	$guestTicket = $this->guestRepo->find($ticketId);
    	return view('supportAgent.ticket.ShowTicket',compact('guestTicket'));
    }
}
