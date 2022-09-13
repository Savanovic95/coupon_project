@extends('layouts.navbar')
@section('content')

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    @if(session('status'))
    {{session('status')}}
    @endif
    <center><strong><h1 class="mb-2 bold">Email's</h1></strong></center>
    <form class="input-sm" action="{{ route('filters') }}" method="post">
        @csrf
        <input type="hidden" name="view" value="email.email">
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
            <div class="w-full md:w-1/2 px-3">
                
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Used Coupons
                </label>
                <input name="coupon_used" class="appearance-none block w-full bg-white-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" >
                
              </div>
            
              
            
              <div class="w-full md:w-1/2 px-3">
                
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Email
                </label>
                <input name="email" class="appearance-none block w-full bg-white-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="email" >
                
              </div>
              
          
        
        
              <button type="submit" style="align-self:center; margin:10px 0 0 5px;" class=" bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded mr-4" >Filter</button>        </div>  
        </div>  
    </form>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Email
                </th>
                <th scope="col" class="py-3 px-6">
                    First coupon used
                </th>
                <th scope="col" class="py-3 px-6">
                    Last coupon used
                </th>
                <th scope="col" class="py-3 px-6">
                    Coupons used
                </th>
                <th scope="col" class="py-3 px-6">
                    Created at
                </th>

            </tr>
        </thead>

        @if ($allCoupons->count())
        @foreach ($allCoupons as $email)
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$email->email}}
                </th>
                <td class="py-4 px-6">
                    {{$email->first_coupon_use}}
                </td>
                <td class="py-4 px-6">
                    {{$email->last_coupon_use}}
                </td>
                <td class="py-4 px-6">
                    {{$email->coupons_used}}
                </td>
                <td class="py-4 px-6">
                    {{$email->created_at}}
                </td>


                
            </tr>
        </tbody>
        @endforeach
        @else
        <p>There are no emails</p>
        @endif
    </table>
</div>


@endsection