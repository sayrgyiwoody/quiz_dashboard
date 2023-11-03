<x-guest-layout>
    <x-authentication-card>
        {{-- <p class="flex justify-end">
        <a href="{{route('register')}}" class="hover:text-primary duration-150 text-sm flex items-center">Register Here
            <svg class="ms-1 inline-block" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M22 12a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-12 6l6-6l-6-6l-1.4 1.4l4.6 4.6l-4.6 4.6L10 18Z"/></svg>
        </a>

        </p> --}}
        <img class="mt-2 w-24 mx-auto" src="{{asset('images/logo.png')}}" alt="">
        <p class="text-center font-medium my-2">Create your own quizzes</p>
        <hr class="mb-6 h-[1.5px] bg-zinc-700">


            <x-validation-errors class="mb-4 bg-slate-50 py-4 px-6 rounded-md" />


        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <div class="relative z-0 w-full mb-4 group">
                    <input name="email" value="{{old('email')}}" type="text" class=" dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border border-[1.5px] border-slate-300 dark:border-zinc-700 rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Email</label>
                </div>
            </div>

            <div class="">
                <div class="relative z-0 w-full mb-6 group input-gp">
                <input name="password" value="{{old('password')}}" type="password" class=" dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border border-[1.5px] border-slate-300 dark:border-zinc-700 rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Password</label>
                <i class="fa-solid fa-eye eye-icon absolute transform -translate-y-6 -bottom-3 text-xl right-4"></i>
                </div>
            </div>
            <a class="underline text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>


            <button type="submit" class="mb-2 flex justify-center items-center bg-primary hover:bg-primary_hover duration-150 px-8 py-3 w-full text-xl font-semibold text-white rounded-md mt-4 w-fit">
                Login
            </button>
        </form>
    </x-authentication-card>
</x-guest-layout>



