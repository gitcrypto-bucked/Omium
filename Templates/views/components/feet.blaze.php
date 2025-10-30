
        <!-- Footer -->
 <footer class="bg-gray-900 text-gray-400 text-center py-4">
              <p>&copy; <?= date('Y') ?> CopilotStyle. All rights reserved.</p>
        </footer>
      </div>
    </div>
      <script>
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.querySelector('aside');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });


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
      }, 6500);
    </script>
  </body>
</html>