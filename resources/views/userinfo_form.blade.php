<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Info page') }}
        </h2>
    </x-slot>

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
 <script src="{{ asset('js/custom.js')}}"></script>

    <form id="myForm" action="{{route('users.store')}}" enctype="multipart/form-data"  method="POST">
    @csrf

        <div class="tab">
         <span>Father Name:</span>
            <p><input placeholder="father name..." name="father"></p>
            <span>Mother Name:</span>
            <p><input placeholder="Mother name..." name="mother"></p>
        </div>
        <div class="tab">Contact Info:
            <p><input placeholder="E-mail..." name="email"></p>
            <p><input placeholder="Phone..." name="phone"></p>
        </div>
        <div class="tab">About yourself:

        <textarea  id="address" rows="4"
                            class="text-capitalize round form-control @error('address') is-invalid @enderror"
                             name="textarea" placeholder="max 400 words " required autocomplete="address" autofocus>{{ old  ('address') }}</textarea>


                             {{-- <span>Add image</span> --}}

         <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">

            <input  name="profile_pic" type="file" class="hidden"
                        wire:model="photo"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

            <x-jet-label for="photo" value="{{ __('Add image') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ asset('image/profile.png') }}"   name="profile_pic" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="block rounded-full w-20 h-20" name="profile_pic"
                      x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-jet-secondary-button>
        </div>

        </div>
        <div style="overflow:auto;">
            <div style="margin-top: 5px;">
                <button  style="float:left;" type="button" class="previous">Previous</button>
                <button  style="float:right;" type="button" class="next">Next</button>
                <button   style="background-color: #4CAF50; float:right;" type="button" class="submit btn btn-success">Submit</button>
            </div>
        </div>

        <div style="text-align:center;margin-top:40px;">
            <span class="step">1</span>
            <span class="step">2</span>
            <span class="step">3</span>

        </div>
    </form>

<script type="text/javascript">
    $(document).ready(function(){

        var val = {

            rules: {
                father: "required",
                mother:"required",
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required:true,
                    minlength:10,
                    maxlength:10,
                    digits:true
                },
                password:{
                    required:true,
                    minlength:8,
                    maxlength:16,
                }
            },

            messages: {
                father:      "Father name is required",
                email: {
                    required:   "Email is required",
                    email:      "Please enter a valid e-mail",
                },
                phone:{
                    required:   "Phone number is requied",
                    minlength:  "Please enter 10 digit mobile number",
                    maxlength:  "Please enter 10 digit mobile number",
                    digits:     "Only numbers are allowed in this field"
                },

                password:{
                    required:   "Password is required",
                    minlength:  "Password should be minimum 8 characters",
                    maxlength:  "Password should be maximum 16 characters",
                }
            }
        }
        $("#myForm").multiStepForm(
        {

            beforeSubmit : function(form, submit){

            },
            validations:val,
        }
        ).navigateTo(0);
    });


</script>

</x-app-layout>
