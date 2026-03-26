<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TCC ScholarNet</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
body { font-family: 'Poppins', sans-serif; }

/* Blob animations */
.animate-blob {
  animation: blob 8s infinite;
}
@keyframes blob {
  0%,100% { transform: translate(0px,0px) scale(1); }
  33% { transform: translate(30px,-20px) scale(1.1); }
  66% { transform: translate(-20px,20px) scale(0.9); }
}
.animate-float-slow {
  animation: float-slow 6s ease-in-out infinite;
}
@keyframes float-slow {
  0%,100% { transform: translateY(0px); }
  50% { transform: translateY(-15px); }
}
.animate-rotate-slow {
  animation: rotate-slow 20s linear infinite;
}
@keyframes rotate-slow {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body class="bg-[#fbfefc] text-[#202020]">

<!-- NAVBAR -->
<header class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-[#c4e8d1]">
  <div class="max-w-7xl mx-auto px-8 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/tcc-logo.png') }}" alt="TCC Logo" class="w-10 h-10 object-contain">
      <span class="text-2xl font-bold text-[#218358]">TCC ScholarNet</span>
    </div>
    <nav class="hidden md:flex items-center gap-8 font-medium">
      <a href="#" class="hover:text-[#30a46c] transition">Home</a>
      <a href="#features" class="hover:text-[#30a46c] transition">Features</a>
      <a href="#about" class="hover:text-[#30a46c] transition">About</a>
      <a href="#contact" class="hover:text-[#30a46c] transition">Contact</a>
      <a href="{{ route('login') }}" class="px-5 py-2 text-[#218358] font-semibold hover:text-[#30a46c]">Login</a>
      <a href="{{ route('register') }}" class="bg-[#30a46c] text-white px-6 py-2 rounded-lg shadow hover:bg-[#218358] transition">Register</a>
    </nav>
  </div>
</header>

<!-- HERO SECTION -->
<section class="min-h-screen flex items-center pt-28 relative overflow-hidden">
  <!-- background gradient -->
  <div class="absolute inset-0 bg-gradient-to-br from-[#218358] via-[#30a46c] to-[#8eceaa]"></div>

  <!-- decorative shapes -->
  <div class="absolute right-[-120px] top-20 w-[500px] h-[500px] border-[60px] border-white/10 rounded-full"></div>
  <div class="absolute right-[80px] bottom-[-120px] w-[400px] h-[400px] border-[40px] border-white/10 rounded-full"></div>

  <div class="relative max-w-7xl mx-auto px-8 grid md:grid-cols-2 gap-12 items-center z-10">

    <!-- LEFT CONTENT -->
    <div class="text-white">
      <p class="text-[#c4e8d1] font-medium mb-3">OFFICIAL SCHOLARSHIP PLATFORM</p>
      <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
        TCC ScholarNet<br>
        Centralized Scholarship System
      </h1>
      <p class="text-lg text-white/90 mb-8 leading-relaxed">
        Apply, monitor, and manage scholarships in one centralized digital platform designed specifically for Computer Science students of TCC.
      </p>
      <div class="flex gap-4 flex-wrap">
        <a href="{{ route('register') }}" class="bg-white text-[#218358] px-8 py-3 rounded-lg font-semibold shadow hover:bg-[#c4e8d1] transition">
          Get Started
        </a>
        <a href="#features" class="border border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#218358] transition">
          Learn More
        </a>
      </div>
    </div>

    <!-- RIGHT ANIMATED DESIGN -->
    <div class="relative flex justify-center items-center h-[500px]">
      <div class="absolute w-72 h-72 bg-gradient-to-br from-[#30a46c] to-[#8eceaa] rounded-full blur-2xl opacity-70 animate-blob"></div>
      <div class="absolute w-60 h-60 bg-[#c4e8d1] rounded-full blur-xl opacity-60 animate-blob animation-delay-2000"></div>
      <div class="absolute w-32 h-32 border-[10px] border-[#218358]/40 rounded-full animate-float-slow"></div>
      <div class="absolute w-80 h-80 border-[14px] border-[#30a46c]/20 rounded-full animate-rotate-slow"></div>
      <div class="absolute grid grid-cols-4 gap-4">
        <div class="w-3 h-3 bg-[#218358] rounded-full"></div>
        <div class="w-3 h-3 bg-[#30a46c] rounded-full"></div>
        <div class="w-3 h-3 bg-[#8eceaa] rounded-full"></div>
        <div class="w-3 h-3 bg-[#c4e8d1] rounded-full"></div>
        <div class="w-3 h-3 bg-[#30a46c] rounded-full"></div>
        <div class="w-3 h-3 bg-[#218358] rounded-full"></div>
        <div class="w-3 h-3 bg-[#c4e8d1] rounded-full"></div>
        <div class="w-3 h-3 bg-[#8eceaa] rounded-full"></div>
      </div>
    </div>

  </div>
</section>

<!-- FEATURES -->
<section id="features" class="py-24 bg-white">
  <div class="max-w-7xl mx-auto px-8 text-center">
    <h2 class="text-4xl font-bold text-[#218358] mb-16">Platform Features</h2>
    <div class="grid md:grid-cols-3 gap-10">
      <div class="bg-[#fbfefc] p-8 rounded-xl border border-[#c4e8d1] hover:shadow-lg transition transform hover:-translate-y-2">
        <h3 class="font-semibold text-lg mb-2 text-[#218358]">Easy Scholarship Application</h3>
        <p class="text-gray-600">Students can apply online without paperwork, anytime, anywhere.</p>
      </div>
      <div class="bg-[#fbfefc] p-8 rounded-xl border border-[#c4e8d1] hover:shadow-lg transition transform hover:-translate-y-2">
        <h3 class="font-semibold text-lg mb-2 text-[#218358]">Real-time Tracking</h3>
        <p class="text-gray-600">Monitor your application and approval status in real-time.</p>
      </div>
      <div class="bg-[#fbfefc] p-8 rounded-xl border border-[#c4e8d1] hover:shadow-lg transition transform hover:-translate-y-2">
        <h3 class="font-semibold text-lg mb-2 text-[#218358]">Admin Monitoring</h3>
        <p class="text-gray-600">Admins manage and track all scholar records efficiently.</p>
      </div>
    </div>
  </div>
</section>


<!-- FOOTER -->
<footer class="bg-[#218358] text-white py-12">
  <div class="max-w-7xl mx-auto px-8 text-center space-y-2">
    <h3 class="font-semibold text-xl">TCC ScholarNet</h3>
    <p class="text-white/80">Centralized Scholarship Platform</p>
    <p class="text-sm text-white/70">© {{ date('Y') }} All rights reserved</p>
    <div class="flex justify-center gap-6 mt-4">
      <a href="#features" class="hover:text-[#c4e8d1] transition">Features</a>
      <a href="#about" class="hover:text-[#c4e8d1] transition">About</a>
      <a href="#contact" class="hover:text-[#c4e8d1] transition">Contact</a>
    </div>
  </div>
</footer>

</body>
</html>
