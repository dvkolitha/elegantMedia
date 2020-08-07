@extends('layouts.adminDashboard')
@section('page-content')
<!-- page content -->
<!--  watt value -->
<div class="">
<!--   @php
    if (session()->exists('storeStatus')) {
      $sessionData = Session::get('storeStatus');
      echo '<div class="alert alert-success notificationItem" style="margin-top: 50px;"><strong>Success!</strong>'.$sessionData.'</div>';
    } else if (session()->exists('editStatus')) {
      $sessionData = Session::get('editStatus');
      echo '<div class="alert alert-info notificationItem" style="margin-top: 50px;"><strong>Edited!</strong> '.$sessionData.'</div>';
    }
    
  @endphp -->
 
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Customer tickets<small>tables</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <p class="text-muted font-13 m-b-30">
       
      </p>
      <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
        <thead>
          <tr>
            <th>name</th>
            <th>reference number</th>
            <th>customer email</th>
            <th>problem</th>
            <th>view by a agent</th>
            <th>reply</th>
            <th>action</th>
          </tr>
        </thead>


        <tbody>
              @foreach($ticketList as $ticketList)
              <tr>
                 @if ($ticketList->is_open == 0)
                     <td style="background-color: blue;color: white;">{{$ticketList->name}}</td>
                     <td style="background-color: blue;color: white;">{{$ticketList->reference_number}}</td>
                     <td>{{$ticketList->email}}</td>
                     <td>{{$ticketList->problem}}</td>
                     <td>
                       @if ($ticketList->is_open == 0)
                         No
                       @else
                         Yes
                       @endif
                     </td>
                     <td>
                       @if ($ticketList->reply)
                         {{$ticketList->reply}}
                       @endif
                     </td>
                     <td>
                       @if (!$ticketList->reply)
                         <button data-toggle="modal" data-target="#replyModal" class="btn btn-primary reply" data-email="{{$ticketList->email}}" data-customer="{{$ticketList->name}}" data-reference="{{$ticketList->reference_number}}" data-problem="{{$ticketList->problem}}">Reply to the Ticket</button>
                       @else
                         <button  class="btn btn-success reply" >Already Replyed</button>
                       @endif
                       
                       <a href="{{url('/ticket/view',$ticketList->id)}}" class="btn btn-default">View Ticket</a>
                     </td>
                 @else
                     <td>{{$ticketList->name}}</td>
                     <td>{{$ticketList->reference_number}}</td>
                     <td>{{$ticketList->email}}</td>
                     <td>{{$ticketList->problem}}</td>
                      <td>
                       @if ($ticketList->is_open == 0)
                         No
                       @else
                         Yes
                       @endif
                     </td>
                     <td>
                       @if ($ticketList->reply)
                         {{$ticketList->reply}}
                       @endif
                     </td>
                     <td>
                       @if (!$ticketList->reply)
                         <button data-toggle="modal" data-target="#replyModal" class="btn btn-primary reply" data-email="{{$ticketList->email}}" data-customer="{{$ticketList->name}}" data-reference="{{$ticketList->reference_number}}" data-problem="{{$ticketList->problem}}">Reply to the Ticket</button>
                       @else
                         <button  class="btn btn-success reply" >Already Replyed</button>
                       @endif
                       
                       <a href="{{url('/ticket/view',$ticketList->id)}}" class="btn btn-default">View Ticket</a>
                     </td>
                 @endif 
              </tr>
              @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- modal for reply --}}
