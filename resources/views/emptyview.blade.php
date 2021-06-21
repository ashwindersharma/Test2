<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alter Users') }}
        </h2>
    </x-slot>

    <div class="container">
    @include('adduser_button')
            <div class="panel-heading">NO List of Users available</div>

        </div>
        <div id="myModal" class="modal">
      

<!-- Modal content -->
<div class="modal-content">
  

      
        <x-jet-validation-errors class="mb-4"/>

        <form method="POST"  action="{{ route('users.add') }}">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>       

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4" >
                    {{ __('Add User') }}
                </x-jet-button>
            </div>
        </form>
    

</div>

</div>
    
<script>
        $('#adduser').click(function() {

var modal = document.getElementById("myModal");
            modal.style.display = "block";

           window.onclick = function(event) 
           {
              if (event.target == modal)
               {
                modal.style.display = "none";
               }
            }

});

  
</script>

<script>
 if("{{$errors}}".length>2){
                var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                    window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
            }
</script>
       

</x-app-layout>