<x-guest-layout>
    <x-authentication-card>
    <h4 class="text-left text-xl mb-4 font-semibold text-zinc-900 dark:text-white">Reset Your Password</h4>
        @if (session('fail'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('fail') }}
        </div>
        @endif
        @if (session('info'))
            <div class="border p-3 rounded bg-slate-100 text-zinc-800 flex items-center mb-4">
                {{ session('info') }}
                <svg class="ms-2 text-zinc-800 inline-block w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>
            </div>
        @endif
        <form action="{{route('reset.password')}}" method="post" novalidate="novalidate">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
            <div class="form-group">
                <input id="cc-pament" name="email" type="hidden" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$email}}" readonly>
                <div class="mb-5">
                    <div class="relative z-0 w-full group input-gp">
                    <input name="password" value="{{old('password')}}" type="password" class=" dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px] border-slate-300 dark:border-zinc-700 rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute bg-white dark:bg-zinc-800 text-sm  dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">New Password</label>
                    <i class="fa-solid fa-eye text-slate-600 dark:text-zinc-600 eye-icon absolute transform -translate-y-6 -bottom-3 text-xl right-4"></i>
                    </div>
                    @error('password')
                        <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="">
                    <div class="relative z-0 w-full group input-gp">
                    <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class=" dark:text-white px-3 relative block py-3 w-full text-sm text-gray-900 bg-transparent appearance-none border-[1.5px] border-slate-300 dark:border-zinc-700 rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label class="peer-focus:font-medium absolute bg-white dark:bg-zinc-800 text-sm  dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Confirm Password</label>
                    <i class="fa-solid fa-eye text-slate-600 dark:text-zinc-600 eye-icon absolute transform -translate-y-6 -bottom-3 text-xl right-4"></i>
                    </div>
                    @error('password_confirmation')
                        <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="font-medium flex items-center mt-5 float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none dark:focus:ring-blue-800">Reset Password</button>

            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>



