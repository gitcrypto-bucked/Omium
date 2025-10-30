<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
	?>


   <?=(@template('components/head'))?>
  <body class="bg-primary text-white font-sans">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
      
      <?=(@template('components/asside'))?>

   

      <!-- Main Content -->
      <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
       
        <?=(@template('components/nav'))?>
        <!-- Hero Section -->
        <section class="flex-grow flex items-center justify-center text-center px-4">
          <div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">
              Your AI Companion for Everything
            </h1>
            <p class="text-lg text-gray-300 mb-8">
              Explore ideas, get things done, and stay inspired with a sleek, intuitive interface.
            </p>
            <a href="#"
              class="inline-block px-6 py-3 bg-accent text-white font-semibold rounded hover:bg-blue-600 transition">
              Get Started
            </a>
          </div>
        </section>

         <section class="py-20 bg-primary">
      <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-12">Why Choose CopilotStyle?</h2>
        <div class="grid md:grid-cols-3 gap-10 text-gray-300">
          <div>
            <div class="text-4xl mb-4">⚡</div>
            <h3 class="text-xl font-semibold mb-2">Fast & Responsive</h3>
            <p>Optimized with Tailwind for blazing-fast performance on all devices.</p>
          </div>
          <div>
            <div class="text-4xl mb-4">🧠</div>
            <h3 class="text-xl font-semibold mb-2">Smart Design</h3>
            <p>Inspired by Copilot’s clean, modern interface to keep you focused and productive.</p>
          </div>
          <div>
            <div class="text-4xl mb-4">🌙</div>
            <h3 class="text-xl font-semibold mb-2">Dark Mode Ready</h3>
            <p>Elegant dark theme for a sleek, eye-friendly experience day or night.</p>
          </div>
        </div>
      </div>
    </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-400 text-center py-4">
          <p>&copy; 2025 CopilotStyle. All rights reserved.</p>
        </footer>
      </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.getElementById('sidebar');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });
    </script>
  </body>
</html>
