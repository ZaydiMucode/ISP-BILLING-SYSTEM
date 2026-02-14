@extends('layouts.customer')

@section('title', 'Support')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Help Center</h1>

    <!-- Contact Info -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Contact Us</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                    <i class="fab fa-whatsapp text-white text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">WhatsApp</p>
                    <p class="text-sm text-gray-500">0812-3456-7890</p>
                </div>
            </a>
            
            <a href="tel:+6281234567890" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-phone text-white text-xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Phone</p>
                    <p class="text-sm text-gray-500">0812-3456-7890</p>
                </div>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Frequently Asked Questions</h2>
        
        <div class="space-y-4" x-data="{ open: null }">
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 1 ? null : 1" class="w-full flex items-center justify-between p-4 text-left">
                    <span class="font-medium text-gray-800">How do I pay my bill?</span>
                    <i class="fas fa-chevron-down transition" :class="open === 1 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open === 1" x-collapse class="px-4 pb-4 text-gray-600 text-sm">
                    You can pay your bill through the Invoices menu. Select the invoice you want to pay, then click the Pay button. Various payment methods are available, such as QRIS, Bank Transfer, and E-Wallets.
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 2 ? null : 2" class="w-full flex items-center justify-between p-4 text-left">
                    <span class="font-medium text-gray-800">My internet is slow, what should I do?</span>
                    <i class="fas fa-chevron-down transition" :class="open === 2 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open === 2" x-collapse class="px-4 pb-4 text-gray-600 text-sm">
                    Try restarting your router/modem first. If it is still slow, contact our technical team via WhatsApp for further checking.
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 3 ? null : 3" class="w-full flex items-center justify-between p-4 text-left">
                    <span class="font-medium text-gray-800">How do I upgrade my package?</span>
                    <i class="fas fa-chevron-down transition" :class="open === 3 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open === 3" x-collapse class="px-4 pb-4 text-gray-600 text-sm">
                    To upgrade your package, please contact our customer service via WhatsApp or phone. Our team will assist you with the upgrade process.
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Ticket -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Submit a Ticket</h2>
        
        <form action="{{ route('customer.support.submit') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Subject</label>
                <input type="text" name="subject" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                    placeholder="Enter ticket subject">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Category</label>
                <select name="category" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    <option value="">Select category</option>
                    <option value="billing">Billing Issue</option>
                    <option value="technical">Technical Issue</option>
                    <option value="installation">Installation</option>
                    <option value="complaint">Complaint</option>
                    <option value="inquiry">Inquiry</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Message</label>
                <textarea name="message" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                    placeholder="Describe your issue..."></textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-600 text-white py-3 rounded-lg font-semibold hover:bg-cyan-700 transition">
                <i class="fas fa-paper-plane mr-2"></i>Send Ticket
            </button>
        </form>
    </div>
</div>
@endsection
