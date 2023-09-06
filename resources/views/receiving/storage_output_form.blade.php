@extends('receiving.receiving_home')

@section('receiving-body')

        <h2 class="font-bold md:text-xl mt-2">Update Sku Storage</h2>
        @if($errors -> any())
            <div class="text-red-600 font-bold text-xs">
                <ul>
                    @foreach($errors -> all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-gray-900 rounded-md p-2 md:px-4 md:py-4 max-w-screen-sm mt-4">
                <form method="POST" action="{{route('storageskuupdate', ['storageSku' => $storageSku -> id])}}">
                    @csrf
                    @method('PUT')
                <div class="bg-gray-200 px-4 py-4">
                    <div class="flex flex-wrap justify-between md:mx-8">
                   
                  
                </div>
                
                        <h2 class="font-bold mb-2">Codename: {{$storageSku -> productSku -> full_name}}</h2>
                        <h2 class="font-bold mb-2">Variant: {{$storageSku -> productSku -> productVariants -> variant_name}}</h2>
                        <h2 class="font-bold mb-2">Size: 
                            @if($storageSku -> productSku -> sku_size == 3785.41) 1 Gallon
                            @elseif($storageSku -> productSku -> sku_size == 1000) 1 Liter
                            @elseif($storageSku -> productSku -> sku_size == 900) 900 Grams
                            @elseif($storageSku -> productSku -> sku_size == 180) 180 Grams
                            @endif
                        </h2>
                        <h2 class="font-bold mb-2">Total Quantity(Drums): {{$storageSku -> quantity}}</h2>
                    <div>
                        
                        <select id="" name="action" class="w-full text-gray-900 text-xs h-8 mb-2 font-bold" required>
                            <option value="" disabled selected>Choose Action</option>
                            <option value="Add">Input</option>
                            <option value="Subtract">Output</option>
                            
                        </select>
                    </div>
                    <div>
                        <input type="number" name="quantity" class="h-8 w-full text-xs" placeholder="Insert Quantity here">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="p-1 bg-teal-500 text-gray-200 font-bold hover:bg-teal-600 rounded-md shadow-md">Submit</button>
                    </div>
                
                </div>
                </form>
             </div>
        
        </div>

@endsection