<?php if(Session::getInstance()->isLoggedIn()): ?>
<div class="title-bar" data-responsive-toggle="example-animated-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle></button>
    <div class="title-bar-title">Menu</div>
</div>
<div class="top-bar" id="example-animated-menu" data-animate="hinge-in-from-top spin-out">
    <div class="top-bar-left" style="text-align: left;">
        <li class="dropdown menu" data-dropdown-menu>
            <?php if(Session::getInstance()->isLoggedIn()&&Session::getInstance()->getUser()->id==="1"): ?>
            <p class="adminMenu">Admin menu</p>
                <li><a href="<?php echo App::config("url")?>user/indexuser/"><i class="fi-list"></i><span>User list</span></li>
                <li><a href="<?php echo App::config("url")?>task/indextask/">Task list</a></li>
                <li><a href="<?php echo App::config("url")?>task/newtaskprepare/<?=Session::getInstance()->getUser()->id?>">Assign new task</a></li>
                <li><a href="<?php echo App::config("url")?>user/registration">New user registration</a></li>
            <?php endif; ?>

            <br><p class="adminMenu">User menu</p>
            <li><a href="<?php echo App::config("url")?>user/view/<?php echo Session::getInstance()->getUser()->id ?>">User profile</a></li>
            <li><a href="<?php echo App::config("url")?>task/newtaskprepare/<?php echo Session::getInstance()->getUser()->id ?>">Assign new task</a></li><br>
        </li>
    </div>
</div>

<?php endif; ?>