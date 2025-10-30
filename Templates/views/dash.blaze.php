<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
    @Auth::check();
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

        <!-- Content Area -->
        <main class="flex-grow p-6 overflow-y-auto">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold mb-2">Users</h3>
              <p class="text-3xl font-bold text-accent">1,245</p>
              <p class="text-sm text-gray-400 mt-2">Active this month</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold mb-2">Revenue</h3>
              <p class="text-3xl font-bold text-accent">$23,890</p>
              <p class="text-sm text-gray-400 mt-2">This quarter</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold mb-2">Tasks</h3>
              <p class="text-3xl font-bold text-accent">87%</p>
              <p class="text-sm text-gray-400 mt-2">Completed</p>
            </div>
          </div>

          <!-- Table Section -->
          <div class="mt-10">
            <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
            <div class="overflow-x-auto">
              <table class="min-w-full bg-gray-900 rounded-lg">
                <thead>
                  <tr class="text-left text-gray-400 border-b border-gray-700">
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Action</th>
                    <th class="px-4 py-2">Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="px-4 py-2">Jane Doe</td>
                    <td class="px-4 py-2">Logged in</td>
                    <td class="px-4 py-2">Oct 24, 2025</td>
                  </tr>
                  <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="px-4 py-2">John Smith</td>
                    <td class="px-4 py-2">Updated profile</td>
                    <td class="px-4 py-2">Oct 23, 2025</td>
                  </tr>
                  <tr class="hover:bg-gray-800">
                    <td class="px-4 py-2">Alice Lee</td>
                    <td class="px-4 py-2">Completed task</td>
                    <td class="px-4 py-2">Oct 22, 2025</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>

        <!-- Footer
        <footer class="bg-gray-800 text-gray-400 text-center py-4">
          <p>&copy; 2025 CopilotStyle. All rights reserved.</p>
        </footer>
      </div>
    </div>
  </body>
</html> -->
<?=(@template('components/feet'))?>
