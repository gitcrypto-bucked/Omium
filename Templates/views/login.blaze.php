<!DOCTYPE html>
<html lang="en" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              primary: '#1e1e2f',
              accent: '#3b82f6',
            },
          },
        },
      };
    </script>
  </head>
  <body class="bg-primary text-white font-sans">
    <div class="min-h-screen flex items-center justify-center px-4">
      <div class="max-w-md w-full bg-gray-900 rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center mb-6">Sign in</h2>
        <form class="space-y-6" method="post" action="<?php echo url('dologin'); ?>" autocomplete="off">
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
            <?php if(isset($_SESSION['info']) && !is_null($_SESSION['info'])): ?>
                <div class="bg-yellow-500 text-white p-4 mb-2 rounded-md" id='info'>
                    <?php echo $_SESSION['info']; ?>
                    <?php $_SESSION['info'] = null; ?>
                    <?php unset($_SESSION['info']); ?>
                </div>
            <?php endif; ?>
            <?=csrf_token();?>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
            <input
              type="email"
              id="username"
              name="username"
              required
              class="mt-1 block w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
            />
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              required
              class="mt-1 block w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent"
            />
          </div>
          <div class="flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-300">
              <input type="checkbox" class="mr-2 rounded" />
              Remember me
            </label>
            <a href="#" class="text-sm text-accent hover:underline">Forgot password?</a>
          </div>
          <button
            type="submit"
            class="w-full py-2 px-4 bg-accent hover:bg-blue-600 text-white font-semibold rounded-md transition"
          >
            Sign In
          </button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-400 hidden">
          Don't have an account?
          <a href="#" class="text-accent hover:underline">Sign up</a>
        </p>
      </div>
    </div>
    <script type='text/javascript'>
          window.onload = setTimeout(() => {
          let success = document.getElementById('success');
          if(success!= undefined)
          {
              success.classList.add('hidden');
          }

          let error = document.getElementById('error');
          if(error!= undefined)
          {
              error.classList.add('hidden');
          }

          let info = document.getElementById('info');
          if(info!= undefined)
          {
              info.classList.add('hidden');
          }
      }, 6500);
    </script>
  </body>
</html>
