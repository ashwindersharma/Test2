<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Project in Laravel</title>
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"> --}}

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>

.center {

justify-content: center;
    text-align: center;


}


            body {
                font-family: 'Nunito', sans-serif;
            }


            .button {
  padding: 13px 23px;
  font-size: 15px;
  text-align: center;
  color: #f6f4f7;

  background-color:#6c63ff;
  outline: none;
  border: none;
  border-radius: 29px;
  opacity: 0.7;

}
.button:focus{
    outline: none;
}
.button:hover {
    background-color:#b1a2fc;
    outline: none;
    border: none;}

.button:active {
  background-color: #887acc;
  transform: translateY(2px);
  outline: none;
  border: none;
}

        </style>
    </head>
    <body style="height: 100%; align-items='center'">

            <div style=" margin-left :40px;margin-top:40px;  height: 100px;width:50%">
                    <img style="opacity: 0.7;" src = {{asset('logo/book_logo.svg')}} alt="Book SVG"/>
            </div>
        {{-- <div  style=" height: 80vh;  align-items: center;
        justify-content: center;"   > --}}
            @if (Route::has('login'))
                <div class=" fixed top-0 right-0 px-10 py-8 sm:block">
                    @auth
                    <button type="button" class="button">Dashboard</button>
                        {{-- <a   href="{{ url('/dashboard') }}" class="subscribe-button">Dashboard</a> --}}
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif



                        {{-- </div> --}}
                        {{-- @auth
                         The user is logged in ...Please visit the dashboard
                    @endauth

                    @guest
                         The user is not login...
                    @endguest --}}






    </body>
</html>
