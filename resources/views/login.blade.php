@extends('layouts.navbar')
@section('content')
<div class="flex justify-center">
    <div class="w-6/12 bg-white p-6 rounded-lg">
        @if(session('status'))
        {{session('status')}}
        @endif
        <form action="{{ url('/login') }}" method="post">
            @csrf

            <div>
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('email') border-red-500 @enderror" valure="{{old('email')}}">
            </div>
            <div class="mb-2">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg  @error('password') border-red-500 @enderror" valure="">
                @error('password')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                    Log in</button>
            </div>

        </form>
    </div>
</div>
@endsection