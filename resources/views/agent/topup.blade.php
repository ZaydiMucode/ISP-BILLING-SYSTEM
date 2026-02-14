@extends('layouts.agent')

@section('title', 'Top Up Balance')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Top Up Balance</h1>
        <a href="{{ route('agent.dashboard') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
    </div>

    <!-- Current Balance -->
    <div class="bg-gradient-to-r from-emerald-600 to-green-600 rounded-xl p-6 text-white">
        <p class="text-emerald-100 text-sm">Current Balance</p>
        <p class="text-3xl font-bold">Rp {{ number_format($agent->balance ?? 0, 0, ',', '.') }}</p>
    </div>

    <!-- Top Up Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Request Top Up</h2>
        
        <form action="{{ route('agent.topup.process') }}" method="POST">
            @csrf
            
            <!-- Quick Amount Selection -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Select Amount</label>
                <div class="grid grid-cols-3 gap-3" x-data="{ selected: null }">
                    @foreach([100000, 200000, 500000, 1000000, 2000000, 5000000] as $amount)
                    <button type="button" 
                            @click="selected = {{ $amount }}; document.getElementById('amount').value = {{ $amount }}"
                            :class="selected == {{ $amount }} ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200'"
                            class="border-2 rounded-lg p-3 text-center hover:border-emerald-300 transition">
                        <span class="font-semibold text-gray-800">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                    </button>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Or Enter Amount</label>
                <input type="number" name="amount" id="amount" required min="50000"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    placeholder="Minimum ₱ 50.00">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2">Notes (Optional)</label>
                <textarea name="notes" rows="2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    placeholder="Additional notes"></textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                <i class="fas fa-paper-plane mr-2"></i>Send Top Up Request
            </button>
        </form>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
        <h3 class="font-semibold text-blue-800 mb-3">
            <i class="fas fa-info-circle mr-2"></i>How to Top Up
        </h3>
        <ol class="text-blue-700 text-sm space-y-2">
            <li>1. Select or enter the top up amount</li>
            <li>2. Send the top up request</li>
            <li>3. Transfer to the account listed below</li>
            <li>4. Confirm payment via WhatsApp</li>
            <li>5. Balance will be added after verification</li>
        </ol>
        
        <div class="mt-4 p-4 bg-white rounded-lg">
            <p class="text-sm text-gray-600 mb-2">Transfer to:</p>
            <p class="font-semibold text-gray-800">Bank BCA</p>
            <p class="text-lg font-mono text-gray-800">1234567890</p>
            <p class="text-gray-600">Account Name: {{ companyName() }}</p>
        </div>
    </div>
</div>
@endsection
