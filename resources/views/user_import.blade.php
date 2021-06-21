<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import users') }}
        </h2>
    </x-slot>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>


    @if (\Session::has('success'))
    <div class = "alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if(\Session::has('failures'))
<h2    class = "h2">error occured for the following records </h2>
<table class = "table">
    <tr>
        <th>Row</th>
        <th>Error occured at attribute</th>
        <th>Discription</th>
      </tr>
@foreach (\Session::get('failures') as $failure)
@foreach ($failure as $error)
<td>
{{$error->row()}}
</td>
    <td>
        {{$error->attribute()}}
    </td>
  <td>
    {{$error->errors()[0]}}
</td>
</tr>
@endforeach

@endforeach
</table>
@endif
    <div class = "filetab">

    <form id = "myForm" action = "{{route('users.import')}}" enctype = "multipart/form-data"  method = "POST">
        @csrf


             <span>Select the csv:</span>
                <input placeholder="please select a file " type="file" accept=".xlsx, .xls, .csv" name="file">
                <div style="overflow:auto;">
                    <div style="margin-top: 5px;">

                        <button class="btn btn-success"
                         style="background-color: #4CAF50; float:right;" type="submit" >Submit</button>
                    </div>
                </div>


            </form>
        </div>
<script>
        $(document).ready(function(){
            $("#myForm").validate({
                rules: {
                  file: "required",
                  accept:"csv,xls"
                },
                messages: {
                  required: "Please select a file",
                  accept:"Only file of type csv,xls is allowed"
                }
              });
        });
              </script>
</x-app-layout>
