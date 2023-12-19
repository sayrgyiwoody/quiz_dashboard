@extends('layouts.master')

@section('main-content')
<h4 class="text-zinc-900 dark:text-white text-xl font-semibold text-center mb-3">User List Table</h4>

<div class=" w-full shadow-md sm:rounded-lg">
    <div class=" flex flex-col md:flex-row md:items-center  justify-center md:justify-between py-4 px-6 bg-white dark:bg-zinc-800">
        <div class="flex">
            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-zinc-500 bg-white border border-zinc-300 focus:outline-none hover:bg-zinc-100 focus:ring-4 focus:ring-zinc-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-zinc-800 dark:text-zinc-400 dark:border-zinc-600 dark:hover:bg-zinc-700 dark:hover:border-zinc-600 dark:focus:ring-zinc-700" type="button">
                <span class="sr-only">Action button</span>
                Filter<svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M6 13h12v-2H6M3 6v2h18V6M10 18h4v-2h-4v2Z"/></svg>
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-zinc-100 rounded-lg shadow w-44 dark:bg-zinc-700 dark:divide-zinc-600">
                <ul class="py-1 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownActionButton">
                    <li>
                        <form action="{{route('accounts.user.list')}}" method="GET">
                            <input type="hidden" name="filterStatus" value="ascending">
                            <button class="flex items-center w-full text-start px-4 py-2 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-600 dark:hover:text-white">Ascending
                                <svg class="inline-block ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M20 17h3l-4 4l-4-4h3V3h2v14M8 5c-3.86 0-7 3.13-7 7s3.13 7 7 7c3.86 0 7-3.13 7-7s-3.13-7-7-7m0 2.15c2.67 0 4.85 2.17 4.85 4.85c0 2.68-2.17 4.85-4.85 4.85c-2.68 0-4.85-2.17-4.85-4.85c0-2.68 2.17-4.85 4.85-4.85M7 9v3.69l3.19 1.84l.75-1.3l-2.44-1.41V9"/></svg>
                            </button>
                        </form>
                    </li>
                    <li>

                        <a href="{{route('accounts.user.list')}}" class="w-full text-start flex items-center px-4 py-2 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-600 dark:hover:text-white">Descending
                            <svg  class="inline-block ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M18 7h-3l4-4l4 4h-3v14h-2V7M8 5c-3.86 0-7 3.13-7 7s3.13 7 7 7c3.86 0 7-3.13 7-7s-3.13-7-7-7m0 2.15c2.67 0 4.85 2.17 4.85 4.85c0 2.68-2.17 4.85-4.85 4.85c-2.68 0-4.85-2.17-4.85-4.85c0-2.68 2.17-4.85 4.85-4.85M7 9v3.69l3.19 1.84l.75-1.3l-2.44-1.41V9"/></svg>
                        </a>
                    </li>
                    <li>
                        <form action="{{route('accounts.user.list')}}" method="GET">
                            <input type="hidden" name="filterStatus" value="AZ">
                            <button class="flex items-center w-full text-start px-4 py-2 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-600 dark:hover:text-white">Alphabetical
                                    <svg class="inline-block ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="m15.75 19l-3.25 3.25L9.25 19h6.5m-6.86-4.7H6L5.28 17H2.91L6 7h3l3.13 10H9.67l-.78-2.7m-2.56-1.62h2.23l-.63-2.12l-.26-.97l-.25-.96h-.03l-.22.97l-.24.98l-.6 2.1M13.05 17v-1.26l4.75-6.77v-.06h-4.3V7h7.23v1.34L16.09 15v.08h4.71V17h-7.75Z"/></svg>
                            </form>
                    </li>
                </ul>

            </div>
            <div class="ms-4 md:ms-8 w-fit border-[1.5px] dark:border-zinc-700 px-3 py-2 m-0 rounded text-zinc-900 dark:text-white">
                Total : <span class=" font-semibold text-primary">{{$users->total()}}</span>
            </div>
        </div>


        <form class="mt-3 md:mt-0 relative" action="{{route('accounts.user.list')}}" method="GET">

            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg  class="w-6 h-6 text-zinc-500 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><circle cx="10" cy="8" r="4" fill="currentColor"/><path fill="currentColor" d="M10.35 14.01C7.62 13.91 2 15.27 2 18v2h9.54c-2.47-2.76-1.23-5.89-1.19-5.99zm9.08 4.01c.36-.59.57-1.28.57-2.02c0-2.21-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4c.74 0 1.43-.22 2.02-.57L20.59 22L22 20.59l-2.57-2.57zM16 18c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2z"/></svg>
            </div>
            <input type="text" name="searchKey" value="{{request('searchKey')}}" class="block p-2 pl-10 text-sm text-zinc-900 border border-zinc-300 rounded-lg w-80 bg-zinc-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for user accounts">
        </form>
    </div>
    @if ($users->total() != 0)
    <table class="w-full text-sm text-left px-6 text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Birthday
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>


            @foreach ($users as $user)

                    <tr class="text-zinc-900 dark:text-white bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                        <td id="aId" class="px-6 py-4">
                            {{$user->id}}
                        </td>


                        <th scope="row" class=" text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="flex items-center px-6 py-4 hover:text-blue-600 dark:hover:text-blue-500" href="{{ route('accounts.detail',$user->id) }}">
                            @if ($user->profile_photo_path === null && $user->provider_avatar === null)
                                <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?background=2563eb&color=ffffff&name={{$user->name}}" alt="Jese image">
                            @elseif($user->provider_avatar && $user->profile_photo_path === null)
                                <img class="w-10 h-10 rounded-full object-cover" src="{{$user->provider_avatar}}" alt="Jese image">
                            @else
                                <img class="w-10 h-10 rounded-full object-cover" src="{{asset('storage/'.$user->profile_photo_path)}}" alt="Jese image">

                            @endif
                            <div class="pl-3">
                                <div class="text-base font-semibold ">{{$user->name}}</div>
                                <div class="font-normal text-gray-500 dark:text-muted">{{$user->email}}</div>
                            </div>
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            @if ($user->gender)
                            {{$user->gender}}

                            @else
                            not set
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->birthday)
                            {{$user->birthday}}
                            @else
                            not set
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->address)
                            {{$user->address}}
                            @else
                            not set
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{$user->created_at->format('d M Y')}}
                        </td>
                        <td class="px-6 py-4">
                           @if ($user->email !== Auth::user()->email)
                           <div class="flex items-center">
                            <form action="{{route('accounts.changeRole')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" data-id="" class="btn-edit bg-primary p-2 rounded hover:bg-primary_hover duration-100">
                                    <div data-popover id="popover-edit" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-zinc-500 transition-opacity duration-300 bg-white border border-zinc-200 rounded-lg shadow-sm opacity-0 dark:text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800">
                                        <div class="px-3 py-2 bg-zinc-100 border-b border-zinc-200 rounded-t-lg dark:border-zinc-600 dark:bg-zinc-900">
                                            <h3 class="font-semibold text-blue-600">Change Role</h3>
                                        </div>
                                        <div class="px-3 py-2">
                                            <p>Change<span class="font-semibold"> user </span>role to <span class="font-semibold">user</span></p>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                    <svg class="text-white w-6 h-6" data-popover-target="popover-edit" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm.06 17v-2.01H12c-1.28 0-2.56-.49-3.54-1.46a5.006 5.006 0 0 1-.64-6.29l1.1 1.1c-.71 1.33-.53 3.01.59 4.13c.7.7 1.62 1.03 2.54 1.01v-2.14l2.83 2.83L12.06 19zm4.11-4.24l-1.1-1.1c.71-1.33.53-3.01-.59-4.13A3.482 3.482 0 0 0 12 8.5h-.06v2.15L9.11 7.83L11.94 5v2.02c1.3-.02 2.61.45 3.6 1.45c1.7 1.7 1.91 4.35.63 6.29z"/></svg>
                                </button>
                            </form>

                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button" class=" btn-delete ms-2 bg-red-500 p-2 rounded hover:bg-red-700 duration-100">
                                <div data-popover id="popover-delete" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-zinc-500 transition-opacity duration-300 bg-white border border-zinc-200 rounded-lg shadow-sm opacity-0 dark:text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800">
                                    <div class="px-3 py-2 bg-zinc-100 border-b border-zinc-200 rounded-t-lg dark:border-zinc-600 dark:bg-zinc-900">
                                        <h3 class="font-semibold text-red-600">Delete Account</h3>
                                    </div>
                                    <div class="px-3 py-2">
                                        <p>Delete<span class="font-semibold"> user</span> account from table.</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <svg  class="text-white w-6 h-6" data-popover-target="popover-delete" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2c5.53 0 10 4.47 10 10s-4.47 10-10 10S2 17.53 2 12S6.47 2 12 2m5 5h-2.5l-1-1h-3l-1 1H7v2h10V7M9 18h6a1 1 0 0 0 1-1v-7H8v7a1 1 0 0 0 1 1Z"/></svg>
                            </button>
                            <!-- Main modal -->
                            <div id="default-modal" tabindex="-1" aria-hidden="true" style="background-color:#27272aa8;" class="absolute  top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full flex justify-center items-center">
                                    <!-- Modal content -->
                                    <div class="animate__animated animate__bounceIn relative w-full md:w-2/3 bg-white rounded-lg shadow dark:bg-zinc-700">
                                        <!-- Modal header -->
                                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Are you sure ?
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            You won't be able to revert this. This user account will be deleted forever.
                                        </p>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <form action="{{route('accounts.delete')}}" method="POST" class="flex justify-center items-center">
                                            @csrf
                                            <input class="account_id" type="hidden" name="id" value="">
                                            <button  type="submit" class="text-lg px-5 py-2.5 flex items-center justify-center mt-2 font-medium text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300  rounded-lg mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-blue-800">Delete Category</button>
                                        </form>
                                            <button data-modal-hide="default-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>

                            @else
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m23 12l-2.44-2.79l.34-3.69l-3.61-.82l-1.89-3.2L12 2.96L8.6 1.5L6.71 4.69L3.1 5.5l.34 3.7L1 12l2.44 2.79l-.34 3.7l3.61.82L8.6 22.5l3.4-1.47l3.4 1.46l1.89-3.19l3.61-.82l-.34-3.69L23 12zm-12.91 4.72l-3.8-3.81l1.48-1.48l2.32 2.33l5.85-5.87l1.48 1.48l-7.33 7.35z"/></svg>
                            @endif
                        </td>

                    </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h4 class="px-4 py-3 flex items-center text-zinc-900 bg-slate-50 dark:bg-zinc-700 dark:text-white">
        <svg class="inline-block me-2 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M11 17h2v-6h-2v6Zm1-8q.425 0 .713-.288T13 8q0-.425-.288-.713T12 7q-.425 0-.713.288T11 8q0 .425.288.713T12 9Zm0 13q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>
        There's no account to show</h4>
    @endif

</div>
<div class="mt-4 px-2 pagination">{{$users->appends(request()->query())->links()}}</div>

@endsection


@section('script-source')

    $(document).ready(function(){
        $(".btn-delete").click(function(){
            $parentNode = $(this).parents('tr');
            $(".account_id").val($parentNode.find("#aId").text());
        })
    })


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
