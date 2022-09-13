@csrf
@extends('layouts.navbar')
@section('content')
@auth
<div class="flex justify-center">
    <div class="w-6/12 bg-white p-6 rounded-lg">
        <form action="{{ route('store') }}" method="post">
            @csrf
            <div>
                @if($coupon->coupon_type != 1) 
                <select id="coupon_type" name="coupon_type" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 mb-3">
                    <option value="{{$coupon->coupon_type}}">Select Coupon Type</option>
                    <option value="1">Single use</option>
                    <option value="2">Multiple limited</option>
                    <option value="3">Single expires</option>
                    <option value="4">Multiple expires</option>
                    <option value="5">Unlimited</option>
                </select> </div>
                <div>
                    <select id="coupon_subtype" name="coupon_subtype" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 mb-3">
                        <option value="{{$coupon->coupon_subtype}}">Select Coupon Subtype</option>
                        <option value="1">%Off</option>
                        <option value="2">Flat Rate OFF</option>
                        <option value="3">1+1 Free</option>

                        </select> 
            <div>
                @endif
                <input type="number" name="value" id="value" value="{{$coupon->value}}"  class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('value') border-red-500 @enderror" valure="">
            </div>

            @if($coupon->coupon_type == 2)
            <div> 
                <input type="number" name="limit" id="limit" value="{{$coupon->limit}}" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('value') border-red-500 @enderror" valure="">
            </div>
            @endif
            
            @if($coupon->coupon_type == 3 || $coupon->coupon_type == 4)
            <div>
                <input type="date" name="valid_until" id="subtype_value"  class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 @error('date') border-red-500 @enderror" valure="">
            </div>
            @endif
            <select id="status" value="{{$coupon->status}}"name="status" class="bg-gray-100 border-2 w-full p-4 rounded-lg mb-2 mb-3">
                <option value="{{$coupon->status}}">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="used">Used</option>

                </select>
                <input type="hidden" name="id" value="{{$coupon->id}}" >
            @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
        @endif

    <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
            Edit</button>
    </div>

    </form>
    @if(Session::has('message'))
    <h4 style="color: green">{{Session::pull('message')}}</h4>
    @endif
</div>
</div>
@endsection
@endauth
