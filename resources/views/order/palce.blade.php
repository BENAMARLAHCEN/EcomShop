@extends('layout.app')

@section('content')
<div class="container mx-auto">
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Place Order</h1>
        @if (session('error'))
            <div class="text-red-500">{{ session('error') }}</div>
        @endif
        <form action="{{ route('mollie') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="address"  ="block text-gray-700 font-bold mb-2">Address</label>
                <textarea name="address" id="address" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500">{{ old('address') }}</textarea>
                @error('address')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Place Order</button>
        </form>
    </div>
</div>
@endsection
