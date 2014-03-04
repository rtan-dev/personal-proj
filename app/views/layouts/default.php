<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Wyvern Hunter</title>

    <!--<link href="/bootstrap/css/bootstrap.css" rel="stylesheet">-->
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="/css/new-style.css" rel="stylesheet" type="text/css">
    <link href="/css/anim.css" rel="stylesheet" type="text/css">
    <style>
      body {
        padding-top: 60px;
      }
    </style>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner nav-color">
          <?php if (isset($_SESSION['username'])) : ?>
        <h1 class="header">Wyvern Hunter</h1>
          <?php else : ?>
          <h1 class="header-login">Wyvern Hunter</h1>
          <?php endif ?>
        <div id="nav" class="container">
            <ul>
                <?php if (isset($_SESSION['username'])) : ?>
                <li>
                    <a id="charNav" class="link-button" href="<?php eh(url('character/character_main')) ?>">Character</a>

                </li>
                <li>
                    <a id="equipNav" class="link-button" href="<?php eh(url('equip/equipment')) ?>">Equipment</a>
                </li>
                <li>
                    <a id="craftNav" class="link-button" href="<?php eh(url('craft/crafting')) ?>">Crafting</a>
                </li>
                <li>
                    <a id="shopNav" class="link-button" href="<?php eh(url('shop/shop')) ?>">Shop</a>
                </li>
                <li>
                    <a id="huntNav" class="link-button" href="<?php eh(url('monster/hunting_grounds')) ?>">Hunt</a>
                </li>
                <li>
                    <a id="rankNav" class="link-button" href="<?php eh(url('rank/rankings')) ?>">Rankings</a>
                </li>
                <li>
                    <span class="align-right" style="color: silver">
                        Hello, <b><?php eh($_SESSION['username']) ?></b>
                        <a class="link-button" href="<?php eh(url('user/logout')) ?>">Logout</a>
                    </span>
                </li>
                <?php endif ?>
            </ul>
        </div>
      </div>
    </div>


    <div class="container align-right">
        <?php if (isset($_SESSION['username'])) : ?>
        <?php endif ?>
    </div>
    <div class="container">
        <?php echo $_content_ ?>
    </div>
    <script>
    console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
    </script>
  </body>
</html>
