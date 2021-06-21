<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Info page') }}
        </h2>
    </x-slot>

                <div class="container"  style="margin-top: 25px;">
               
    <div class="row justify-content-center">
        <div class="col-md-10">

            <form  id="form"  action="{{ route('users.stepthree.info') }}" method="GET">
               
        
  
                <div class="card">
                    <div class="card-header">Step 2: Contacts</div>
  
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
                                <label for="title">Mobile Number:</label>
                                @if(isset($detail['mobile']))
                               
                                <input  type="tel" value="{{ $detail['mobile']}}"  class="form-control" id="taskTitle"  name="mobile">
                              @else
                              <input type="text"  type="tel" class="form-control" id="taskTitle"  name="mobile">     
                           
                          @endif
                                
                            </div>
                            <div class="form-group">
                                <label for="description">Age:</label>
                                @if(isset($detail['age']))
                               
                                <input type="number" min='10' max='100' class="form-control"   value="{{ $detail['age']}}"   name="age"/>
                             @else
                             <input type="text"  class="form-control"  value=""  id="productAmount" name="age"/> 
                          
                         @endif
                               
                            </div>

                    </div>
  
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                            <a href="{{ route('users.stepone.info') }}">Go Back</a>
                                <!-- <button  type="submit" action="{{ url()->previous()  }}" class="btn btn-danger pull-right">Previous</a> -->
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" id="next" class="btn btn-primary">Next</button>
                            </div>
                        </div>

                      

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
                    mobile: {
                    // matches:"[0-9]+",
                    minlength:10, 
                    maxlength:10,
                    digits: true,
                                 required: true,
                                 
                                },
                    age: {
                                 required: true,
                                 minlength: 2,
                                 digits: true
                                },
                    
                }
            })
        });  

</script>

        
</x-app-layout>
