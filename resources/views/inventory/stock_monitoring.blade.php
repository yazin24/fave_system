@extends('inventory.inventory_home')

@section('stock_monitoring')

    <div>
        <h2>Stock Monitoring</h2>
            <table class="border border-gray-900 rounded-lg justify-center items-center">
                <thead>
                    <tr class="border border-gray-900 rounded-md bg-gray-900 text-gray-200">
                        <th>Stock Name</th>
                        <th>Opening Stock</th>
                        <th>New Purchase</th>
                        <th>Total Stock</th>
                        <th>Output</th>
                        <th>Ending Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border border-gray-900 rounded-md">
                        <td>Sample</td>
                        <td>23</td>
                        <td>45</td>
                        <td>78</td>
                        <td>200</td>
                        <td>56</td>
                        <td class="p-1"><button class="bg-blue-500 p-1 text-gray-200 text-xs rounded-md">Update</button><button class="bg-red-500 p-1 text-xs text-gray-200 rounded-md ml-1">Delete</button></td>
                    </tr>
                    <tr class="border border-gray-900 rounded-md">
                        <td>Sample1</td>
                        <td>238</td>
                        <td>452</td>
                        <td>780</td>
                        <td>20</td>
                        <td>569</td>
                        <td class="p-1"><button class="bg-blue-500 p-1 text-gray-200 text-xs rounded-md">Update</button><button class="bg-red-500 p-1 text-xs text-gray-200 rounded-md ml-1">Delete</button></td>
                    </tr>
                    <tr class="border border-gray-900 rounded-md">
                        <td>Sample2</td>
                        <td>03</td>
                        <td>45</td>
                        <td>78</td>
                        <td>0</td>
                        <td>96</td>
                        <td class="p-1"><button class="bg-blue-500 p-1 text-gray-200 text-xs rounded-md">Update</button><button class="bg-red-500 p-1 text-xs text-gray-200 rounded-md ml-1">Delete</button></td>
                    </tr>
                </tbody>
            </table>
    </div>

@endsection