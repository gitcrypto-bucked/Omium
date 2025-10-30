<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
    @Auth::public();
	?>
<?=(@template('components/head'))?>
  <body class="bg-primary text-white font-sans">
    <div class="flex h-screen overflow-hidden">
      <?=(@template('components/asside'))?>

      <!-- Main Content -->
      <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
         <header class="bg-gray-800 p-4 flex justify-between items-center">
          <h2 class="text-xl font-bold">Blog</h2>
          <p class="float-end float-right"><?= Auth::logged()? sayHello(Auth::user()['name']):''?></p>
          <?php 
              if(!Auth::logged()) 
              {
                  echo '<a class="text-white hover:text-accent" href="'.url('login').'"><i class="fa-solid fa-right-to-bracket"></i> Login</a>';
              }
              else
              {
                  echo '<a class="text-white hover:text-accent" href="'.url('logout').'"><i class="fa-solid fa-door-open"></i> Logout</a>';
              }
          ?>
        </header>


        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-primary to-gray-900 py-12 text-center px-4">
          <h1 class="text-4xl font-extrabold mb-4">Latest News & Insights</h1>
          <p class="text-gray-300 text-lg max-w-2xl mx-auto">
            Explore the latest stories in tech, AI, and global affairs curated for curious minds.
          </p>
        </section>

        <!-- Articles Grid -->
        <main class="flex-grow px-6 py-10 overflow-y-auto">
          <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- Article Card -->
            <article class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition">
              <h3 class="text-xl font-semibold mb-2">AI Reshaping the Future</h3>
              <p class="text-gray-400 mb-4">
                Discover how artificial intelligence is transforming industries and everyday life.
              </p>
              <a href="#" class="text-accent hover:underline text-sm">Read more →</a>
            </article>

            <!-- Article Card -->
            <article class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition">
              <h3 class="text-xl font-semibold mb-2">Tech Giants & Innovation</h3>
              <p class="text-gray-400 mb-4">
                A look at how major companies are competing to lead the next wave of digital change.
              </p>
              <a href="#" class="text-accent hover:underline text-sm">Read more →</a>
            </article>

            <!-- Article Card -->
            <article class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition">
              <h3 class="text-xl font-semibold mb-2">Global Trends to Watch</h3>
              <p class="text-gray-400 mb-4">
                From climate tech to geopolitics, here are the key developments shaping our future.
              </p>
              <a href="#" class="text-accent hover:underline text-sm">Read more →</a>
            </article>
          </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 text-center py-4">
          <p>&copy; 2025 CopilotStyle News. All rights reserved.</p>
        </footer>
      </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.querySelector('aside');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });
    </script>
  </body>
</html>
