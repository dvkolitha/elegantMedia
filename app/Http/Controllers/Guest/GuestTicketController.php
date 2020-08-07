<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestRequests\GuestTicket\GuestTicketStore;
use App\Repositories\GuestRepositories\GuestTicketRepositoryInterface;
use Illuminate\Http\Request;
use Validator;

class GuestTicketController extends Controller 
{

    protected $guestRepo;
            /**
             * summary
             */
public function __construct(GuestTicketRepositoryInterface $guestRepository)
            {

               $this->guestRepo =  $guestRepository;
               $this->middleware('auth')->only('show');
            }


    public function welcome()
    {
        return view('home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Guest.CreateTicket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestTicketStore $request)
    {
         if ($this->guestRepo->store($request->form)) {
             return response()->json(['success'=>'Added new records.']);
         }
         return response()->json(['errors'=>'there is error']);       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $guestTicket = $this->guestRepo->find($id);
      return view('Guest.ShowTicket',compact('guestTicket'));
    }

   public function ticketDashboard($referenceId)
   {
       # code...
   }
}
