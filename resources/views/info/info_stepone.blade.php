<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Info page') }}
        </h2>
    </x-slot>
  
                <div class="container"  style="margin-top: 25px;">
               
    <div class="row  contain justify-content-center">
        <div class="col-md-10">
   
            <form  id="form" action="{{ route('users.steptwo.info') }}" method="GET">
            <!-- <form id="form" method="GET"> -->
  
                <div class="card">
                    <div class="card-header">Step 1: Basic Info</div>
  
                    <div class="card-body">
  
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
  
                            <div class="form-group">
                            <label for="title">Father Name:</label>
                           @if(isset($detail['father']))
                               
                                <input type="text"  value="{{ $detail['father']}}" class="form-control" id="father"  name="father">
                               @else
                               <input type="text"   class="form-control" id="father"  name="father">      
                            
                           @endif
                         
                                </div>

                            
                            <div class="form-group">
                        
                                <label for="description">Mother Name:</label>
                                @if(isset($detail['mother']))
                                <input type="text"  id="mother"  value="{{ $detail['mother'] }}" class="form-control" name="mother"/>
                                @else
                                <input type="text"  id="mother"  class="form-control" name="mother"/>
                                @endif
                            </div>
                          
                    </div>
                    
                    <!-- route('users.steptwo.info') -->
                    <!-- onclick="location.href='{{ url('completed') }}'"> -->
                    <div class="card-footer text-right">

                    <!-- <a  id="anchor">
                     <button  type="button" >Next </button>
                         </a> -->
                        <button    type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
        $(document).ready(function() {
            $("#form").validate({
                rules: {
                    father: {
                                 required: true,
                                 minlength: 3
                                },
                    mother: {
                                 required: true,
                                 minlength: 3
                                },
                    
                }
            })
        });  

</script>



</x-app-layout>
