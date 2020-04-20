<div class="container-scroller">
	<!-- 顶部导航 -->
	<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
		<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
			<a class="navbar-brand brand-logo" href="index.php"><img src="img/logo.svg" alt="logo"></a>
			<a class="navbar-brand brand-logo-mini" href="index.php"><img src="img/logo-mini.svg" alt="logo"></a>
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-stretch">
			<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
				<span class="mdi mdi-menu"></span>
			</button>
			<div class="search-field d-none d-md-block">
				<form class="d-flex align-items-center h-100" action="#">
					<div class="input-group">
						<div class="input-group-prepend bg-transparent">
							<i class="input-group-text border-0 mdi mdi-magnify"></i>
						</div>
						<input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
					</div>
				</form>
			</div>
			
			<ul class="navbar-nav navbar-nav-right">
			   <li class="nav-item nav-profile dropdown">

            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

              <div class="nav-profile-img">

                <?php echo '<img src="' . Typecho_Common::gravatarUrl($user->mail, 220, 'X', 'mm', $request->isSecure()) . '" alt="' . $user->screenName . '" />'; ?>

                <span class="availability-status online"></span>             

              </div>

              <div class="nav-profile-text">

               

              </div>

            </a>

            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">

              <a href="<?php $options->adminUrl('profile.php'); ?>" class="dropdown-item">
                <i class="mdi mdi-account mr-2 text-success"></i>
                <span>我的信息</span>
              </a>
              <a href="<?php $options->adminUrl('write-post.php'); ?>" class="dropdown-item">
                <i class="mdi mdi-pen mr-2 text-warning"></i>
                <span>新建文章</span>
              </a>

              <a href="<?php $options->adminUrl('manage-comments.php'); ?>" class="dropdown-item">
                <i class="mdi mdi-comment-processing-outline  mr-2 text-primary"></i>
                <span>评论管理</span>
              </a> <div class="dropdown-divider"></div>
              <div class="dropdown-divider"></div>
              <a href="<?php $options->logoutUrl(); ?>" class="dropdown-item">
                <i class="mdi mdi-logout mr-2 text-default"></i>
                <span>退出登录</span>
              </a>

            </div>

          </li>
				<li class="nav-item d-none d-lg-block full-screen-link">
					<a class="nav-link">
						<i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown"
					 aria-expanded="false">
						<i class="mdi mdi-bell-outline"></i>
						<span class="count-symbol bg-danger"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
						<h6 class="p-3 mb-0">官方最新日志</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item preview-item">
							<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
								<p class="text-gray ellipsis mb-0"> <section class="latest-link">

									<div id="typecho-message">
										<ul>
											<li><?php _e('读取中...'); ?></li>
										</ul>
									</div>  
									
					            </p>
							</div>
						</a>
					</div>
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
				<span class="mdi mdi-menu"></span>
			</button>
		</div>
	</nav>
	<!-- 主面板 -->
	<div class="container-fluid page-body-wrapper">
		<!-- 左侧栏导航 -->
		<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
				<li class="nav-item nav-profile">
					<a href="#" class="nav-link">
						<div class="nav-profile-image">
						<?php echo '<img src="' . Typecho_Common::gravatarUrl($user->mail, 220, 'X', 'mm', $request->isSecure()) . '" alt="' . $user->screenName . '" />'; ?>
							<span class="login-status online"></span>
						</div>
						<div class="nav-profile-text d-flex flex-column">
							<span class="font-weight-bold mb-2"><?php $user->screenName(); ?></span>
							<span class="text-secondary text-small">
							<?php
							if ($user->logged > 0) {
								$logged = new Typecho_Date($user->logged);
								_e('最后登录: %s', $logged->word());
							}
							?>
							</span>
						</div>
					</a>
				</li>
				
				<?php $menu->output(); ?>

				<li class="nav-item sidebar-actions">
					<span class="nav-link">
						<a href="<?php $options->siteUrl(); ?>" class="btn btn-block btn-lg btn-gradient-primary btn-rounded">进入前台</a>
						<a href="<?php $options->logoutUrl(); ?>" class="btn btn-block btn-lg btn-gradient-primary btn-rounded">退出登录</a>
						<div class="mt-4">
							<div class="border-bottom">
							</div>
							<ul class="gradient-bullet-list mt-4">
							<?php $version = Typecho_Cookie::get('__typecho_check_version'); ?>
								<li>当前版本：<?php _e('%s (%s)',$prefixVersion, $suffixVersion); ?><?php echo $version['current']; ?></li>
							<?php if ($version && $version['available']): ?>
								<li>官方版本：<a href="<?php echo $version['link']; ?>"><?php echo $version['latest']; ?></a></li>
							<?php endif; ?>	
							</ul>
						</div>
					</span>
				</li>
			</ul>
		</nav>
		<div class="main-panel">
			<div class="content-wrapper">