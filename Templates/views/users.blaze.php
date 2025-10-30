<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
       @Auth::check();
	?>
<?=(@template('components/head'))?>

  <body class="bg-primary text-white font-sans">
    <div class="flex h-screen overflow-hidden">
    
         <?=(@template('components/asside'))?>

      <!-- Main Content -->
      <div class="flex-1 flex flex-col">
        <?=(@template('components/nav'))?>
        <!-- Top Bar -->
     

        <!-- User Table -->
        <main class="flex-grow p-6 overflow-y-auto">
          <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 "></h1>
            <div class="overflow-x-auto bg-gray-900 rounded-lg shadow-md">
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
              <table class="min-w-full text-left">
                <thead class="bg-gray-800 text-gray-400">
                  <tr>
                    <th class="px-6 py-3">Nome</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Nivel</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Ações</th>
                  </tr>
                </thead>
                <tbody class="text-white divide-y divide-gray-700">
                  <?php
                
                        for($i = 0; $i < sizeof($users); $i++)
                        {
                            echo '<tr class="">
                            <td class="px-6 py-4">'.$users[$i]['name'].'</td>
                            <td class="px-6 py-4">'.$users[$i]['email'].'</td>
                            <td class="px-6 py-4">'.($users[$i]['admin']?'admin':'usuario').'</td>
                            <td class="px-6 py-4 text-white-400">'.(boolval($users[$i]['active'])?'ativo':'inativo').'</td>';

                            if(Auth::user()['id']==$users[$i]['id'])
                            {
                              echo  '<td class="px-6 py-4 space-x-2 hidden">
                                  <a class="text-accent hover:underline text-sm"   href="'.url('users/edit/'.base64_encode($users[$i]['id'])).'">Edit</a>
                                  <a class="text-red-400 hover:underline text-sm" href="'.url('users/delete/'.base64_encode($users[$i]['id'])).'">Delete</a>
                                </td>
                                </tr>';
                            }
                            else
                            {
                               echo  '<td class="px-6 py-4 space-x-2">
                                  <a class="text-accent hover:underline text-sm"   href="'.url('users/edit/'.base64_encode($users[$i]['id'])).'">Edit</a>
                                  <a class="text-red-400 hover:underline text-sm" href="'.url('users/delete/'.base64_encode($users[$i]['id'])).'">Delete</a>
                                </td>
                                </tr>';
                            }
                        }
                  ?>
                  <!-- <tr class="hover:bg-gray-800">
                    <td class="px-6 py-4">Jane Doe</td>
                    <td class="px-6 py-4">jane@example.com</td>
                    <td class="px-6 py-4">Admin</td>
                    <td class="px-6 py-4 text-green-400">Active</td>
                    <td class="px-6 py-4 space-x-2">
                      <button class="text-accent hover:underline text-sm">Edit</button>
                      <button class="text-red-400 hover:underline text-sm">Delete</button>
                    </td>
                  </tr>
                  <tr class="hover:bg-gray-800">
                    <td class="px-6 py-4">John Smith</td>
                    <td class="px-6 py-4">john@example.com</td>
                    <td class="px-6 py-4">Editor</td>
                    <td class="px-6 py-4 text-yellow-400">Pending</td>
                    <td class="px-6 py-4 space-x-2">
                      <button class="text-accent hover:underline text-sm">Edit</button>
                      <button class="text-red-400 hover:underline text-sm">Delete</button>
                    </td>
                  </tr>
                  <tr class="hover:bg-gray-800">
                    <td class="px-6 py-4">Alice Lee</td>
                    <td class="px-6 py-4">alice@example.com</td>
                    <td class="px-6 py-4">Viewer</td>
                    <td class="px-6 py-4 text-green-400">Active</td>
                    <td class="px-6 py-4 space-x-2">
                      <button class="text-accent hover:underline text-sm">Edit</button>
                      <button class="text-red-400 hover:underline text-sm">Delete</button>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </main>
        
        <?=(@template('components/feet'))?>
        <!-- Footer
        <footer class="bg-gray-900 text-gray-400 text-center py-4">
          <p>&copy; 2025 CopilotStyle. All rights reserved.</p>
        </footer>
      </div>
    </div>

    <script>
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.querySelector('aside');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });
    </script>
  </body>
</html> -->