<div class="modal fade" id="replyModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="height:50px;background-color: #009688">
          <button type="button" class="close" ><i class="fas fa-window-close"data-dismiss="modal" style="font-size: 24px;"></i></button>
        </div>
        <div class="modal-body">
              <form id="replyForm" action="" method="" accept-charset="utf-8" >
                    <h4 style="text-align: center;">Reply Form</h4>
                    <h3 id="referenceNumber" style="text-align: center;color: red"></h3>
                      <div class="alert alert-danger print-error-msg" style="display:none">

                          <ul></ul>

                      </div>
                      <div >
                         <label for="sender">Customer Name:</label>
                         <input type="text" class="form-control" name="name" id="customerName" disabled="disabled">
                         <input type="text" class="form-control" name="name" id="referenceNumberForSend" disabled="disabled" style="display: none" >
                      </div>
                      <div class="form-group">
                        <label for="sender">Sending Email address:</label>
                        <input type="email" class="form-control" name="sender" id="sender" value="info@elegantmedia.com">
                      </div>
                      <div class="form-group">
                        <label for="receiver">Customer / Receiving Email address:</label>
                        <input type="email" class="form-control" name="receiver" id="receiver" disabled="disabled">
                      </div>
                      <div class="form-group">
                        <label for="">Problem</label>
                        <textarea class="form-control" id="problem" disabled="disabled">
                            
                        </textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Reply</label>
                        <textarea class="form-control" id="replyMessage">
                          
                        </textarea>
                      </div>
                      
                      <button type="" class="btn btn-default">Submit</button>
              </form>
        </div>
        <div class="modal-footer" style="height:40px;background-color: #009688">
          
        </div>
      </div>
    </div>
  </div>
{{-- modal for reply --}}
<div class="clearfix"></div>

<!-- / watt value -->


<!-- /page content -->
@endsection
@section('extra-script')
 <script type="text/javascript">
   //ajax header
   $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
   }); 
   //jquery for email verification
     //jquery for modal
      let jqueryForModal = {
        onclickButton : function () {
          $(document).on('click','.reply',function () {
        $("#replyMessage").val('');
        let customerEmail = $(this).data('email');  
        let customerName = $(this).data('customer');
        let referenceNumber = $(this).data('reference');
        let problem = $(this).data('problem');
        
        jqueryForModal.fillFormData(customerEmail,customerName,referenceNumber,problem)
      });
        },
        fillFormData : function (customerEmail,customerName,referenceNumber,problem) {
          $('#receiver').val(customerEmail); 
          $('#customerName').val(customerName); 
          $('#referenceNumberForSend').val(referenceNumber);
          $('#problem').val(problem);
          $('#referenceNumber').text(referenceNumber); 
        },
        sendData : function (data) {
          const URL = "http://127.0.0.1:8000/dashboard/ticket/reply";
          const METHOD = "post";
          $.ajax("http://127.0.0.1:8000/ticket/reply",{
            data:data,
            method:METHOD,
            success : function (e) {
             $('#replyModal').modal('toggle');
             window.location.href = "http://127.0.0.1:8000/dashboard/ticket/list";
            },
            error  : function (data) {
              printErrorMsg(data.responseJSON.errors);
            }
          });
        }
      };
      let validation = {
        basicValidation:function (value) {
          if (value) {
            return true;
          }else{
            return false;
          }
        },
        emailValidation:function (email) {
          let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(String(email).toLowerCase());
        },
        formValidation : function () {
          let customerEmail =  $('#receiver').val(); 
          let senderEmail =  $('#sender').val(); 
          let customerName = $('#customerName').val(); 
          let referenceNumber = $('#referenceNumberForSend').val();
          let reply = $("#replyMessage").val();
          let data = {
            customer_name : customerName,
            customer_email : customerEmail,
            sender_email : senderEmail,
            reference_number : referenceNumber,
            reply : reply
          };
          if (validation.basicValidation(customerEmail) && validation.basicValidation(senderEmail) && validation.basicValidation(customerName) && validation.basicValidation(referenceNumber) && validation.basicValidation($.trim(reply))) { 
            if(validation.emailValidation(senderEmail)){
              return data;
            }else{
              alert("Please Enter Correct email");
              return false;
            }
          }else {
             alert("Please fill all data");
              return false;
          }
        }
      };

      let  printErrorMsg = function (msg) {

            $(".print-error-msg").find("ul").html('');

            $(".print-error-msg").css('display','block');

            $.each( msg, function( key, value ) {

                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

            });
          };
      let hideErrorMsg = function () {
        $(".print-error-msg").css('display','none');
        $("#invalidPhoneNumber").css("display","none");
      }          

    $(document).ready(function () {
      jqueryForModal.onclickButton();
      $("#replyForm").submit(function (e) {
        hideErrorMsg();
        e.preventDefault();

        if(validation.formValidation()){
         let data = validation.formValidation();
         jqueryForModal.sendData(data);
        }
        
      });
    });
 </script>
@endsection
