@extends('layouts.navbar')
@section('content')

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    @if(session('status'))
    {{session('status')}}
    @endif
    <center><strong>
            <h1 class="mb-2 bold">Active Coupons</h1>
        </strong></center>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Creator Email
                </th>
                <th scope="col" class="py-3 px-6">
                    Code
                </th>
                <th scope="col" class="py-3 px-6">
                    Type
                </th>
                <th scope="col" class="py-3 px-6">
                    Subtype
                </th>
                <th scope="col" class="py-3 px-6">
                    Value
                </th>
                <th scope="col" class="py-3 px-6">
                    Limit
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Action
                </th>
            </tr>
        </thead>

        @if ($allCoupons->count())
        @foreach ($allCoupons as $coupon)
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$coupon->creator_email}}
                </th>
                <td class="py-4 px-6">
                    {{$coupon->coupon_code}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->type_name}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->subtype_name}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->value}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->limit}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->status}}
                </td>

                <td class="py-4 px-6">
                    @if ($coupon->status == 'active')
                    <form action="{{route('edit')}}" method="POST" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">
                        @csrf
                        <input type="hidden" name="id" value="{{$coupon->id}}">
                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                    </form>

                    <form action="{{route('delete')}}" method="POST">
                        @csrf
                        @method ('DELETE')
                        <input type="hidden" name="id" value="{{$coupon->id}}">
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                    </form>
                    @endif

                </td>
            </tr>
        </tbody>
        @endforeach
        @else
        <p>There are no coupons</p>
        @endif
    </table>
    {{$allCoupons->onEachSide(5)->links()}}
</div>


@endsection