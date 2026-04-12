<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>TCC ScholarNet</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
body { font-family: 'Poppins', sans-serif; }

/* Mobile menu animations */
#mobile-menu {
  transform: translateY(-100%);
  opacity: 0;
  transition: all 0.3s ease-in-out;
}

#mobile-menu:not(.hidden) {
  transform: translateY(0);
  opacity: 1;
}

/* Hamburger to X animation */
.hamburger-line {
  transition: all 0.3s ease-in-out;
}

/* Modal animations */
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

@keyframes rotate-slow {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes spin-slow {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-float-slow {
  animation: float 8s ease-in-out infinite;
}

.animate-rotate-slow {
  animation: rotate-slow 20s linear infinite;
}

.animate-spin-slow {
  animation: spin-slow 15s linear infinite;
}

/* Custom scrollbar styles */
.scrollbar-thin {
  scrollbar-width: thin;
  scrollbar-color: #218358 #f3f4f6;
}

.scrollbar-thin::-webkit-scrollbar {
  width: 6px;
}

.scrollbar-thin::-webkit-scrollbar-track {
  background: #f3f4f6;
  border-radius: 3px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
  background: #218358;
  border-radius: 3px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
  background: #1a6845;
}

/* Form transition styles */
.form-content {
  overflow: hidden;
  max-height: 0;
  opacity: 0;
  transform: translateY(-20px);
  transition: max-height 0.35s ease, opacity 0.35s ease, transform 0.35s ease;
  pointer-events: none;
}

.form-content.form-open {
  max-height: 1200px;
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

/* Modal animation styles */
#authModal {
  transition: opacity 0.4s ease-out, transform 0.4s ease-out;
}

#authModal.hidden {
  opacity: 0;
  transform: translateY(-50px) scale(0.95);
}

/* Improve mobile touch targets */
@media (max-width: 768px) {
  .mobile-menu-button {
    padding: 12px;
    margin: -8px;
  }

  /* Better mobile spacing */
  .hero-content {
    padding-top: 5rem;
  }

  /* Mobile menu backdrop */
  #mobile-menu {
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
}
</style>
</head>
<body class="bg-[#fbfefc] text-[#202020]">

<!-- NAVBAR -->
<header class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-[#c4e8d1]">
  <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/tcc-logo.png') }}" alt="TCC Logo" class="w-8 md:w-10 h-8 md:h-10 object-contain">
      <span class="text-xl md:text-2xl font-bold text-[#218358]">TCC ScholarNet</span>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex items-center gap-8 font-medium">
      <a href="#" class="hover:text-[#30a46c] transition">Home</a>
      <a href="#features" class="hover:text-[#30a46c] transition">Features</a>
      <a href="#about" class="hover:text-[#30a46c] transition">About</a>
      <a href="#contact" class="hover:text-[#30a46c] transition">Contact</a>
      <button onclick="openAuthModal()" class="bg-[#30a46c] text-white px-6 py-2 rounded-lg shadow hover:bg-[#218358] transition font-semibold">Sign In</button>
    </nav>

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="md:hidden mobile-menu-button p-2 rounded-lg hover:bg-[#c4e8d1]/30 transition">
      <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-[#c4e8d1] shadow-lg">
    <div class="px-4 py-6 space-y-4">
      <!-- Navigation Links -->
      <div class="space-y-3">
        <a href="#" class="block px-3 py-2 text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-lg transition">Home</a>
        <a href="#features" class="block px-3 py-2 text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-lg transition">Features</a>
        <a href="#about" class="block px-3 py-2 text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-lg transition">About</a>
        <a href="#contact" class="block px-3 py-2 text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-lg transition">Contact</a>
      </div>

      <!-- Auth Button -->
      <div class="border-t border-[#c4e8d1] pt-4">
        <button onclick="openAuthModal()" class="block w-full text-center px-4 py-3 bg-[#30a46c] text-white font-semibold rounded-lg shadow hover:bg-[#218358] transition">
          Sign In
        </button>
      </div>
    </div>
  </div>
</header>

<!-- HERO SECTION -->
<section class="min-h-screen flex items-center pt-20 md:pt-28 relative overflow-hidden">
  <!-- background gradient -->
  <div class="absolute inset-0 bg-gradient-to-br from-[#218358] via-[#30a46c] to-[#8eceaa]"></div>

  <!-- decorative shapes -->
  <div class="absolute right-[-120px] top-20 w-[300px] h-[300px] md:w-[500px] md:h-[500px] border-[30px] md:border-[60px] border-white/10 rounded-full"></div>
  <div class="absolute right-[40px] md:right-[80px] bottom-[-80px] md:bottom-[-120px] w-[250px] h-[250px] md:w-[400px] md:h-[400px] border-[20px] md:border-[40px] border-white/10 rounded-full"></div>

  <div class="relative max-w-7xl mx-auto px-4 md:px-8 grid md:grid-cols-2 gap-8 md:gap-12 items-center z-10">

    <!-- LEFT CONTENT -->
    <div class="text-white text-center md:text-left">
      <p class="text-[#c4e8d1] font-medium mb-3 text-sm md:text-base">OFFICIAL SCHOLARSHIP PLATFORM</p>
      <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
        TCC ScholarNet<br>
        <span class="text-xl md:text-2xl lg:text-3xl">Centralized Scholarship System</span>
      </h1>
      <p class="text-base md:text-lg text-white/90 mb-8 leading-relaxed max-w-lg mx-auto md:mx-0">
        Apply, monitor, and manage scholarships in one centralized digital platform designed specifically for Computer Science students of TCC.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
        <button onclick="openAuthModal()" class="bg-white text-[#218358] px-6 md:px-8 py-3 rounded-lg font-semibold shadow hover:bg-[#c4e8d1] transition text-center">
          Get Started
        </button>
        <a href="#features" class="border border-white px-6 md:px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#218358] transition text-center">
          Learn More
        </a>
      </div>
    </div>

    <!-- RIGHT ANIMATED DESIGN -->
    <div class="relative flex justify-center items-center h-[300px] md:h-[500px] mt-8 md:mt-0">
      <div class="absolute w-48 h-48 md:w-72 md:h-72 bg-gradient-to-br from-[#30a46c] to-[#8eceaa] rounded-full blur-2xl opacity-70 animate-blob"></div>
      <div class="absolute w-40 h-40 md:w-60 md:h-60 bg-[#c4e8d1] rounded-full blur-xl opacity-60 animate-blob animation-delay-2000"></div>
      <div class="absolute w-20 h-20 md:w-32 md:h-32 border-[6px] md:border-[10px] border-[#218358]/40 rounded-full animate-float-slow"></div>
      <div class="absolute w-56 h-56 md:w-80 md:h-80 border-[8px] md:border-[14px] border-[#30a46c]/20 rounded-full animate-rotate-slow"></div>
      <div class="absolute grid grid-cols-3 md:grid-cols-4 gap-3 md:gap-4">
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#218358] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#30a46c] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#8eceaa] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#c4e8d1] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#30a46c] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#218358] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#c4e8d1] rounded-full"></div>
        <div class="w-2 h-2 md:w-3 md:h-3 bg-[#8eceaa] rounded-full"></div>
      </div>
    </div>

  </div>
</section>
        <div class="w-3 h-3 bg-[#8eceaa] rounded-full"></div>
      </div>
    </div>

  </div>
</section>

<!-- FEATURES -->
<section id="features" class="py-16 md:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-[#218358] mb-12 md:mb-16">Platform Features</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
      <div class="bg-[#fbfefc] p-6 md:p-8 rounded-xl border border-[#c4e8d1] hover:shadow-lg transition transform hover:-translate-y-2">
        <div class="w-12 h-12 bg-[#218358]/10 rounded-lg flex items-center justify-center mb-4 mx-auto">
          <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-lg mb-2 text-[#218358]">Easy Scholarship Application</h3>
        <p class="text-gray-600 text-sm md:text-base">Students can apply online without paperwork, anytime, anywhere.</p>
      </div>
      <div class="bg-[#fbfefc] p-6 md:p-8 rounded-xl border border-[#c4e8d1] hover:shadow-lg transition transform hover:-translate-y-2">
        <div class="w-12 h-12 bg-[#30a46c]/10 rounded-lg flex items-center justify-center mb-4 mx-auto">
          <svg class="w-6 h-6 text-[#30a46c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-lg mb-2 text-[#218358]">Real-time Tracking</h3>
        <p class="text-gray-600 text-sm md:text-base">Monitor your application and approval status in real-time.</p>
      </div>
      <div class="bg-[#fbfefc] p-6 md:p-8 rounded-xl border border-[#c4e8d1] hover:shadow-lg transition transform hover:-translate-y-2">
        <div class="w-12 h-12 bg-[#8eceaa]/10 rounded-lg flex items-center justify-center mb-4 mx-auto">
          <svg class="w-6 h-6 text-[#8eceaa]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-lg mb-2 text-[#218358]">Admin Monitoring</h3>
        <p class="text-gray-600 text-sm md:text-base">Admins manage and track all scholar records efficiently.</p>
      </div>
    </div>
  </div>
</section>


<!-- AUTH MODAL -->
<div id="authModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-[60] backdrop-blur-sm p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl overflow-hidden transform transition-all max-h-[85vh] md:max-h-[90vh]">
    <div class="flex flex-col md:flex-row md:min-h-[600px]">
      <!-- Left side - Logo and Design -->
      <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-[#218358] via-[#30a46c] to-[#8eceaa] relative overflow-hidden min-h-[600px]">
        <!-- Logo at top -->
        <div class="absolute top-8 left-8 z-10">
          <img src="{{ asset('images/tcc-logo.png') }}" alt="TCC Logo" class="w-16 h-16 drop-shadow-lg" />
        </div>

        <!-- Main content centered -->
        <div class="flex-1 flex items-center justify-center p-8">
          <div class="text-center text-white relative">
            <h1 class="text-4xl font-bold mb-6 drop-shadow-lg">Welcome to ScholarNet</h1>
            <p class="text-xl opacity-90 mb-8 drop-shadow-md">Your gateway to academic excellence</p>

            <!-- Interactive elements -->
            <div class="space-y-4">
              <div class="flex justify-center space-x-2">
                <div class="w-3 h-3 bg-white/80 rounded-full animate-pulse"></div>
                <div class="w-3 h-3 bg-white/60 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                <div class="w-3 h-3 bg-white/40 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
              </div>
              <p class="text-sm opacity-75">Secure • Fast • Reliable</p>
            </div>

            <!-- Floating interactive dots -->
            <div class="absolute -top-4 -left-4 w-2 h-2 bg-[#c4e8d1] rounded-full animate-bounce" style="animation-delay: 0.5s"></div>
            <div class="absolute top-8 -right-6 w-3 h-3 bg-[#30a46c] rounded-full animate-bounce" style="animation-delay: 1s"></div>
            <div class="absolute -bottom-2 left-1/4 w-2 h-2 bg-[#8eceaa] rounded-full animate-bounce" style="animation-delay: 1.5s"></div>
            <div class="absolute bottom-4 right-1/3 w-2 h-2 bg-[#c4e8d1] rounded-full animate-bounce" style="animation-delay: 2s"></div>
          </div>
        </div>

        <!-- Additional decorative elements -->
        <div class="absolute bottom-8 right-8 opacity-20">
          <div class="w-32 h-32 border-4 border-white rounded-full animate-spin-slow"></div>
        </div>
        <div class="absolute top-1/2 left-8 opacity-10">
          <div class="w-24 h-24 border-2 border-white rounded-full animate-float"></div>
        </div>
        <div class="absolute top-16 right-16 opacity-15">
          <div class="w-16 h-16 border-3 border-[#c4e8d1] rounded-full animate-pulse"></div>
        </div>
      </div>

      <!-- Right side - Forms -->
      <div class="w-full md:w-1/2 flex flex-col p-4 sm:p-6 md:p-8 overflow-y-auto md:max-h-[600px]">
        <!-- Close button -->
        <div class="flex justify-end mb-3 md:mb-4">
          <button onclick="closeAuthModal()" class="text-gray-400 hover:text-gray-600 transition p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Mobile logo and header -->
        <div class="md:hidden text-center mb-4">
          <img src="{{ asset('images/tcc-logo.png') }}" alt="TCC Logo" class="w-12 h-12 mx-auto mb-2 drop-shadow-lg" />
          <h2 class="text-lg font-bold text-[#218358] mb-1">TCC ScholarNet</h2>
          <p class="text-xs text-gray-600">Secure Login Portal</p>
          <div class="flex justify-center space-x-1 mt-2">
            <div class="w-1.5 h-1.5 bg-[#218358] rounded-full animate-pulse"></div>
            <div class="w-1.5 h-1.5 bg-[#30a46c] rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
            <div class="w-1.5 h-1.5 bg-[#8eceaa] rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
          </div>
        </div>

        <!-- Header with Logo and Design -->
        <div class="text-center mb-4 md:mb-6 relative hidden md:block">
          <!-- Desktop Logo -->
          <div class="mb-3">
            <img src="{{ asset('images/tcc-logo.png') }}" alt="TCC Logo" class="w-14 h-14 mx-auto drop-shadow-lg" />
          </div>

          <!-- Welcome Text -->
          <h2 class="text-xl md:text-2xl font-bold text-[#218358] mb-1">Welcome to TCC ScholarNet</h2>
          <p class="text-xs md:text-sm text-gray-600">Your gateway to academic excellence</p>

          <!-- Decorative Elements -->
          <div class="flex justify-center space-x-2 mt-2">
            <div class="w-2 h-2 bg-[#218358] rounded-full animate-pulse"></div>
            <div class="w-2 h-2 bg-[#30a46c] rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
            <div class="w-2 h-2 bg-[#8eceaa] rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
          </div>

          <!-- Floating decorative elements -->
          <div class="absolute -top-2 -right-2 w-3 h-3 bg-[#c4e8d1] rounded-full opacity-60 animate-bounce" style="animation-delay: 0.5s"></div>
          <div class="absolute top-4 -left-4 w-2 h-2 bg-[#30a46c] rounded-full opacity-50 animate-bounce" style="animation-delay: 1s"></div>
        </div>

        <!-- Form Content -->
        <div class="flex-1 scrollbar-thin scrollbar-thumb-[#218358] scrollbar-track-gray-100">
          <!-- Login Form -->
          <div id="loginForm" class="form-content form-open space-y-3 md:space-y-4">
            <form action="{{ route('login') }}" method="POST" class="space-y-3 md:space-y-4">
              @csrf
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required autofocus>
                @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                  <input type="password" id="login-password" name="password" placeholder="••••••••" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                  <button type="button" onclick="togglePasswordVisibility('login-password')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11 10.07 7.5 12 7.5s3.5 1.57 3.5 3.5z"/></svg>
                  </button>
                </div>
                @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="remember_me" name="remember" class="rounded border-gray-300 text-[#218358] focus:ring-[#218358]">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
              </div>
              <button type="submit" class="w-full bg-[#218358] hover:bg-[#1a6845] text-white font-semibold py-2.5 md:py-3 text-sm md:text-base rounded-lg transition">
                Login
              </button>
              @if (Route::has('password.request'))
              <p class="text-center text-sm text-gray-600 mt-4">
                <a href="{{ route('password.request') }}" class="text-[#218358] font-semibold hover:text-[#30a46c]">Forgot your password?</a>
              </p>
              @endif
              <p class="text-center text-sm text-gray-600 mt-4">
                Don't have an account? <a href="#" onclick="showRegisterForm()" class="text-[#218358] font-semibold hover:text-[#30a46c]">Register here</a>
              </p>
            </form>
          </div>

          <!-- Register Form -->
          <div id="registerForm" class="form-content space-y-3 md:space-y-4">
            <form action="{{ route('register') }}" method="POST" class="space-y-3 md:space-y-4">
              @csrf
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">First Name *</label>
                <input type="text" name="first_name" placeholder="John" value="{{ old('first_name') }}" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                @error('first_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Middle Initial (A or N/A)</label>
                <input type="text" name="middle_name" placeholder="A" value="{{ old('middle_name') }}" maxlength="3" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent">
                @error('middle_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-600 mt-0.5">Enter a single initial with optional dot (A or A.) or N/A if none.</p>
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Last Name *</label>
                <input type="text" name="last_name" placeholder="Doe" value="{{ old('last_name') }}" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                @error('last_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Student Number *</label>
                <input type="text" name="student_number" placeholder="2023-000123" value="{{ old('student_number') }}" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required oninput="validateStudentNumber(this)">
                @error('student_number')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-600 mt-0.5">Format: YYYY-XXXXXX (Year must be 2026 or earlier)</p>
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Course *</label>
                <select name="course" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                  <option value="">Select your course</option>
                  <option value="College of Business and Accountancy" {{ old('course') == 'College of Business and Accountancy' ? 'selected' : '' }}>College of Business and Accountancy</option>
                  <option value="College of Computer Studies" {{ old('course') == 'College of Computer Studies' ? 'selected' : '' }}>College of Computer Studies</option>
                  <option value="College of Criminology" {{ old('course') == 'College of Criminology' ? 'selected' : '' }}>College of Criminology</option>
                  <option value="College of Education and Liberal Arts" {{ old('course') == 'College of Education and Liberal Arts' ? 'selected' : '' }}>College of Education and Liberal Arts</option>
                  <option value="College of Hospitality Management" {{ old('course') == 'College of Hospitality Management' ? 'selected' : '' }}>College of Hospitality Management</option>
                  <option value="College of Nursing" {{ old('course') == 'College of Nursing' ? 'selected' : '' }}>College of Nursing</option>
                  <option value="College of Physical Therapy" {{ old('course') == 'College of Physical Therapy' ? 'selected' : '' }}>College of Physical Therapy</option>
                </select>
                @error('course')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Year Level *</label>
                <select name="year_level" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                  <option value="">Select your year level</option>
                  <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                  <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                  <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                  <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                </select>
                @error('year_level')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Email Address *</label>
                <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Password *</label>
                <div class="relative">
                  <input type="password" id="register-password" name="password" placeholder="••••••••" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                  <button type="button" onclick="togglePasswordVisibility('register-password')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11 10.07 7.5 12 7.5s3.5 1.57 3.5 3.5z"/></svg>
                  </button>
                </div>
                <p class="text-xs text-gray-600 mt-0.5">Min 8 chars: uppercase, lowercase, number, symbol</p>
                @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1.5">Confirm Password *</label>
                <div class="relative">
                  <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="••••••••" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                  <button type="button" onclick="togglePasswordVisibility('register-password-confirm')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11 10.07 7.5 12 7.5s3.5 1.57 3.5 3.5z"/></svg>
                  </button>
                </div>
                @error('password_confirmation')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              <button type="submit" class="w-full bg-[#30a46c] hover:bg-[#218358] text-white font-semibold py-2.5 md:py-3 text-sm md:text-base rounded-lg transition">
                Create Account
              </button>
              <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account? <a href="#" onclick="showLoginForm()" class="text-[#218358] font-semibold hover:text-[#30a46c]">Login here</a>
              </p>
            </form>
          </div>
        </div>

        <!-- Bottom Decorative Elements -->
        <div class="mt-6 pt-4 border-t border-gray-200">
          <div class="text-center relative">
            <!-- Security badges -->
            <div class="flex justify-center space-x-4 text-xs text-gray-500 mb-3">
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-[#218358]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Secure
              </span>
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-[#30a46c]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Fast
              </span>
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-[#8eceaa]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Reliable
              </span>
            </div>

            <!-- Floating decorative elements -->
            <div class="absolute bottom-0 left-4 w-2 h-2 bg-[#c4e8d1] rounded-full opacity-40 animate-pulse" style="animation-delay: 0.8s"></div>
            <div class="absolute bottom-2 right-6 w-3 h-3 bg-[#30a46c] rounded-full opacity-30 animate-pulse" style="animation-delay: 1.2s"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="bg-[#218358] text-white py-12">
  <div class="max-w-7xl mx-auto px-4 md:px-8 text-center space-y-2">
    <h3 class="font-semibold text-xl">TCC ScholarNet</h3>
    <p class="text-white/80">Centralized Scholarship Platform</p>
    <p class="text-sm text-white/70">© {{ date('Y') }} All rights reserved</p>
  </div>
</footer>

<script>
// Modal functionality
function openAuthModal() {
    const modal = document.getElementById('authModal');

    // Show modal but keep it invisible initially
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    modal.style.opacity = '0';
    modal.style.transform = 'translateY(-50px) scale(0.95)';
    modal.style.transition = 'opacity 0.4s ease-out, transform 0.4s ease-out';

    document.body.style.overflow = 'hidden';

    // Force reflow to ensure styles are applied
    modal.offsetHeight;

    // Animate modal in
    setTimeout(() => {
        modal.style.opacity = '1';
        modal.style.transform = 'translateY(0) scale(1)';
    }, 10);

    // Set up forms after modal animation starts
    setTimeout(() => {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        loginForm.classList.add('form-open');
        registerForm.classList.remove('form-open');
    }, 200);
}

function closeAuthModal() {
    const modal = document.getElementById('authModal');

    // Animate modal out
    modal.style.opacity = '0';
    modal.style.transform = 'translateY(-30px) scale(0.95)';

    // After animation completes, hide modal
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.style.opacity = '';
        modal.style.transform = '';
        modal.style.transition = '';
        document.body.style.overflow = 'auto';
    }, 400);
}

function showRegisterForm() {
    console.log('showRegisterForm called'); // Debug log

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    loginForm.classList.remove('form-open');
    setTimeout(() => {
        registerForm.classList.add('form-open');
    }, 150);
}

function showLoginForm() {
    console.log('showLoginForm called'); // Debug log

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    registerForm.classList.remove('form-open');
    setTimeout(() => {
        loginForm.classList.add('form-open');
    }, 150);
}

function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}

function validateStudentNumber(input) {
    const value = input.value;
    const yearPattern = /^(\d{4})-/;
    const match = value.match(yearPattern);

    if (match) {
        const year = parseInt(match[1]);
        if (year > 2026) {
            input.setCustomValidity('Student number year cannot exceed 2026');
            input.reportValidity();
            return;
        }
    }

    input.setCustomValidity('');
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('authModal');
    if (modal && e.target === modal) {
        closeAuthModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('authModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeAuthModal();
        }
    }
});

// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');

            // Change hamburger icon to X when menu is open
            const icon = mobileMenuButton.querySelector('svg path');
            if (mobileMenu.classList.contains('hidden')) {
                // Hamburger icon
                mobileMenuButton.innerHTML = `
                    <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
            } else {
                // X icon
                mobileMenuButton.innerHTML = `
                    <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                // Reset to hamburger icon
                mobileMenuButton.innerHTML = `
                    <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
            }
        });

        // Close mobile menu when clicking on a navigation link (but not auth modal buttons)
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                // Reset to hamburger icon
                mobileMenuButton.innerHTML = `
                    <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
            });
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

</body>
</html>
