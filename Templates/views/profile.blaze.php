<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
    use \Facades\Storage;
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

      
           
        <!-- Profile Section -->
        <main class="flex-grow p-6 overflow-y-auto">
          <div class="max-w-4xl mx-auto bg-gray-900 rounded-lg shadow-md p-8">
            <div class="flex items-center space-x-6 mb-6">
              <img 
                id="avatarPrev"
                src="<?php  if(!is_null($user['avatar'])){ echo Storage::urlRead('avatar',$user['avatar']); } else {echo 'https://cdn.vectorstock.com/i/750p/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.avif'; }?> "
                alt="User Avatar"
                class="w-24 h-24 rounded-full border-4 border-accent"
              />
              <div>
                <h3 class="text-2xl font-bold"><?=$user['name']?></h3>
                <p class="text-gray-400"><?=$user['email']?></p>
              </div>
            </div>
            <form action="<?=url('profile')?>" method="POST">
             <?php if(isset($_SESSION['error']) && !is_null($_SESSION['error'])): ?>
                <div class="bg-red-500 text-white p-4 mb-2 rounded-md">
                    <?php echo $_SESSION['error']; ?>
                     <?php $_SESSION['error'] = null ;?>
                     <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['success']) && !is_null($_SESSION['success'])): ?>
                <div class="bg-green-500 text-white p-4 mb-2 rounded-md">
                    <?php echo $_SESSION['success']; ?>
                    <?php $_SESSION['success'] = null; ?>
                     <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            <?=csrf_token();?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <input readonly name="id" id="id" type="hidden" value="<?=$user['id']?>" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent">
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
                <label class="block text-sm text-gray-400 mb-1">Email</label>
                <input
                  readonly
                  name="email"
                  id="email"
                  type="email"
                  value="<?=$user['email']?>"
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>
              <div>
                <input type='hidden' id='old_password' name='old_password' value="<?=$user['password']?>">
                <label class="block text-sm text-gray-400 mb-1">Senha</label>
                <input
                  name="password"
                  id="password"
                  type="password"
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>
              <div>
                <label class="block text-sm text-gray-400 mb-1">Confirmação de senha</label>
                <input
                  name="confirm_password"
                  id="confirm_password"
                  type="password"
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>
            </div>

            <div class="mt-6 text-right">
              <button type="submit"
                class="px-6 py-2 bg-accent text-white font-semibold rounded hover:bg-blue-600 transition"
              >
                Salvar Alterações
              </button>
            </form>

            <hr class="my-6 border-gray-700">

            <form action="<?=url('user.avatar')?>" method="POST" enctype="multipart/form-data">
            <?=csrf_token();?>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <input readonly name="id" id="id" type="hidden" value="<?=$user['id']?>" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent">
                <label class="block text-sm text-gray-400 mb-1">Avatar</label>
                <input
                  name="avatar"
                  id="avatar"
                  type="file" 
                   accept="image/*"
                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>
            </div>
            <button type="submit"
                class="px-6 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600 transition"
              >
                Atualizar avatar
              </button>
            </form>
            </div>
          </div>
        </main>

        <!-- Footer -->
          <script>
            const fileInput = document.getElementById('avatar');
            const avatarPrev = document.getElementById('avatarPrev');

            fileInput.addEventListener('change', function() {
              if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                  avatarPrev.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
              }
            });
          </script>

          <?=(@template('components/feet'))?>

    <!-- Sidebar Toggle Script -->
    <!-- <script>
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.querySelector('aside');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });
    </script>
  </body>
</html> -->
