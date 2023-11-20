@extends('layouts.master')

@section('main-content')

<div class="animate__animated animate__bounceIn flex mt-6 flex-col items-center justify-center">
    <a href="{{route('admin.setting.security')}}" class="w-full md:w-2/4 flex items-center text-zinc-900 dark:text-slate-100 dark:hover:text-primary hover:text-primary duration-150">
        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m-3.29 13.59L14.29 18l-6-6l6-6l1.42 1.41L11.12 12l4.59 4.59Z"/></svg>Back
    </a>
    <div class="w-full mt-4 p-6 md:w-2/4 bg-white dark:bg-zinc-800 shadow-sm rounded">
        <p class="text-zinc-900 dark:text-slate-100 ms-3 mb-2 ">Forgot your password? No problem. Just request password reset link for your email address and we will email you a password reset link that will allow you to choose a new one.</p>
        <form action="{{ route('forgot.password.link') }}" method="POST" class="mt-5">
            @csrf
            <div class="relative z-0 w-full group input-gp">
            <input readonly name="email" value="{{Auth::user()->email}}" type="text" class=" dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border border-[1.5px] border-slate-300 dark:border-zinc-700 rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute bg-white dark:bg-zinc-800 text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 z-10 text-zinc-900  origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Your Email</label>
            </div>
            @error('email')
                <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
            @enderror
            <button type="submit" class="font-medium flex items-center mt-5 float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none dark:focus:ring-blue-800">Request Password Reset Link</button>

        </form>


    </div>




      
  </div>
<!-- Main modal -->

 </div>
@endsection

@section('script-source')

@if (session('alert'))

if(localStorage.getItem('color-theme') === 'dark') {
    var textColor = '#ffffff';
    var bgColor = '#3f3f46';
}else {
    var textColor = '#18181b';
    var bgColor = '#ffffff';
}

Swal.fire({
    position: 'center',
    icon: 'success',
    text:  '{{ session('alert') }}',
    showConfirmButton: true,
    color: `${textColor}`,
    background: `${bgColor}`,
})

@endif

@endsection
