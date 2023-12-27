@extends('layouts.master')

@section('main-content')

<div class="flex mt-6 flex-col items-center justify-center animate__animated animate__fadeIn">
    <a href="{{ url()->previous() }}" class="w-full md:w-2/3 flex items-center text-zinc-900 dark:text-slate-100 dark:hover:text-primary hover:text-primary duration-150">
        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m-3.29 13.59L14.29 18l-6-6l6-6l1.42 1.41L11.12 12l4.59 4.59Z"/></svg>Back
    </a>
    <form class="w-full mt-4 p-6 md:p-7 md:w-2/3 bg-white dark:bg-zinc-800 shadow-sm rounded">
        <h4 class="text-center text-zinc-800 text-2xl font-semibold text-zinc-900 dark:text-white">Account Information</h4>
        <p class="text-center text-zinc-600 dark:text-muted font-medium mb-4">More Detail information of user account</p>
        <hr class="mb-6  bg-zinc-900 h-[1.6px]">
        <div class="grid md:grid-cols-3 md:space-x-6">
            <div class="">
                @if ($user->profile_photo_path === null && $user->provider_avatar === null )
                    <img id="profile-image" class=" w-full md:h-60 object-cover rounded-md" src="https://ui-avatars.com/api/?background=2563eb&color=ffffff&name={{$user->name}}" alt="">

                    @elseif ($user->provider_avatar !== null && $user->profile_photo_path === null)
                    <img id="profile-image" class=" w-full md:h-60 object-cover rounded-md" src="{{ $user->provider_avatar }}" alt="">

                    @else
                    <img id="profile-image" class=" w-full md:h-60 object-cover rounded-md" src="{{asset('storage/'.$user->profile_photo_path)}}" alt="">
                @endif



                <div class="flex items-center space-x-3 mt-5 ms-3 mb-3 md:mb-0">
                    <div class="flex items-center">
                        <input disabled @if($user->gender==='male') checked @endif id="default-radio-1" type="radio" value="male" name="gender" class=" cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer ">Male</label>
                    </div>
                    <div class="flex items-center">
                        <input disabled  @if($user->gender==='female') checked @endif id="default-radio-2" type="radio" value="female" name="gender" class=" cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer ">Female</label>
                    </div>
                    <div class="flex items-center">
                        <input disabled  @if($user->gender==='other') checked @endif id="default-radio-3" type="radio" value="other" name="gender" class=" cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-3" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer ">Other</label>
                    </div>
                </div>
            </div>
            <div class=" col-span-2">

                <div class="relative z-0 w-full mb-6 group mt-4">
                    <input readonly name="name" value="{{old('name',$user->name)}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none  border-[1.5px]  rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Name</label>

                </div>
                <div class="relative z-0 w-full mb-6 group mt-6">
                    <input readonly name="email" value="{{old('email',$user->email)}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px]  rounded-md dark:focus:border-blue-500 -z-10 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Email</label>

                </div>



                <div class="relative z-0 w-full mb-4 group mt-6">
                    <input readonly name="birthday" value="{{old('birthday',$user->birthday)}}" type="date" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px] rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Birthday</label>

                </div>
                <div class="relative z-0 w-full mb-4 group mt-6">
                    <textarea readonly name="address"  cols="30" rows="8" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror read-only:-z-20 dark:text-white relative block py-2.5 px-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px] rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>{{old('address',$user->address)}}</textarea>
                    <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Address</label>

                </div>
            </div>
        </div>


    </form>
 </div>
@endsection

