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
        <header class="bg-gray-800 p-4 flex justify-between items-center ">
          <h2 class="text-xl font-bold">Acesso Negado</h2>
           <p class="float-end float-right"><?php  Auth::logged() ? sayHello(Auth::user()['name']) : ''; ?></p>
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
           <button id="toggleSidebar" class="text-white focus:outline-none  lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            </button>
        </header>


        <!-- Message Section -->
        <main class="flex-grow flex items-center justify-center p-6">
          <div class="bg-gray-900 rounded-lg shadow-lg p-8 max-w-md w-full text-center">
            <h1 class="text-2xl font-bold mb-4 text-red-400">Você não tem permissão</h1>
            <p class="text-gray-400 mb-6">Entre em contato com seu administrador ou retorne para uma página segura.</p>
            <button
              onclick="window.history.back()"
              class="px-6 py-2 bg-accent text-white font-semibold rounded hover:bg-blue-600 transition"
            >
              ← Voltar
            </button>
          </div>
        </main>

     <?=(@template('components/feet'))?>
