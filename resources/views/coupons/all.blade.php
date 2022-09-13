@extends('layouts.navbar')
@section('content')

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    @if(session('status'))
    {{session('status')}}
    @endif
    
    <center><strong><h1 class="mb-2 bold">All Coupons</h1></strong></center>
    <form class="input-sm" action="{{ route('filters') }}" method="post">
        @csrf
        <input type="hidden" name="view" value="coupons.all">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                From
              </label>
              <input  type="date" placeholder="yyyy-mm-dd" name="created_at" class="appearance-none block w-full bg-white-200 text-gray-700 border border-black-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white " id="grid-first-name" type="text" >
              
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                To
              </label>
              <input  type="date" placeholder="dd-mm-yyyy" name="created_to" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" >
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Type
                </label>
                <select id="select" name="coupon_type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    <option  value="">Select</option>
                    <option value="1">Single</option>
                    <option value="2">Multi-limit</option>
                    <option value="3">Single-expires</option>
                    <option value="4">Multi-expires</option>
                    <option value="5">Unlimited</option>
                  </select>
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Subtype
                </label>
                <select id="select" name="coupon_subtype" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    <option value="">Select</option>
                    <option value="1">%OFF</option>
                    <option value="2">Flat</option>
                    <option value="3">1+1</option>
                  </select>
              </div>
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Value
                </label>
                <input name="value" class="appearance-none block w-full bg-white-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="number" >
                
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Status
                </label>
                <select id="select" name="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    <option value="" >Select</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="used">Used</option>
                  </select></div>
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Used times
                </label>
                <input name="used_times" class="appearance-none block w-full bg-white-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="number" >
                
              </div>
              
          
        
        
        <button type="submit" style="align-self:center; margin:10px 0 0 5px;" class=" bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded mr-4" >Filter</button>
        </div>  
    </form>


    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Id
                </th>
                <th scope="col" class="py-3 px-6">
                    Creator Email
                </th>
                <th scope="col" class="py-3 px-6">
                    Coupon
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
                    Used times
                </th>
                <th scope="col" class="py-3 px-6">
                    Valid untill
                </th>
                <th scope="col" class="py-3 px-6">
                    Created at
                </th>
                <th scope="col" class="py-3 px-6">
                    Updated at
                </th>
                <th scope="col" class="py-3 px-6">
                    Used at
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
                    {{$coupon->id}}
                </th>
                <td class="py-4 px-6">
                    {{$coupon->creator_email}}
                </td>
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
                    {{$coupon->used_times}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->valid_until}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->created_at}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->updated_at}}
                </td>
                <td class="py-4 px-6">
                    {{$coupon->used_at}}
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
    
    
</div>



@endsection