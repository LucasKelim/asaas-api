<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($products as $product)
                        <div class="flex pb-3 items-center justify-between border-b-2 last:border-b-0 last:pb-0">
                            <div>
                                <a href="{{ route('products.show', $product->id) }}">
                                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                                </a>
                                <p class="text-sm text-gray-600">R$ {{ $product->price }}</p>
                            </div>
                            <div class="flex space-x-2">
                                {{-- <a href="{{ route('products.buy', $product->id) }}"> --}}
                                    <x-primary-button>
                                        Buy
                                    </x-primary-button>
                                {{-- </a> --}}
                            </div>
                        </div>
                    @empty
                        <h2>Any product found</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>