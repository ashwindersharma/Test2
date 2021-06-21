<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Info page') }}
        </h2>
    </x-slot>

                <div class="container"  style="margin-top: 25px;">
               
    <div class="row justify-content-center">
        <div class="col-md-10">
       
            <form   action="{{ route('users.stepfinalinfo') }}" method="POST">
                @csrf
  
                <div class="card">
                    <div class="card-header">Step 3: About yourself </div>
  
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
                            <textarea  id="address" rows="4" 
                            class="text-capitalize round form-control @error('address') is-invalid @enderror"
                             name="textarea" placeholder="max 400 words " required autocomplete="address" autofocus>{{ old  ('address') }}</textarea>
 
                     
                      

                    </div>
  
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-md-6 text-left">
        
                            <a href="{{ route('users.steptwo.info') }}">Go Back</a>
                                <!-- <button  type="submit" action="{{ url()->previous()  }}" class="btn btn-danger pull-right">Previous</a> -->
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" id="next" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                      

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





        
</x-app-layout>
