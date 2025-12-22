<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Bimbel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-100 via-emerald-200 to-emerald-300">
    <div class="w-full max-w-md px-4">
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8">
            <!-- Logo Container -->
            <div class="text-center mb-8">
                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="Logo Sistem Bimbel" 
                    class="w-28 h-28 mx-auto mb-4 object-contain drop-shadow-lg"
                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22 viewBox=%220 0 120 120%22%3E%3Ccircle cx=%2260%22 cy=%2260%22 r=%2250%22 fill=%22%2310b981%22/%3E%3Cpath d=%22M40 50 L50 60 L75 35%22 stroke=%22white%22 stroke-width=%226%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3Cpath d=%22M35 70 L85 70 M40 80 L80 80 M45 90 L75 90%22 stroke=%22white%22 stroke-width=%224%22 stroke-linecap=%22round%22/%3E%3C/svg%3E'"
                >
                <h3 class="text-2xl font-semibold text-emerald-700 mb-2">Login Sistem Bimbel</h3>
                <p class="text-gray-500 text-sm">Selamat datang kembali</p>
            </div>
            
            <!-- Error Alert -->
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all outline-none"
                        required
                    >
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all outline-none"
                        required
                    >
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full mt-6 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>