<div id="top-nav" class="navbar navbar-inverse navbar-static-top" style="background:#c4e3f3;color:white;border-color:white;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
            <?php foreach($menu_array as $menu) { echo '<a class="navbar-brand" href="#">'.$menu['perm_desc'].'<a>';}?>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#"><i class="fa fa-user-circle"></i> <?php echo strtoupper($_SESSION['user']['user_email']); ?> </a>
                    
                </li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
    </div>    
</div>
