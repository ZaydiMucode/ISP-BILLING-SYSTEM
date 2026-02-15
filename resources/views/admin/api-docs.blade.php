@extends('layouts.app')

@section('title', 'API Documentation')

@section('content')
<div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: false, activeTab: 'overview' }">
    @include('admin.partials.sidebar')

    <div class="lg:pl-64">
        @include('admin.partials.topbar')

        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">API Documentation</h1>
                <p class="text-gray-600">REST API for integration with external systems</p>
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-xl shadow mb-6">
                <div class="border-b flex overflow-x-auto">
                    <button @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'border-b-2 border-cyan-500 text-cyan-600' : 'text-gray-500'" class="px-6 py-3 font-medium">Overview</button>
                    <button @click="activeTab = 'auth'" :class="activeTab === 'auth' ? 'border-b-2 border-cyan-500 text-cyan-600' : 'text-gray-500'" class="px-6 py-3 font-medium">Authentication</button>
                    <button @click="activeTab = 'customer'" :class="activeTab === 'customer' ? 'border-b-2 border-cyan-500 text-cyan-600' : 'text-gray-500'" class="px-6 py-3 font-medium">Customer API</button>
                    <button @click="activeTab = 'admin'" :class="activeTab === 'admin' ? 'border-b-2 border-cyan-500 text-cyan-600' : 'text-gray-500'" class="px-6 py-3 font-medium">Admin API</button>
                    <button @click="activeTab = 'webhooks'" :class="activeTab === 'webhooks' ? 'border-b-2 border-cyan-500 text-cyan-600' : 'text-gray-500'" class="px-6 py-3 font-medium">Webhooks</button>
                </div>

                <div class="p-6">
                    <!-- Overview -->
                    <div x-show="activeTab === 'overview'">
                        <h2 class="text-xl font-bold mb-4">API Overview</h2>
                        <div class="prose max-w-none">
                            <p>Base URL: <code class="bg-gray-100 px-2 py-1 rounded">{{ url('/api') }}</code></p>
                            <p>Format: JSON</p>
                            <p>Authentication: Bearer Token (Laravel Sanctum)</p>
                            
                            <h3 class="text-lg font-semibold mt-6 mb-3">Response Format</h3>
                            <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto text-sm">{
    "success": true,
    "data": { ... },
    "message": "Optional message"
}</pre>

                            <h3 class="text-lg font-semibold mt-6 mb-3">Error Response</h3>
                            <pre class="bg-gray-900 text-red-400 p-4 rounded-lg overflow-x-auto text-sm">{
    "success": false,
    "message": "Error description",
    "errors": { "field": ["error message"] }
}</pre>

                            <h3 class="text-lg font-semibold mt-6 mb-3">HTTP Status Codes</h3>
                            <table class="min-w-full">
                                <tr><td class="py-2"><code>200</code></td><td>Success</td></tr>
                                <tr><td class="py-2"><code>201</code></td><td>Created</td></tr>
                                <tr><td class="py-2"><code>401</code></td><td>Unauthorized</td></tr>
                                <tr><td class="py-2"><code>422</code></td><td>Validation Error</td></tr>
                                <tr><td class="py-2"><code>500</code></td><td>Server Error</td></tr>
                            </table>
                        </div>
                    </div>

                    <!-- Authentication -->
                    <div x-show="activeTab === 'auth'" style="display: none;">
                        <h2 class="text-xl font-bold mb-4">Authentication</h2>
                        
                        <div class="space-y-6">
                            <!-- Customer Login -->
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/customer/login</code>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Customer login to obtain access token</p>
                                <h4 class="font-semibold text-sm mb-2">Request Body:</h4>
                                <pre class="bg-gray-100 p-3 rounded text-sm">{
    "username": "pppoe_username, phone, or email",
    "password": "password"
}</pre>
                                <h4 class="font-semibold text-sm mt-3 mb-2">Response:</h4>
                                <pre class="bg-gray-100 p-3 rounded text-sm">{
    "success": true,
    "token": "1|abc123...",
    "customer": { "id": 1, "name": "John Doe", ... }
}</pre>
                            </div>

                            <!-- Admin Login -->
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/admin/login</code>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Admin login to obtain access token</p>
                                <pre class="bg-gray-100 p-3 rounded text-sm">{
    "email": "admin@example.com",
    "password": "password"
}</pre>
                            </div>

                            <!-- Using Token -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-800 mb-2">Using the Token</h4>
                                <p class="text-sm text-blue-700 mb-2">Include the token in the header for endpoints requiring authentication:</p>
                                <pre class="bg-white p-3 rounded text-sm">Authorization: Bearer YOUR_TOKEN_HERE</pre>
                            </div>
                        </div>
                    </div>


                    <!-- Customer API -->
                    <div x-show="activeTab === 'customer'" style="display: none;">
                        <h2 class="text-xl font-bold mb-4">Customer API</h2>
                        
                        <div class="space-y-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/customer/profile</code>
                                    <span class="ml-auto text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Auth Required</span>
                                </div>
                                <p class="text-gray-600 text-sm">Retrieve the currently logged-in customer's profile</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">PUT</span>
                                    <code class="text-sm">/api/customer/profile</code>
                                    <span class="ml-auto text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Auth Required</span>
                                </div>
                                <p class="text-gray-600 text-sm">Update customer profile (phone, email, password)</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/customer/invoices</code>
                                    <span class="ml-auto text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Auth Required</span>
                                </div>
                                <p class="text-gray-600 text-sm">List customer invoices. Query: ?status=paid|unpaid&per_page=10</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/customer/invoices/{id}</code>
                                    <span class="ml-auto text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Auth Required</span>
                                </div>
                                <p class="text-gray-600 text-sm">Retrieve details for a specific invoice</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/customer/tickets</code>
                                    <span class="ml-auto text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Auth Required</span>
                                </div>
                                <p class="text-gray-600 text-sm">List customer support tickets</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/customer/tickets</code>
                                    <span class="ml-auto text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Auth Required</span>
                                </div>
                                <p class="text-gray-600 text-sm">Create a new support ticket</p>
                                <pre class="bg-gray-100 p-2 rounded text-xs mt-2">{
    "subject": "Slow connection",
    "category": "technical", // options: billing, technical, general, complaint
    "priority": "medium", // options: low, medium, high
    "message": "Problem description..."
}</pre>
                            </div>
                        </div>
                    </div>

                    <!-- Admin API -->
                    <div x-show="activeTab === 'admin'" style="display: none;">
                        <h2 class="text-xl font-bold mb-4">Admin API</h2>
                        
                        <div class="space-y-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/admin/dashboard</code>
                                </div>
                                <p class="text-gray-600 text-sm">Dashboard statistics (total customers, revenue, invoices)</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/admin/customers</code>
                                </div>
                                <p class="text-gray-600 text-sm">Customer list. Query: ?status=active&search=name&per_page=15</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/admin/customers</code>
                                </div>
                                <p class="text-gray-600 text-sm">Create a new customer</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">PUT</span>
                                    <code class="text-sm">/api/admin/customers/{id}</code>
                                </div>
                                <p class="text-gray-600 text-sm">Update customer information</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/admin/invoices</code>
                                </div>
                                <p class="text-gray-600 text-sm">Invoice list. Query: ?status=unpaid&customer_id=1</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/admin/invoices/{id}/pay</code>
                                </div>
                                <p class="text-gray-600 text-sm">Mark an invoice as paid</p>
                            </div>
                        </div>
                    </div>

                    <!-- Webhooks -->
                    <div x-show="activeTab === 'webhooks'" style="display: none;">
                        <h2 class="text-xl font-bold mb-4">Webhooks</h2>
                        
                        <div class="space-y-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/webhooks/midtrans</code>
                                </div>
                                <p class="text-gray-600 text-sm">Webhook for Midtrans payment notifications</p>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">POST</span>
                                    <code class="text-sm">/api/webhooks/xendit</code>
                                </div>
                                <p class="text-gray-600 text-sm">Webhook for Xendit payment notifications</p>
                            </div>

                            <div class="bg-gray-50 border rounded-lg p-4 mt-6">
                                <h4 class="font-semibold mb-2">Health Check</h4>
                                <div class="flex items-center">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold mr-3">GET</span>
                                    <code class="text-sm">/api/health</code>
                                </div>
                                <p class="text-gray-600 text-sm mt-2">Check API server status</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
