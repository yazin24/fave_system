@extends('admin.admin_home')

@section('admin-body')


<form>
    <div class="flex flex-row items-center gap-1">
       
        <select class="text-xs rounded-sm">
            <option>----------------------</option>
            <option>Daily</option>
            <optiion>Weekly</optiion>
            <option>Monthly</option>
            <option>Quarterly</option>
            <option>Yearly</option>
        </select>
        <button type="submit" class="bg-teal-500 hover:bg-teal-600 font-bold p-1.5 text-gray-200 rounded-md"><i class="fa-solid fa-right-to-bracket"></i> Generate</button>
    </div>
</form>

@endsection