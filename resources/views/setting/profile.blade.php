@extends('layouts.master')

@section('main-content')

<div class="flex mt-6 flex-col items-center justify-center animate__animated animate__fadeIn">
    <a href="{{route('admin.setting')}}" class="w-full md:w-2/3 flex items-center text-zinc-900 dark:text-slate-100 dark:hover:text-primary hover:text-primary duration-150">
        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m-3.29 13.59L14.29 18l-6-6l6-6l1.42 1.41L11.12 12l4.59 4.59Z"/></svg>Back
    </a>
    <form method="POST" action="{{route('admin.update.account')}}" enctype="multipart/form-data" class="w-full mt-4 p-6 md:p-7 md:w-2/3 bg-white dark:bg-zinc-800 shadow-sm rounded">
        @csrf
        <h4 class="text-center text-zinc-800 text-2xl font-semibold text-zinc-900 dark:text-white">Personal Info</h4>
        <p class="text-center text-zinc-600 dark:text-muted font-medium mb-4">Update your own personal informations</p>
        <hr class="mb-6  bg-zinc-900 h-[1.6px]">
        <div class="grid md:grid-cols-3 md:space-x-6">
            <div class="">
                @if (Auth::user()->profile_photo_path === null)
                    <img id="profile-image" class=" w-full h-60 object-cover rounded-md" src="https://ui-avatars.com/api/?background=2563eb&color=ffffff&name={{Auth::user()->name}}" alt="">
                @else
                <img id="profile-image" class=" w-full h-60 object-cover rounded-md" src="{{asset('storage/'.Auth::user()->profile_photo_path)}}" alt="">
                @endif
                <div class="mt-3 mb-5">
                    <div class="flex items-center justify-center w-full ">
                        <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-28 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-zinc-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            </div>
                            <input name="image" id="dropzone-file" type="file" class="image-input absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" />
                        </label>

                    </div>
                    @error('image')
                            <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>


                <div class="flex items-center space-x-3 ms-3">
                    <div class="flex items-center">
                        <input @if(Auth::user()->gender==='male') checked @endif id="default-radio-1" type="radio" value="male" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                    </div>
                    <div class="flex items-center">
                        <input  @if(Auth::user()->gender==='female') checked @endif id="default-radio-2" type="radio" value="female" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                    </div>
                    <div class="flex items-center">
                        <input  @if(Auth::user()->gender==='other') checked @endif id="default-radio-3" type="radio" value="other" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-3" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Other</label>
                    </div>
                </div>
            </div>
            <div class=" col-span-2">

                <div class="relative z-0 w-full mb-6 group mt-4">
                    <input name="name" value="{{old('name',Auth::user()->name)}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none  border-[1.5px]  rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Name</label>
                    @error('name')
                        <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group mt-6">
                    <input name="email" value="{{old('email',Auth::user()->email)}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px]  rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Email</label>
                    @error('email')
                        <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>



                <div class="relative z-0 w-full mb-4 group mt-6">
                    <input name="number" value="{{old('number',Auth::user()->number)}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px] rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Phone Number</label>
                    @error('number')
                            <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-4 group mt-6">
                    <textarea name="address"  cols="30" rows="8" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white relative block py-2.5 px-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px] rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>{{old('address',Auth::user()->address)}}</textarea>
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Address</label>
                    @error('address')
                            <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

        </div>


        <button type="submit" class="font-semibold flex items-center mt-2 float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none dark:focus:ring-blue-800"><svg class=" inline-block me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M9 16v-6H5l7-7l7 7h-4v6H9m-4 4v-2h14v2H5Z"/></svg>Update</button>
    </form>
 </div>
@endsection

@section('script-source')

$(document).ready(function() {
    $('.image-input').on('change', function(event) {
      var file = event.target.files[0];
      var reader = new FileReader();

      reader.onload = function() {
        $('#profile-image').attr('src', reader.result);
      }

      if (file) {
        reader.readAsDataURL(file);
      }
    });
  });


@endsection
