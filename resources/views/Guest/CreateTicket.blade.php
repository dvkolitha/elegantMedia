<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Elegant Media </title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="{{URL::asset('css/all.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  </head>

  <body class="login">
    <div>
      <div class="login_wrapper"> 
        <div id="register" class="animate form login_form">
          <section class="login_content">
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="ticketForm">
              <h1>Create A Ticket</h1>
              <div>
                <label for="name">Name</label>
                <input id="name" type="text" class="form-control" placeholder="Name" required="" name="name" />
              </div>
              <div style="margin-bottom: 10px;">
                <label for="problem _description">Problem Description</label>
                <textarea id="problem" class="form-control" placeholder="" required="" name="problem _description">
                  
                </textarea>
              </div>
              <div>
                <label for="email">email</label>
                <input id="email" type="" class="form-control" placeholder="Email" required="" name="email" />
              </div>
              <div>
                <label for="phone_number">Phone Number</label>
                <input id="phoneNumber" type="number" class="form-control" placeholder="Phone Number" required="" name="phone_number" />
                <div id="invalidPhoneNumber" class="alert alert-danger" style="display: none;">
                        <ul>
                                <li>Invalid Phone Number</li>
                        </ul>
                    </div>
              </div>
              <div>

                <button class="btn btn-default submit"  type="submit" style="margin-top: 10px;">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{ route('login') }}" > Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Elegant Media!</h1>
                  <p>©2020 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="{{URL::asset('js/all.js')}}"></script>
  <script>
  //ajax header
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
  }); 
  //validation using Jquery 

    let value; 
    let basicValidation = {
      checkEmpty :function (value) {
        if (value !== "" || value !== null) {
          return true;
        }
         return false;
      }
    };

    let nameValidation;
    let problemValidation;
    let emailValidation;
    let phoneNumberValidation;

    let inputValidation = {
     
     checkName:function () {
      let name = $("#name").val();
       if (basicValidation.checkEmpty(name)) {
        
        //only letters
         let letterAndSpaces = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
         if (name.match(letterAndSpaces)) {   
              nameValidation = name;
            }
            else {
              nameValidation = false;
              //show error
            }
       }
     },
     checkProbleDescription:function () {
      let probDescription = $("#problem").val();
      if (!$.trim($("#problem").val())) {
         problemValidation = false;
      }else {
        problemValidation = probDescription;
      }
     },
     checkEmail:function () {
       let email = $("#email").val();
        if (basicValidation.checkEmpty(email)) {
         const emailFormat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         if (emailFormat.test(String(email).toLowerCase())) {
           emailValidation =email;
         }
         else{
           emailValidation =false;
         }
        }
     },
     checkPhoneNumber:function () {
      let phoneNumber = $("#phoneNumber").val();
       if (basicValidation.checkEmpty(phoneNumber)) {
        //checkfor number and length of number
         if (phoneNumber.length == 10 ) {
           phoneNumberValidation = phoneNumber;
         }
         else{
           $("#invalidPhoneNumber").css("display","block");
           phoneNumberValidation = false;
         }
       }
     }

    };
    let formValidation = function () {
      inputValidation.checkName();
      inputValidation.checkProbleDescription();
      inputValidation.checkEmail();
      inputValidation.checkPhoneNumber();
      if (nameValidation && problemValidation && emailValidation && phoneNumberValidation) {
        return true;
      }
      return false;
    }
  //end validation using Jquery
  //form required Jquery  
   let data;
   let arrangeData = function () {
     data = {
      name:nameValidation,
      problem :problemValidation,
      email :emailValidation,
      phone_number :phoneNumberValidation
     };
   } 

   let sendData = function () {
     console.log('SendData');
     const URL = "http://127.0.0.1:8000/tickets";
     const METHOD = "POST";
     let DATA = {form:data};
     $.ajax(URL,{
      method: METHOD,
      data:DATA ,
      success: function (data) {
        console.log("data.success");
        if($.isEmptyObject(data.errors)){
            swal("Poof! Your Ticket been Created!", {
                 icon: "success",
               }).then(() => {
                   window.location.href = "http://127.0.0.1:8000/";
               });
           
        }else{

            printErrorMsg(data.error);

        }
      },
     error:function (data) {
       console.log("data.errors");
       console.log(data);
       console.log(data.responseJSON);
       console.log(data.responseJSON.errors);
       printErrorMsg(data.responseJSON.errors);
     }
     });
   }
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

  //end of form required Jquery   

    $(document).ready(function () {
      
      //on form submit Jquery  
         $("#ticketForm").submit(function (e) {
         e.preventDefault();
         hideErrorMsg();
         if (formValidation()) {
           arrangeData();
           sendData();
         }
       });
       $("#invalidPhoneNumber").change(function () {
           $("#invalidPhoneNumber").css("display","none");
       });
        
      //end on form submit Jquery    
      
    });
  </script>
</html>
