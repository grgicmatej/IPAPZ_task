
    <div class="large-3 cell header hide-for-small-only" >
        <div class="headlineDate">
            <?=date("l")." ". date("d.m.Y");?>
        </div>
    </div>
    <div class="large-6 cell header hide-for-small-only">
        <div class="headline">
            TASK
        </div>
    </div>
    <div class="large-3 cell header">
        <div class="headlineLogin">
            <?php if(!Session::getInstance()->isLoggedIn()): ?>
                <a href="<?php echo App::config("url")."admin/login" ?>">
                    <p class="headlineDate">Login</p>
                </a>
            <?php else: ?>
                <a href="<?php echo App::config("url")?>admin/logout">
                    <p class="headlineDate">Logout <?php echo Session::getInstance()->getUser()->name ?></p>
                </a>
            <?php endif; ?>
        </div>
    </div>
