@extends('layouts.master')

@section('main-content')

<div class="flex items-center justify-center">

    <div class="w-full md:w-2/3 mt-6 ">

  <div class=" p-6  bg-white dark:bg-zinc-800 shadow-sm rounded">
    <div class="mb-2">
        @if (Auth::user()->profile_photo_path === null)
            <img class="mx-auto rounded-full w-24 h-24" src="https://ui-avatars.com/api/?background=2563eb&color=ffffff&name={{Auth::user()->name}}" alt="profile image">
        @else
            <img class="mx-auto rounded-full w-24 h-24 object-cover" src="{{asset('storage/'.Auth::user()->profile_photo_path)}}" alt="profile image">

        @endif


    </div>
    <h4 class="text-center text-zinc-800 text-2xl font-semibold text-zinc-900 dark:text-white">{{Auth::user()->name}}</h4>
    <p class="text-center text-zinc-600 dark:text-muted font-medium mb-4">{{Auth::user()->email}}</p>
    <hr class="mb-6  bg-zinc-900 h-[1.6px]">
    <div class="flex items-center justify-between hover:bg-slate-50 dark:hover:bg-zinc-600 rounded-md pe-4 duration-150 mb-4">
        <div class="flex items-center">
            <div class="p-3 rounded-md bg-slate-100 dark:bg-zinc-700  w-fit">
                <svg class="text-zinc-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3a9 9 0 1 0 9 9c0-.46-.04-.92-.1-1.36a5.389 5.389 0 0 1-4.4 2.26a5.403 5.403 0 0 1-3.14-9.8c-.44-.06-.9-.1-1.36-.1z"/></svg>
            </div>
            <span class="ms-3 text-zinc-800 dark:text-white font-medium">Dark Mode</span>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
            <input id="theme-toggle" type="checkbox" value="" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
        </label>
    </div>
    <a href="{{route('admin.setting.profile')}}" class="list flex items-center justify-between hover:bg-slate-50 dark:hover:bg-zinc-600 rounded-md pe-4 duration-150 mb-4">
        <div class="flex items-center">
            <div class="p-3 rounded-md bg-slate-100 dark:bg-zinc-700  w-fit">
                <svg class="text-zinc-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88a9.947 9.947 0 0 1 12.28 0C16.43 19.18 14.03 20 12 20z"/></svg>
            </div>
            <span class="ms-3 text-zinc-800 dark:text-white font-medium">Personal Information</span>
        </div>
        <svg  class="caret-right text-zinc-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M8.59 16.59L13.17 12L8.59 7.41L10 6l6 6l-6 6l-1.41-1.41z"/></svg>
    </a>
    <div class="list flex items-center justify-between hover:bg-slate-50 dark:hover:bg-zinc-600 rounded-md pe-4 duration-150">
        <div class="flex items-center">
            <div class="p-3 rounded-md bg-slate-100 dark:bg-zinc-700  w-fit">
                <svg class="text-zinc-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5l-9-4m0 6c1.4 0 2.8 1.1 2.8 2.5V11c.6 0 1.2.6 1.2 1.3v3.5c0 .6-.6 1.2-1.3 1.2H9.2c-.6 0-1.2-.6-1.2-1.3v-3.5c0-.6.6-1.2 1.2-1.2V9.5C9.2 8.1 10.6 7 12 7m0 1.2c-.8 0-1.5.5-1.5 1.3V11h3V9.5c0-.8-.7-1.3-1.5-1.3Z"/></svg>
            </div>
            <span class="ms-3 text-zinc-800 dark:text-white font-medium">Account Security</span>
        </div>
        <svg class="caret-right text-zinc-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M8.59 16.59L13.17 12L8.59 7.41L10 6l6 6l-6 6l-1.41-1.41z"/></svg>
    </div>
  </div>


    </div>
 </div>
@endsection

@section('style')

    .caret-right {
        transition : .5s;
    }

    .list:hover .caret-right {
        transform: translateX(6px);
    }

@endsection
