@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')
@include('admin.partials.topbar')

<main class="lg:ml-64 pt-16 min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-cyan-900">
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.settings.integrations') }}" class="text-gray-400 hover:text-white">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">GenieACS Configuration</h1>
                    <p class="text-gray-400 mt-1">TR-069 ACS Server connection settings</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 p-6">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-500/20 border border-green-500/30 rounded-lg text-green-400">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('admin.settings.genieacs.save') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">Server Name</label>
                                <input type="text" name="name" value="{{ $setting->name ?? 'GenieACS Server' }}" 
                                       class="w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:border-cyan-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">NBI API URL <span class="text-red-400">*</span></label>
                                <input type="url" name="url" id="url" value="{{ $setting->getConfig('url') }}" required
                                       placeholder="http://192.168.1.100:7557"
                                       class="w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:border-cyan-500">
                                <p class="text-xs text-gray-500 mt-1">Default NBI port: 7557</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Username (optional)</label>
                                <input type="text" name="username" id="username" value="{{ $setting->getConfig('username') }}"
                                       placeholder="admin"
                                       class="w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:border-cyan-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Password (optional)</label>
                                <input type="password" name="password" id="password" value="{{ $setting->getConfig('password') }}"
                                       class="w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:border-cyan-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="enabled" value="1" {{ $setting->enabled ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-white/20 bg-white/5 text-cyan-500 focus:ring-cyan-500">
                                    <span class="text-gray-300">Enable GenieACS Integration</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 mt-6">
                            <button type="submit" class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>Save
                            </button>
                            <button type="button" onclick="testConnection()" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                                <i class="fas fa-plug mr-2"></i>Test Connection
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Test Result -->
            <div>
                <div class="bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">
                        <i class="fas fa-vial mr-2"></i>Test Result
                    </h3>
                    
                    <div id="testResult" class="hidden">
                        <div id="testSuccess" class="hidden p-4 bg-green-500/20 border border-green-500/30 rounded-lg">
                            <p class="text-green-400 font-semibold mb-2"><i class="fas fa-check-circle mr-2"></i>Connection Successful!</p>
                            <div class="text-sm text-green-300 space-y-1">
                                <p><strong>Device Count:</strong> <span id="resDeviceCount">-</span></p>
                            </div>
                        </div>
                        <div id="testError" class="hidden p-4 bg-red-500/20 border border-red-500/30 rounded-lg">
                            <p class="text-red-400 font-semibold mb-2"><i class="fas fa-times-circle mr-2"></i>Connection Failed</p>
                            <p class="text-sm text-red-300" id="errorMessage">-</p>
                        </div>
                    </div>
                    
                    <div id="testLoading" class="hidden text-center py-8">
                        <i class="fas fa-spinner fa-spin text-3xl text-cyan-400"></i>
                        <p class="text-gray-400 mt-2">Connecting...</p>
                    </div>
                    
                    <div id="testPlaceholder" class="text-center py-8 text-gray-500">
                        <i class="fas fa-router text-3xl mb-2"></i>
                        <p>Click "Test Connection" to verify</p>
                    </div>
                    
                    @if($setting->last_tested_at)
                        <div class="mt-4 pt-4 border-t border-white/10 text-sm text-gray-400">
                            <p>Last test: {{ $setting->last_tested_at->format('d/m/Y H:i') }}</p>
                            <p>Status: 
                                @if($setting->last_test_success)
                                    <span class="text-green-400">Success</span>
                                @else
                                    <span class="text-red-400">Failed</span>
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
                
                <!-- Help -->
                <div class="mt-4 bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
                    <h4 class="text-blue-400 font-semibold mb-2"><i class="fas fa-info-circle mr-2"></i>Help</h4>
                    <ul class="text-sm text-blue-300 space-y-1">
                        <li>• NBI API Port: 7557</li>
                        <li>• CWMP Port: 7547</li>
                        <li>• FS Port: 7567</li>
                        <li>• UI Port: 3000</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function testConnection() {
    const url = document.getElementById('url').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    if (!url) {
        alert('Please fill in the NBI API URL');
        return;
    }
    
    document.getElementById('testPlaceholder').classList.add('hidden');
    document.getElementById('testResult').classList.add('hidden');
    document.getElementById('testLoading').classList.remove('hidden');
    
    fetch('{{ route("admin.settings.genieacs.test") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ url, username, password })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('testLoading').classList.add('hidden');
        document.getElementById('testResult').classList.remove('hidden');
        
        if (data.success) {
            document.getElementById('testSuccess').classList.remove('hidden');
            document.getElementById('testError').classList.add('hidden');
            document.getElementById('resDeviceCount').textContent = data.data.device_count || '0';
        } else {
            document.getElementById('testSuccess').classList.add('hidden');
            document.getElementById('testError').classList.remove('hidden');
            document.getElementById('errorMessage').textContent = data.message;
        }
    })
    .catch(error => {
        document.getElementById('testLoading').classList.add('hidden');
        document.getElementById('testResult').classList.remove('hidden');
        document.getElementById('testSuccess').classList.add('hidden');
        document.getElementById('testError').classList.remove('hidden');
        document.getElementById('errorMessage').textContent = 'Network error: ' + error.message;
    });
}
</script>
@endsection
