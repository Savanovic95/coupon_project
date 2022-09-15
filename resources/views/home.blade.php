@extends('layouts.navbar')
@section('content')
@if(session('status'))
{{session('status')}}
@endif


<div class="relative py-16 bg-gradient-to-br from-sky-50 to-gray-200">
    <div class="relative container m-auto px-6 text-gray-500 md:px-12 xl:px-40">
        <div class="m-auto md:w-8/12 lg:w-6/12 xl:w-6/12">
            <div class="rounded-xl bg-white shadow-xl">
                <div class="p-6 sm:p-16">
                    <div class="space-y-4">

                        <center>
                            <h2 class="mb-8 text-2xl text-cyan-900 font-bold">Coupon Project CMS</h2>
                        </center>
                    </div>
                    <div class="mt-16 grid space-y-4">
                        <button class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">
                                <a href="{{route('create')}}">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Create new coupon</span>
                                </a>
                            </div>
                        </button>
                        <button class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">

                                <a href="{{route('all')}}">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Show all coupon's</span>
                                </a>
                            </div>
                        </button>
                        <button class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                     hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">

                                <a href="{{route('used')}}">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Show used coupon's</span>
                                </a>
                            </div>
                        </button>
                        <button class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                     hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">

                                <a href="{{route('active')}}">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Show active coupon's</span>
                                </a>
                            </div>
                        </button>
                        <button class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                     hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">

                                <a href="{{route('non_used')}}">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Show non used coupon's</span>
                                </a>
                            </div>
                        </button>
                        <button class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                     hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">

                                <a href="{{route('emails')}}">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Show all email's</span>
                                </a>
                            </div>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection