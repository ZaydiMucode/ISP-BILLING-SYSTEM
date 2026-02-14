@extends('layouts.customer')

@section('title', 'Internet Usage')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-cyan-600 to-blue-700 rounded-2xl p-6 text-white">
        <h1 class="text-2xl font-bold">Internet Usage</h1>
        <p class="text-cyan-100 mt-1">Monitor your bandwidth usage</p>
    </div>

    <!-- Current Package -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Active Package</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-cyan-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">Package Name</p>
                <p class="text-xl font-bold text-cyan-700">{{ $customer->package->name ?? 'N/A' }}</p>
            </div>
            <div class="bg-blue-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">Speed</p>
                <p class="text-xl font-bold text-blue-700">{{ $customer->package->speed ?? 'N/A' }}</p>
            </div>
            <div class="bg-green-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">Status</p>
                <p class="text-xl font-bold {{ $customer->status == 'active' ? 'text-green-700' : 'text-red-700' }}">
                    {{ $customer->status == 'active' ? 'Active' : 'Inactive' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Connection Info -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Connection Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">PPPoE Username</p>
                <p class="font-medium text-gray-800">{{ $customer->pppoe_username ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Registration Date</p>
                <p class="font-medium text-gray-800">{{ $customer->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Usage Tips -->
    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
        <h3 class="font-semibold text-blue-800 mb-3"><i class="fas fa-lightbulb mr-2"></i>Usage Tips</h3>
        <ul class="text-sm text-blue-700 space-y-2">
            <li>• Restart your modem/router if the connection is slow</li>
            <li>• Ensure no background applications are consuming excessive bandwidth</li>
            <li>• Contact support if the problem persists</li>
        </ul>
    </div>
</div>
@endsection
