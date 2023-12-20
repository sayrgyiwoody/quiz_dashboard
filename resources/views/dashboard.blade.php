@extends('layouts.master')

@section('main-content')
<div class="grid md:grid-cols-2 md:space-x-3 space-y-3 md:space-y-0 mb-3">
    <div class="grid grid-cols-2 gap-4 ">
        <div class="p-3 justify-center animate__animated animate__bounceIn hover:bg-slate-100 dark:hover:bg-zinc-700 duration-150 rounded bg-white dark:bg-zinc-800">

            <div class="bg-indigo-500 text-white rounded-full p-4 my-3 w-fit mx-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m16 7.58l-5.5-2.4L5 7.58v3.6c0 3.5 2.33 6.74 5.5 7.74c.25-.08.49-.2.73-.3c-.15-.51-.23-1.06-.23-1.62c0-2.97 2.16-5.43 5-5.91V7.58z" opacity=".3"/><path fill="currentColor" d="M17 13c-2.21 0-4 1.79-4 4s1.79 4 4 4s4-1.79 4-4s-1.79-4-4-4zm0 1.38c.62 0 1.12.51 1.12 1.12s-.51 1.12-1.12 1.12s-1.12-.51-1.12-1.12s.5-1.12 1.12-1.12zm0 5.37c-.93 0-1.74-.46-2.24-1.17c.05-.72 1.51-1.08 2.24-1.08s2.19.36 2.24 1.08c-.5.71-1.31 1.17-2.24 1.17z" opacity=".3"/><circle cx="17" cy="15.5" r="1.12" fill="currentColor"/><path fill="currentColor" d="M18 11.09V6.27L10.5 3L3 6.27v4.91c0 4.54 3.2 8.79 7.5 9.82c.55-.13 1.08-.32 1.6-.55A5.973 5.973 0 0 0 17 23c3.31 0 6-2.69 6-6c0-2.97-2.16-5.43-5-5.91zM11 17c0 .56.08 1.11.23 1.62c-.24.11-.48.22-.73.3c-3.17-1-5.5-4.24-5.5-7.74v-3.6l5.5-2.4l5.5 2.4v3.51c-2.84.48-5 2.94-5 5.91zm6 4c-2.21 0-4-1.79-4-4s1.79-4 4-4s4 1.79 4 4s-1.79 4-4 4z"/><path fill="currentColor" d="M17 17.5c-.73 0-2.19.36-2.24 1.08c.5.71 1.32 1.17 2.24 1.17s1.74-.46 2.24-1.17c-.05-.72-1.51-1.08-2.24-1.08z"/></svg>
            </div>
            <h5 class="text-2xl font-semibold text-center text-zinc-900 dark:text-slate-100">{{$admin_count}}</h5>
            <p class="text-center text-gray-500 dark:text-muted">Total Admins</p>
        </div>
        <div class="p-3 justify-center animate__animated animate__bounceIn hover:bg-slate-100 dark:hover:bg-zinc-700 duration-150 rounded bg-white dark:bg-zinc-800">

            <div class="bg-amber-500 text-white rounded-full p-4 my-3 w-fit mx-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm3.61 6.34c1.07 0 1.93.86 1.93 1.93s-.86 1.93-1.93 1.93s-1.93-.86-1.93-1.93c-.01-1.07.86-1.93 1.93-1.93zm-6-1.58c1.3 0 2.36 1.06 2.36 2.36s-1.06 2.36-2.36 2.36s-2.36-1.06-2.36-2.36c0-1.31 1.05-2.36 2.36-2.36zm0 9.13v3.75c-2.4-.75-4.3-2.6-5.14-4.96c1.05-1.12 3.67-1.69 5.14-1.69c.53 0 1.2.08 1.9.22c-1.64.87-1.9 2.02-1.9 2.68zM12 20c-.27 0-.53-.01-.79-.04v-4.07c0-1.42 2.94-2.13 4.4-2.13c1.07 0 2.92.39 3.84 1.15C18.28 17.88 15.39 20 12 20z"/></svg>
            </div>
            <h5 class="text-2xl font-semibold text-center text-zinc-900 dark:text-slate-100">{{$user_count}}</h5>
            <p class="text-center text-gray-500 dark:text-muted">Total Users</p>
        </div>
        <div class="p-3 justify-center animate__animated animate__bounceIn hover:bg-slate-100 dark:hover:bg-zinc-700 duration-150 rounded bg-white dark:bg-zinc-800">

            <div class="bg-emerald-500 text-white rounded-full p-4 my-3 w-fit mx-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M11 11V3H5c-1.1 0-2 .9-2 2v6h8zm2 0h8V5c0-1.1-.9-2-2-2h-6v8zm-2 2H3v6c0 1.1.9 2 2 2h6v-8zm2 0v8h6c1.1 0 2-.9 2-2v-6h-8z"/></svg>
            </div>
            <h5 class="text-2xl font-semibold text-center text-zinc-900 dark:text-slate-100">{{$category_count}}</h5>
            <p class="text-center text-gray-500 dark:text-muted">Total Categories</p>
        </div>
        <div class="p-3 justify-center animate__animated animate__bounceIn hover:bg-slate-100 dark:hover:bg-zinc-700 duration-150 rounded bg-white dark:bg-zinc-800">

            <div class="bg-rose-500 text-white rounded-full p-4 my-3 w-fit mx-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M13 3c3.9 0 7 3.1 7 7c0 2.8-1.6 5.2-4 6.3V21H9v-3H8c-1.1 0-2-.9-2-2v-3H4.5c-.4 0-.7-.5-.4-.8L6 9.7C6.2 5.9 9.2 3 13 3m0-2C8.4 1 4.6 4.4 4.1 8.9L2.5 11c-.6.8-.6 1.8-.2 2.6c.4.7 1 1.2 1.7 1.3V16c0 1.9 1.3 3.4 3 3.9V23h11v-5.5c2.5-1.7 4-4.4 4-7.5c0-5-4-9-9-9m1 13h-2v-1h2v1m1.6-4.5c-.3.4-.6.8-1.1 1.1V12h-3v-1.4c-1.4-.8-1.9-2.7-1.1-4.1s2.7-1.9 4.1-1.1s1.9 2.7 1.1 4.1Z"/></svg>
            </div>
            <h5 class="text-2xl font-semibold text-center text-zinc-900 dark:text-slate-100">{{ $quiz_count }}</h5>
            <p class="text-center text-gray-500 dark:text-muted">Total Quizzes</p>
        </div>
     </div>
     <div class="animate__animated animate__bounceIn px-5 py-4 md:mt-6 bg-white dark:bg-zinc-800 rounded">

        <h5 class="text-zinc-900 dark:text-slate-100 text-xl font-semibold mb-3">Top Played Quizzes</h5>


        {{-- <div class="cursor-pointer hover:bg-slate-100 dark:hover:bg-zinc-600 duration-150 bg-slate-50 rounded dark:bg-zinc-700 text-zinc-900 dark:text-slate-100 px-4 py-3">popular quizzes</div> --}}

        <div class="relative overflow-x-auto rounded">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs font-semibold text-gray-900 uppercase dark:text-white bg-slate-200 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Quiz title
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Category Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Total Play
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ( $most_played_quizzes as $mq )
                    <tr class="bg-slate-50 dark:bg-gray-800 hover:bg-slate-100 dark:hover:bg-gray-600 duration-150">
                            <th scope="row" class=" px-6 py-4 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                            <a class=" hover:text-blue-600 dark:hover:text-blue-500 " href="{{ route('quiz.getDetail',$mq->quiz_id) }}">
                                {{ $mq->title }}
                            </a>

                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $mq->category_name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $mq->played_count }}
                            </td>


                    </tr>
                    <tr class="h-2 bg-transparent"></tr>
                    @endforeach





                </tbody>
            </table>
        </div>

     </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 md:space-x-3 space-y-3 md:space-y-0 mb-4 items-start">
    <div class=" bg-white dark:bg-zinc-800  animate__animated animate__bounceIn flex items-center justify-center  rounded ">
        <div class=" w-full rounded-lg shadow  p-4 md:p-6">
            <div class="flex justify-between">
              <div>
                <h5 id="userIncrement" class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2"></h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Users past 30 days</p>
              </div>
              <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                <div id="percentageChange">
                </div>
                <svg class="w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                </svg>
              </div>
            </div>
            <div id="area-chart"></div>

          </div>
    </div>
    <div class=" bg-white dark:bg-zinc-800  animate__animated animate__bounceIn flex items-center justify-center  rounded ">
        <div class=" w-full  shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between items-start w-full">
                <div class="flex-col items-center">
                  <div class="flex items-center mb-1">
                      <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Quiz Category Ratio</h5>
                      {{-- <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                      </svg> --}}

                </div>

            </div>
            </div>

            <!-- Line Chart -->
            <div class="" id="pie-chart"></div>


          </div>
    </div>


