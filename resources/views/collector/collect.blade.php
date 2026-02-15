@extends('layouts.collector')

@section('title', 'Receive Payment')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Receive Payment</h1>
        <a href="{{ route('collector.invoices') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
    </div>

    @if($invoice)
    <!-- Invoice Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Invoice Details</h2>
        
        <div class="grid grid-cols-2 gap-4 text-sm mb-6">
            <div>
                <p class="text-gray-500">Invoice No.</p>
                <p class="font-medium text-gray-800">{{ $invoice->invoice_number }}</p>
            </div>
            <div>
                <p class="text-gray-500">Due Date</p>
                <p class="font-medium {{ $invoice->due_date < now() ? 'text-red-600' : 'text-gray-800' }}">
                    {{ $invoice->due_date->format('d M Y') }}
                </p>
            </div>
            <div>
                <p class="text-gray-500">Customer</p>
                <p class="font-medium text-gray-800">{{ $invoice->customer->name ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Address</p>
                <p class="font-medium text-gray-800">{{ $invoice->customer->address ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <span class="text-blue-800 font-medium">Total Balance</span>
                <span class="text-2xl font-bold text-blue-600">₱  {{ number_format($invoice->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Form</h2>
        
        <form action="{{ route('collector.collect.process', $invoice) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Amount Paid <span class="text-red-500">*</span></label>
                <input type="number" name="amount" value="{{ $invoice->total }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    min="1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Payment Method <span class="text-red-500">*</span></label>
                <select name="payment_method" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="cash">Cash</option>
                    <option value="transfer">Bank Transfer</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2">Notes</label>
                <textarea name="notes" rows="2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Additional notes (optional)"></textarea>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                <i class="fas fa-check mr-2"></i>Confirm Payment
            </button>
        </form>
    </div>
    @else
    <!-- Search Invoice -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Search Invoice</h2>
        
        <form action="{{ route('collector.invoices') }}" method="GET">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Customer Name / ID</label>
                <input type="text" name="search" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter customer name or ID">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                <i class="fas fa-search mr-2"></i>Search Invoice
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
