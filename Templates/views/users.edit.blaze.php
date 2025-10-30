<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
    use \Facades\Redirect;
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
        <!-- Edit Form -->
        <main class="flex-grow p-6 overflow-y-auto">
          <div class="max-w-3xl mx-auto bg-gray-900 rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold mb-6">Editar usuário</h1>
            <form class="space-y-6" method="post" autocomplete="off" action="<?=url('update/users')?>">
               <?php if(isset($_SESSION['error']) && !is_null($_SESSION['error'])): ?>
                    <div class="bg-red-500 text-white p-4 mb-2 rounded-md" id='error'>
                        <?php echo $_SESSION['error']; ?>
                        <?php $_SESSION['error'] = null ;?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['success']) && !is_null($_SESSION['success'])): ?>
                    <div class="bg-green-500 text-white p-4 mb-2 rounded-md" id='success'>
                        <?php echo $_SESSION['success']; ?>
                        <?php $_SESSION['success'] = null; ?>
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                <?=csrf_token();?>
              <div>
                <input type='hidden' name='id'  id='id' value="<?=$user['id']?>">
                <label class="block text-sm text-gray-400 mb-1">Nome</label>
                <input
                  name="name"
                  id="name"
                  type="text"
                  value="<?=$user['name']?>"
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>
              <div>
                <label class="block text-sm text-gray-400 mb-1">E-mail</label>
                <input
                  name="email"
                  id="email"
                  type="email"
                  value="<?=$user['email']?>"
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>
              <div>
                <label class="block text-sm text-gray-400 mb-1">Nível</label>
                <select id='nivel' name='nivel'
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                >
                  <option >Selecione</option>
                  <option value="admin" <?php  if(boolval($user['admin'])){ echo 'selected'; } ?>>admin</option>
                  <option value="user" <?php  if(!boolval($user['admin'])){ echo 'selected'; } ?>>usuário</option>
                </select>
              </div>
              <div>
                <label class="block text-sm text-gray-400 mb-1">Status</label>
                <select id='ativo' name='ativo'
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                >
                   <option>Selecione</option>
                  <option value="ativo" <?php  if(boolval($user['active'])){ echo 'selected'; } ?>>ativo</option>
                  <option value="inativo" <?php  if(!boolval($user['active'])){ echo 'selected'; } ?>>inativo</option>
                </select>
              </div>
              <div class="text-right">
               <button
                  type="button"
                  class="px-6 py-2 bg-accent text-white font-semibold rounded hover:bg-orange-600 transition"
                  onclick="window.location.href='<?=Redirect::url('admin');?>'"
                >
                  Voltar
                </button>
                <button
                  type="submit"
                  class="px-6 py-2 bg-accent text-white font-semibold rounded hover:bg-blue-600 transition"
                >
                  Salvar alterções
                </button>
             
              </div>
            </form>
          </div>
        </main>
         <?=(@template('components/feet'))?>
        <!-- Footer
        <footer class="bg-gray-900 text-gray-400 text-center py-4">
          <p>&copy; 2025 CopilotStyle. All rights reserved.</p>
        </footer>
      </div>
    </div>

    -- Sidebar Toggle Script --
    <script>
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.querySelector('aside');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });
    </script>
  </body>
</html> -->