</div>



@endsection

@section('script-source')
    // ApexCharts options and config
    window.addEventListener("load", function() {
        const userCounts = @json($userCounts);
        const userDates = @json($dates);
        const userCountsBeforeStart = @json($userCountsBeforeStart);


        var userIncrement = 0;
        userCounts.map((count, index) => {



            userIncrement += userCounts[index];
        });
        if (userCountsBeforeStart !== 0) {
            percentageChange = (userIncrement / userCountsBeforeStart) * 100;
        } else {
            {{-- Handle the case where userCountsBeforeStart is zero --}}
            percentageChange = (userIncrement) * 100;
        }
        console.log(userCountsBeforeStart);



    let options = {
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        series: [{
            name: "New users",
            data: userCounts, // Use the userCounts variable here
            color: "#1A56DB",
        }],
        xaxis: {
            categories: userDates, // Use the userDates variable here
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
    }

    var categoryData = @json($categories_chart);

    {{-- Extract names and counts from the data --}}
    var labels = categoryData.map(category => category.name);
    var counts = categoryData.map(category => category.count);

    var totalCounts = 0;
    for(let i = 0 ; i < counts.length ; i++){
        totalCounts += counts[i];
    }
      const getChartOptions = () => {
        return {
          series: counts,
          colors: [
            "#1f77b4", "#ff7f0e", "#2ca02c", "#d62728", "#9467bd",
            "#8c564b", "#e377c2", "#7f7f7f", "#bcbd22", "#17becf",
            "#aec7e8", "#ffbb78", "#98df8a", "#ff9896", "#c5b0d5",
            "#c49c94", "#f7b6d2", "#c7c7c7", "#dbdb8d", "#9edae5"
        ],
          chart: {
            height: 420,
            width: "100%",
            type: "pie",
          },
          stroke: {
            colors: ["white"],
            lineCap: "",
          },
          plotOptions: {
            pie: {
              labels: {
                show: true,
              },
              size: "100%",
              dataLabels: {
                offset: -25
              }
            },
          },
          labels: labels,
          dataLabels: {
            enabled: true,
            style: {
              fontFamily: "Inter, sans-serif",
            },
          },
          legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
          },
          yaxis: {
            labels: {
              formatter: function (value) {
                return (value/totalCounts)*100 + "%"
              },
            },
          },
          xaxis: {
            labels: {
              formatter: function (value) {
                return (value/totalCounts)*100  + "%"
              },
            },
            axisTicks: {
              show: false,
            },
            axisBorder: {
              show: false,
            },
          },
        }
      }

      document.getElementById("percentageChange").textContent = percentageChange.toFixed(2) + " %";
      document.getElementById("userIncrement").textContent = userIncrement;


      if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("area-chart"), options);
        chart.render();
      }

      if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
        chart.render();
      }

    });
  @endsection
