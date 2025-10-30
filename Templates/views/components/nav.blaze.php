<?php
    use \Facades\Route;
    use \Core\Auth;
?>
<header class="bg-gray-800 p-4 flex justify-between items-center ">
    <?php 
        if(Route::is('dash'))
        {
            echo '<h2 class="text-xl font-bold">Dashboard</h2>';
        }
        if(Route::is('profile'))
        {
            echo '<h2 class="text-xl font-bold">Perfil</h2>';
        }
        if(Route::is('admin'))
        {
            echo '<h2 class="text-xl font-bold">Gerenciar usuários</h2>';
        }
        if(Route::is('users'))
        {
            echo '<h2 class="text-xl font-bold">Editar usuário</h2>';
        }
        if(Route::is(''))
        {
            echo '<h2 class="text-xl font-bold">CopilotStyle</h2>';
        }
    ?>
    <p class="float-end float-right lg:hidden"><?php  Auth::logged() ? sayHello(Auth::user()['name']) : ''; ?></p>
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
    <button id="toggleSidebar" class="text-white focus:outline-none lg:hidden">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M4 6h16M4 12h16M4 18h16" />
    </svg>
    </button>
</header>