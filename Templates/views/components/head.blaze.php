<?php
 use \Facades\Route;
?>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php
      if(Route::is('blog'))
      {
          echo '<title>Blog</title>';
      }
      if(Route::is('dash'))
      {
          echo '<title>Dashboard</title>';
      }
      if(Route::is('admin'))
      {
          echo '<title>Gerenciar usuários</title>';
      }
      if(Route::is('users'))
      {
          echo '<title>Editar usuário</title>';
      }
      unset($_SESSION['back']);
      $_SESSION['back'] = $_SERVER['HTTP_REFERER'];

  ?>
  <script src="https://cdn.tailwindcss.com"></script>
      <?=fontAwesome('7')?>
      <?=boostrapIcons()?>
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
