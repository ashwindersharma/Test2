<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alter Users') }}
        </h2>
    </x-slot>
    @include('adduser_button')
    <div>
    <span></span>
    <div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of Users</div>

                    <div class="panel-body">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th> Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $dat)
                                <tr>

                                    <td>{{ $dat->name }}</td>
                                    <td>{{ $dat->email }}</td>
                                     <td><input  id="input{{$dat->id}}"   disabled  value="enabled"></td>
                                    <td><button  type="button" class="btn btn-primary edit"  name="disable" id="{{ $dat->id}}">DELETE USER</button></td>

                                </tr>
                            @endforeach
                            @foreach ($deleted as $dat)
                            <tr>

                                    <td>{{ $dat->name }}</td>
                                    <td>{{ $dat->email }}</td>
                                    <td><input  id="input{{$dat->id}}"  disabled  value="deleted"></td>
                                    <td><button  type="button" class="btn btn-primary edit"  name="enable" id="{{$dat->id}}">ENABLE USER</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @if(Session::has('success'))
            <p class="alert alert-info">{{ Session::get('success') }}</p>
        @endif

    <!-- Modal content -->
    <div id="myModal" class="modal">
    <div class="modal-content">
    <x-jet-validation-errors id="error" class="mb-4"/>
     <form method="POST"  id="fm" action="{{ route('users.add') }}">
            @csrf
            <div>
                <x-jet-label for="name"  value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <h5 id="usercheck" style="color: red;" >
                    **PLEASE ENTER USERNAME
              </h5>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <h5 id="emailvalid" style="color: red;" >
                   Email is missing
              </h5>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password1" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                <h5 id="passcheck" style="color: red;"> </h5>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required  />
                <h5 id="conpasscheck" style="color: red;">**Password didn't match</h5>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4" id="aduser" >
                    {{ __('Add User') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
<script>

   window.onclick = function(event)
                 {
                    var modal = document.getElementById("myModal");
                    if (event.target == modal)
                     {
                      $('#fm').trigger('reset');
                      modal.style.display = "none";

                     }


                  }


        $('#adduser').click(function() {
            $('#error').html('');
             var modal = document.getElementById("myModal");
             modal.style.display = "block";
             $('#usercheck').hide();

             $('#emailvalid').hide();
             $('#passcheck').hide();

 });
</script>

    <script>

        $(document).ready( function ()
         {
            $('#datatable').DataTable();
            });


    $('.edit').click(function() {
        var tw = $(this).attr("id");
        var tr = $(this).closest('tr');
        var id = tr.children();
        var i=$(id[2]).children().val();
        var status= $(this).attr("name");
        var s=[tw,i,status];
        $.ajax({
            url:"{{route('users.action')}}",
            method:'post',
            data:{"_token": "{{ csrf_token() }}","dat": s},
            datatype:'json',
            success:function(data)
            {
             if(data)
                {
                    document.location = "{{route('users.controls')}}";
                }

            }
        })
    });




    </script>

<script>
 if("{{$errors}}".length>2){
                var modal = document.getElementById("myModal");
                    modal.style.display = "block";

//                     window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
            }
</script>

<script>

// Document is ready
$(document).ready(function () {

         $('#usercheck').hide();
        let usernameError = true;
        $('#name').keyup(function () {
            validateUsername();
        });

        function validateUsername() {
        let usernameValue = $('#name').val();
        if (usernameValue.length == '')
        {
            $('#usercheck').show();
            $('#usercheck').html("**user name is required");
            usernameError = false;
            return false;
        }
        else if((usernameValue.length < 3)) {
            $('#usercheck').show();
            $('#usercheck').html("**length of username must be greater than 2");
            usernameError = false;
            return false;
        }
        else {
            $('#usercheck').hide();
            usernameError = true;
            return true;
        }
        }
// emial

        let emailerror = true;
        $('#emailvalid').hide();
        $('#email').keydown(function () {
            validateEmail();
        });

        function validateEmail()
        {
            let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let emailValue = $('#email').val();
        if (emailValue.length == '')
        {
            console.log('email');
            $('#emailvalid').show();
            $('#emailvalid').html("**Email is required");
            emailerror= false;
            return false;
        }
        else if(!regex.test(emailValue))
        {
            $('#emailvalid').show();
            $('#emailvalid').html("**Please eneter valid mail id");
            emailerror = false;
            return false;
        }
        else {
            $('#emailvalid').hide();
            emailerror = true;
            return true;
        }
        }
    // Validate Password
        $('#passcheck').hide();
        let passwordError = false;
           $("#password1").blur(function () {
            validatePassword();
        });


        function validatePassword() {
            let passwrdValue = $('#password1').val();
            if (passwrdValue.length ==0) {
               console.log('password')
                $("#passcheck").show();
                $("#passcheck").html("*password is required");
                passwordError = false;
                return false;
            }
            else if ((passwrdValue.length > 3) && (passwrdValue.length < 10)) {
                $('#passcheck').hide();
                passwordError = true;
                return true;
            } else {

                $('#passcheck').show();
                $('#passcheck').html("**length of your password must be between 3 and 10");
                passwordError = false;
                return false;
            }
        }


     $('#conpasscheck').hide();
        let confirmPasswordError = false;
        function validateConfirmPasswrd()
        {
            let confirmPasswordValue =$('#password_confirmation').val();
            let passwrdValue =$('#password1').val();
            if (passwrdValue != confirmPasswordValue) {
                $('#conpasscheck').show();
                $('#conpasscheck').html("**Password didn't Match");
                        confirmPasswordError = false;;
                return false;;

            } else {
                $('#conpasscheck').hide();
                confirmPasswordError = true;

            }
        }
        $('#fm').click(function () {
            validateUsername();
            validatePassword();
            validateConfirmPasswrd();
            console.log(usernameError,passwordError,confirmPasswordError);
            if (
                (usernameError == true) && (passwordError == true) &&  (confirmPasswordError == true) &&
                (emailError == true)) {
                    return true;

            } else {
                return false;
            }
        });
    });

</script>
</x-app-layout>










<!-- //  var table= $('#datatable').DataTable();
         //   $('.edit').click(function() {
        //   var tr = $(this).closest('tr');
        //   var id = tr.children();
        //   var i=$(id[2]).children().attr('id');
        //   $("#"+i).removeAttr("disabled");  -->
