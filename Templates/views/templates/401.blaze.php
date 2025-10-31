<?php
    use \Facades\Route;
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
        <header class="bg-gray-800 p-4 flex justify-between items-center lg:hidden">
          <h2 class="text-xl font-bold">Error Page</h2>
          <button id="toggleSidebar" class="text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </header>

        <!-- Error Message -->
        <main class="flex-grow flex items-center justify-center p-6">
          <div class="bg-gray-900 rounded-lg shadow-lg p-8 max-w-md w-full text-center">
            <h1 class="text-4xl font-extrabold text-red-500 mb-4">401</h1>
            <h2 class="text-2xl font-bold mb-2">Access Denied</h2>
            <p class="text-gray-400 mb-6">You don’t have permission to view this page or it doesn’t exist.</p>
            <button
              onclick="window.history.back()"
              class="hidden px-6 py-2 bg-accent text-white font-semibold rounded hover:bg-blue-600 transition"
            >
              ← Back
            </button>
          </div>
        </main>
   <?=(@template('components/feet'))?>