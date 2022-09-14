@extends('layouts.navbar')
@section('content')


<div class="flex justify-center">
    <div id="grid" class="w-6/12 bg-white p-6 rounded-lg">
        @if(session('status'))
        {{session('status')}}
        @endif

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400  ">
            <tr>

                <li class="mb-4">
                    <th scope="col" class="py-3 px-6 ">
                        <a href="{{route('create')}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Create Coupon</a>
                    </th>
                </li>
                <li class="mb-4">
                    <th scope="col" class="py-3 px-6">
                        <a href="{{route('all')}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Show all coupon's</a>
                    </th>
                </li>
                <li class="mb-4">
                    <th scope="col" class="py-3 px-6">
                        <a href="{{route('used')}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Show used coupon's</a>
                    </th>
                </li>
                <li class="mb-4">
                    <th scope="col" class="py-3 px-6">
                        <a href="{{route('active')}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Show active coupon's</a>
                    </th>
                </li>
                <li class="mb-4">
                    <th scope="col" class="py-3 px-6">
                        <a href="{{route('non_used')}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Show Non-used coupon's</a>
                    </th>
                </li>
                <li class="mb-4">
                    <th scope="col" class="py-3 px-6">
                        <a href="{{route('emails')}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Email's</a>
                    </th>
                </li>

            </tr>
        </thead>
    </div>
</div>


@endsection