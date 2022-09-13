@csrf
@extends('layouts.navbar')
@section('content')
{{-- @auth --}}
<div class="flex justify-center">
    <div class="w-6/12 bg-white p-6 rounded-lg">
        <form action="{{ route('create') }}" method="post">
            @csrf
            <div>
                <label for="email" class="sr-only">Enter Email Adress</label>
                <input type="email" name="email" id="email" placeholder="Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('name') border-red-500 @enderror" valure="">
            </div>
            <div>
                <select id="coupon_type" name="coupon_type" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 mb-3">
                    <option value="">Select Coupon Type</option>
                    <option value="1">Single use</option>
                    <option value="2">Multiple limited</option>
                    <option value="3">Single expires</option>
                    <option value="4">Multiple expires</option>
                    <option value="5">Unlimited</option>
                </select> </div>
                <div>
                    <select id="coupon_subtype" name="coupon_subtype" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 mb-3">
                        <option value="">Select Coupon Subtype</option>
                        <option value="1">%Off</option>
                        <option value="2">Flat Rate OFF</option>
                        <option value="3">1+1 Free</option>

                    </select> 
            <div>
                <input type="number" name="value" id="value" placeholder="Value" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('value') border-red-500 @enderror" valure="">
            </div>

            <div>
                <input type="number" name="limit" id="limit" placeholder="Limit" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('value') border-red-500 @enderror" valure="">
            </div>
            <div>
                <input type="date" name="valid_until" id="subtype_value"  class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('date') border-red-500 @enderror" valure="">
            </div>
            @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
        @endif

    <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
            Submit</button>
    </div>

    </form>
    @if(Session::has('message'))
    <h4 style="color: green">{{Session::pull('message')}}</h4>
    @endif
</div>
</div>
@endsection
{{-- @endauth --}}
