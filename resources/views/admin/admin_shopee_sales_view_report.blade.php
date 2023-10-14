@extends('admin.admin_home')

@section('admin-body')


<form>
    <div class="flex flex-row items-center gap-1">
       
        <select class="text-xs rounded-sm">
            <option disabled selected>----------------------</option>
            <option value="daily">Daily</option>
            <optiion value="weekly">Weekly</optiion>
            <option value="monthly">Monthly</option>
            <option value="quarterly">Quarterly</option>
            <option value="yearly">Yearly</option>
        </select>
        <button type="submit" class="bg-teal-500 hover:bg-teal-600 font-bold p-1.5 text-gray-200 rounded-md"><i class="fa-solid fa-right-to-bracket"></i> Generate</button>
    </div>
</form>

{{-- @if(isset()) --}}
<div class="mt-4 w-full">
    <div class="flex justify-end">
        <button class="flex justify-end bg-teal-500 hover:bg-teal-600 p-0.5 rounded-sm text-gray-200 mb-1">Download</button>
    </div>
    
    <table class="w-full">
        <thead class="bg-orange-600 h-8 text-gray-200">
            <tr>
                <th class="w-1/6">ID</th>
                <th class="w-1/6">NAME</th>
                <th class="w-1/6">STATUS</th>
                <th class="w-1/6">DATE</th>
                <th class="w-1/6">TOTAL AMOUNT</th>
                <th class="w-1/6">ITEMS</th>
            </tr>
        </thead>
        <tbody class="text-center bg-gray-200 shadow-sm h-6">
            <tr>
                <td>s</td>
                <td>s</td>
                <td>s</td>
                <td>s</td>
                <td>s</td>
                <td>s</td>
            </tr>
        </tbody>
    </table>
</div>
{{-- @endif --}}

@endsection