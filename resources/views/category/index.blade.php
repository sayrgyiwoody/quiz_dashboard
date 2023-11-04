@extends('layouts.master')

@section('main-content')
<div class="grid md:grid-cols-5 gap-4 mb-4">
    <div class="md:col-span-2">
        <form id="create-form" action="{{route('category.create')}}" method="POST" enctype="multipart/form-data" class="animate__animated animate__bounceIn px-6 py-3  rounded bg-white dark:bg-zinc-800">
            @csrf
            <h4 class="text-zinc-900 dark:text-slate-100 font-semibold text-xl my-3">Create Category</h4>
            <div class="relative z-0 w-full mb-6 group mt-4">
                <input name="categoryName" value="{{old('categoryName')}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-zinc-900 bg-transparent appearance-none  border-[1.5px]  rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm  dark:text-zinc-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Category Name</label>
                @error('categoryName')
                    <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                @enderror
            </div>
            <label for="" class="text-zinc-900 dark:text-slate-100">Category Image :</label>
                <img id="category-image" class=" bg-slate-50 dark:bg-[#242425] border-2 dark:border-zinc-700 w-full h-60 object-cover rounded-md mt-3" src="{{asset('images/default.png')}}" alt="">

                <div class="mt-3 mb-5">
                    <div class="flex items-center justify-center w-full ">
                        <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-28 border-2 border-zinc-300 border-dashed rounded-lg cursor-pointer bg-zinc-50 dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-zinc-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-zinc-500 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-zinc-500 dark:text-zinc-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            </div>
                            <input name="categoryImage" id="dropzone-file" type="file" class="image-input absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" />
                        </label>

                </div>
                @error('categoryImage')
                        <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class=" font-semibold flex items-center mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none dark:focus:ring-blue-800"><svg class=" inline-block me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M17 13h-4v4h-2v-4H7v-2h4V7h2v4h4m2-8H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z"/></svg>Create</button>
            </div>
        </form>
        <form id="edit-form" action="{{route('category.edit')}}" method="POST" enctype="multipart/form-data" class="animate__animated animate__bounceIn px-6 py-3 hidden rounded bg-white dark:bg-zinc-800">
            @csrf
            <h4 class="text-zinc-900 dark:text-slate-100 font-semibold text-xl my-3">Edit Category</h4>
            <div class="relative z-0 w-full mb-6 group mt-4">
                <input id="category-name" name="categoryName" value="{{old('categoryName')}}" type="text" class="@error('email') border-red-600 dark:border-red-600 @else border-slate-300 dark:border-zinc-700 @enderror dark:text-white px-3 relative block py-3 w-full text-sm text-zinc-900 bg-transparent appearance-none  border-[1.5px]  rounded-md dark:focus:border-blue-500 -z-0 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label class="bg-white dark:bg-zinc-800 peer-focus:font-medium absolute text-sm  dark:text-zinc-400 duration-300 transform -translate-y-6 scale-75 top-3 left-3 -z-10 text-zinc-900 peer-focus:z-10 origin-[0]  peer-focus:bg-white dark:peer-focus:bg-zinc-800 px-3 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Category Name</label>
                @error('categoryName')
                    <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                @enderror
            </div>
            <input type="hidden" name="id" id="category-id" >
            <label for="" class="text-zinc-900 dark:text-slate-100">Category Image :</label>
                <img id="category-image-2" class=" bg-slate-50 dark:bg-[#242425] border-2 dark:border-zinc-700 w-full h-60 object-cover rounded-md mt-3" src="{{asset('images/default.png')}}" alt="">

                <div class="mt-3 mb-5">
                    <div class="flex items-center justify-center w-full ">
                        <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-28 border-2 border-zinc-300 border-dashed rounded-lg cursor-pointer bg-zinc-50 dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-zinc-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-zinc-500 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-zinc-500 dark:text-zinc-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            </div>
                            <input name="categoryImage" id="dropzone-file" type="file" class="image-input-2 absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" />
                        </label>

                </div>
                @error('categoryImage')
                        <p class=" text-red-600 text-sm mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="grid grid-cols-3">
                <div class="btn-cancel col-span-1 font-semibold flex items-center justify-center mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none dark:focus:ring-blue-800"><svg class=" inline-block me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l1.4-1.4l-1.6-1.6H16v-2h-4.2l1.6-1.6L12 8l-4 4l4 4Zm0 6q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>Cancel</div>
                <button type="submit" class=" col-span-2 font-semibold flex items-center justify-center mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none dark:focus:ring-blue-800"><svg class=" inline-block me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M9 16v-6H5l7-7l7 7h-4v6H9m-4 4v-2h14v2H5Z"/></svg>Update</button>
            </div>
        </form>
    </div>
    <div class=" overflow-x-scroll md:overflow-hidden md:col-span-3 rounded">

    <div class=" w-full animate__animated animate__bounceIn relative shadow-md sm:rounded-lg">
        <div class=" flex items-center justify-between py-4 px-6 bg-white dark:bg-zinc-800">
            <div>
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
                            <form action="{{route('category.list')}}" method="GET">
                                <input type="hidden" name="filterStatus" value="ascending">
                                <button class="flex items-center w-full text-start px-4 py-2 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-600 dark:hover:text-white">Ascending
                                    <svg class="inline-block ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M20 17h3l-4 4l-4-4h3V3h2v14M8 5c-3.86 0-7 3.13-7 7s3.13 7 7 7c3.86 0 7-3.13 7-7s-3.13-7-7-7m0 2.15c2.67 0 4.85 2.17 4.85 4.85c0 2.68-2.17 4.85-4.85 4.85c-2.68 0-4.85-2.17-4.85-4.85c0-2.68 2.17-4.85 4.85-4.85M7 9v3.69l3.19 1.84l.75-1.3l-2.44-1.41V9"/></svg>
                                </button>
                            </form>
                        </li>
                        <li>

                            <a href="{{route('category.list')}}" class="w-full text-start flex items-center px-4 py-2 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-600 dark:hover:text-white">Descending
                                <svg  class="inline-block ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M18 7h-3l4-4l4 4h-3v14h-2V7M8 5c-3.86 0-7 3.13-7 7s3.13 7 7 7c3.86 0 7-3.13 7-7s-3.13-7-7-7m0 2.15c2.67 0 4.85 2.17 4.85 4.85c0 2.68-2.17 4.85-4.85 4.85c-2.68 0-4.85-2.17-4.85-4.85c0-2.68 2.17-4.85 4.85-4.85M7 9v3.69l3.19 1.84l.75-1.3l-2.44-1.41V9"/></svg>
                            </a>
                        </li>
                        <li>
                            <form action="{{route('category.list')}}" method="GET">
                                <input type="hidden" name="filterStatus" value="AZ">
                                <button class="flex items-center w-full text-start px-4 py-2 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-600 dark:hover:text-white">Alphabetical
                                    <svg class="inline-block ms-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="m15.75 19l-3.25 3.25L9.25 19h6.5m-6.86-4.7H6L5.28 17H2.91L6 7h3l3.13 10H9.67l-.78-2.7m-2.56-1.62h2.23l-.63-2.12l-.26-.97l-.25-.96h-.03l-.22.97l-.24.98l-.6 2.1M13.05 17v-1.26l4.75-6.77v-.06h-4.3V7h7.23v1.34L16.09 15v.08h4.71V17h-7.75Z"/></svg>
                                </form>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="border-[1.5px] dark:border-zinc-700 px-3 py-2 rounded dark:text-white">
                Total : <span class=" font-semibold text-primary">{{$category->total()}}</span>
            </div>
            <form action="{{route('category.list')}}" method="GET">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input name="searchKey" value="{{request('searchKey')}}" type="text" class="block p-2 pl-10 text-sm text-zinc-900 border border-zinc-300 rounded-lg w-80 bg-zinc-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for categories">
                </div>
            </form>
        </div>
        @if ($category->total() != 0)
        <table class="w-full text-sm text-left px-6 text-zinc-500 dark:text-zinc-400">
            <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
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

                @foreach ($category as $c)
                <tr class="text-zinc-800 dark:text-slate-100 bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">

                    <td class="flex items-center  px-6 py-4 text-zinc-900 whitespace-nowrap dark:text-white">
                        @if ($c->image != null)
                            <img class=" w-36  h-24 object-cover bg-slate-50 dark:bg-[#242425] border-2 dark:border-zinc-700 rounded-md" src="{{asset('storage/categoryImages/'.$c->image)}}" alt="category image">
                        @else
                            <img class=" w-36  h-24 object-cover bg-slate-50 dark:bg-[#242425] border-2 dark:border-zinc-700 rounded-md" src="{{asset('images/default.png')}}" alt="category image">
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold">
                        {{$c->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$c->created_at->format('d M Y')}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <button data-id="{{$c->id}}" class="btn-edit">
                                <div data-popover id="popover-edit" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-zinc-500 transition-opacity duration-300 bg-white border border-zinc-200 rounded-lg shadow-sm opacity-0 dark:text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800">
                                    <div class="px-3 py-2 bg-zinc-100 border-b border-zinc-200 rounded-t-lg dark:border-zinc-600 dark:bg-zinc-900">
                                        <h3 class="font-semibold text-blue-600">Edit</h3>
                                    </div>
                                    <div class="px-3 py-2">
                                        <p><span class="font-semibold">Edit</span> category information.</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <svg data-popover-target="popover-edit" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-2.3 6.35c.22-.21.22-.56 0-.77L15.42 7.3a.532.532 0 0 0-.77 0l-1 1l2.05 2.05l1-1M7 14.94V17h2.06l6.06-6.06l-2.06-2.06L7 14.94Z"/></svg>
                            </button>
                            <form action="{{route('category.delete')}}" method="POST" class="ms-2">
                                @csrf
                                <div data-popover id="popover-delete" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-zinc-500 transition-opacity duration-300 bg-white border border-zinc-200 rounded-lg shadow-sm opacity-0 dark:text-zinc-400 dark:border-zinc-600 dark:bg-zinc-800">
                                    <div class="px-3 py-2 bg-zinc-100 border-b border-zinc-200 rounded-t-lg dark:border-zinc-600 dark:bg-zinc-900">
                                        <h3 class="font-semibold text-red-600">Delete</h3>
                                    </div>
                                    <div class="px-3 py-2">
                                        <p><span class="font-semibold">Delete</span> category from table.</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <input type="hidden" name="id" value="{{$c->id}}">
                                <button type="submit" class="mt-1">
                                    <svg data-popover-target="popover-delete" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2c5.53 0 10 4.47 10 10s-4.47 10-10 10S2 17.53 2 12S6.47 2 12 2m5 5h-2.5l-1-1h-3l-1 1H7v2h10V7M9 18h6a1 1 0 0 0 1-1v-7H8v7a1 1 0 0 0 1 1Z"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h4 class="px-4 py-3 flex items-center dark:bg-zinc-700 dark:text-white">
            <svg class="inline-block me-2 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M11 17h2v-6h-2v6Zm1-8q.425 0 .713-.288T13 8q0-.425-.288-.713T12 7q-.425 0-.713.288T11 8q0 .425.288.713T12 9Zm0 13q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Z"/></svg>
            There's no category to show</h4>
        @endif

    </div>
    <div class="mt-4 px-2 pagination">{{$category->appends(request()->query())->links()}}</div>


    </div>
 </div>


@endsection


@section('script-source')

$(document).ready(function() {
    $('.image-input').on('change', function(event) {
      var file = event.target.files[0];
      var reader = new FileReader();

      reader.onload = function() {
        $('#category-image').attr('src', reader.result);
      }

      if (file) {
        reader.readAsDataURL(file);
      }
    });

    $('.image-input-2').on('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function() {
          $('#category-image-2').attr('src', reader.result);
        }

        if (file) {
          reader.readAsDataURL(file);
        }
      });

    $(".btn-cancel").click(function(){
        $("#edit-form").hide();
        $("#create-form").show();
    })

    $(".btn-edit").click(function(){
        $("#edit-form").show();
        $("#create-form").hide();
        const id = $(this).data("id");
        $.ajax({
            url: 'category/editInfo',
            type: 'POST',
            dataType: 'json',
            data : {id : id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                const category = response.category;
                $("#edit-form #category-name").val(category.name);
                $("#edit-form #category-image-2").attr("src", "/storage/categoryImages/" + category.image);
                $("#edit-form #category-id").val(category.id);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    })
  });


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
