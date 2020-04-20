<?php
include 'common.php';
include 'header.php';
include 'menu.php';
include 'FreshUi.php';
$stat = Typecho_Widget::widget('Widget_Stat');
?>


<div class="page-header">
  <h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	  <i class="mdi mdi-account"></i>
	</span>博客数据</h3>
</div>
<div class="row">
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-danger card-img-holder text-white">
	  <div class="card-body">
		<img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">文章总计<i class="mdi mdi-library-books mdi-24px float-right"></i></h4>
		<h2 class="mb-5"><a href="<?php $options->adminUrl('manage-posts.php'); ?>"><?php _e('<em>%s</em> 篇文章',$stat->myPublishedPostsNum); ?></a></h2>
		<a class="mt-3 mb-0 text-sm">
                                            <a href="<?php $options->adminUrl('write-post.php'); ?>" class="text-white"><i class="mdi mdi-pen"></i><?php _e('撰写新文章'); ?></a>
                                            <a href="<?php $options->adminUrl('write-page.php'); ?>" class="text-white"><i class="mdi mdi-pen"></i><?php _e('创建新页面'); ?></a>
                                        </a>
                                   
                              
	  </div>
	</div>
  </div>
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-info card-img-holder text-white">
	  <div class="card-body">
		<img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">评论总计<i class="mdi mdi-comment-processing-outline mdi-24px float-right"></i></h4>
		<h2 class="mb-5"><a href="<?php $options->adminUrl('manage-comments.php'); ?>"><?php _e('<em>%s</em> 条评论',$stat->myPublishedCommentsNum); ?></a></h2>
		<h6 class="card-text">
			<?php if($user->pass('contributor', true)): ?>
			<?php if($user->pass('editor', true) && 'on' == $request->get('__typecho_all_comments') && $stat->waitingCommentsNum > 0): ?>
				<a style="color:#ffffff;" href="<?php $options->adminUrl('manage-comments.php?status=waiting'); ?>"><?php _e('待审核的评论'); ?></a>
				<span class="balloon"><?php $stat->waitingCommentsNum(); ?></span>
				
			<?php elseif($stat->myWaitingCommentsNum > 0): ?>
				<a style="color:#ffffff;" href="<?php $options->adminUrl('manage-comments.php?status=waiting'); ?>"><?php _e('待审核评论'); ?></a>
				<span class="balloon"><?php $stat->myWaitingCommentsNum(); ?></span>

			<?php endif; ?>
			<?php if($user->pass('editor', true) && 'on' == $request->get('__typecho_all_comments') && $stat->spamCommentsNum > 0): ?>
				<a style="color:#ffffff;" href="<?php $options->adminUrl('manage-comments.php?status=spam'); ?>"><?php _e('垃圾评论'); ?></a>
				<span class="balloon"><?php $stat->spamCommentsNum(); ?></span>
			<?php elseif($stat->mySpamCommentsNum > 0): ?>
				<a style="color:#ffffff;" href="<?php $options->adminUrl('manage-comments.php?status=spam'); ?>"><?php _e('垃圾评论'); ?></a>
				<span class="balloon"><?php $stat->mySpamCommentsNum(); ?></span>
				
			<?php endif; ?>
			<?php endif; ?>
		</h6><a href="<?php $options->adminUrl('manage-comments.php'); ?>" class="text-white mr-2"><i class="mdi mdi-basket"></i><?php _e('全部评论'); ?></a>
                                            <a data-toggle="modal" data-target="#modal-default" href="<?php $options->adminUrl('options-reading.php'); ?>" class="text-white mr-2 "><i class="mdi mdi-book"></i><?php _e('阅读设置'); ?></a>			
	  </div>
	</div>
  </div>
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-success card-img-holder text-white">
	  <div class="card-body">
		<img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">分类总计<i class="mdi mdi-buffer mdi-24px float-right"></i></h4>
		<h2 class="mb-5"><a href="<?php $options->adminUrl('manage-categories.php'); ?>"><?php _e('<em>%s</em> 个分类',$stat->categoriesNum); ?></a></h2>
	 <a href="<?php $options->adminUrl('themes.php'); ?>" class="text-white"><i class="mdi mdi-palette"></i><?php _e('更换外观'); ?></a>
                                            <a href="<?php $options->adminUrl('plugins.php'); ?>" class="text-white"><i class="mdi mdi-settings"></i><?php _e('插件管理'); ?></a>
	  </div>
	</div>
  </div>
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-warning card-img-holder text-white">
	  <div class="card-body">
		<img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">后台主题<i class="mdi mdi-buffer mdi-24px float-right"></i></h4>
		<h2 class="mb-5">Fresh久别重逢</h3>
	<a href="https://www.mlwly.cn/archives/fresh.html" class="text-white mr-2"><i class="mdi mdi-information"></i><?php _e('主题帮助'); ?></a>
                                            <a href="<?php $options->adminUrl('plugins.php'); ?>" class="text-white"><i class="mdi mdi-settings"></i><?php _e('插件管理'); ?></a>
	  </div>
	</div>
  </div>
   <div class="col-md-4">
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">更新内容</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
          <div class="modal-body">
          <?php Typecho_Widget::widget('Widget_Options_Reading')->form()->render(); ?>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">关闭</button>
            </div>
            
        </div>
    </div>
</div>
  
   </div>
</div>
<div class="page-header" style="padding-top:30px;">
  <h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	  <i class="mdi mdi-information-outline"></i>
	</span>相关信息</h3>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title"><?php _e('最近发布的文章'); ?></h4>
		<div class="table-responsive">
		  <table class="table">
			<thead>
			  <tr>
				<th> 日期 </th>
				<th> 文章标题 </th>
			  </tr>
			</thead>
			<tbody>
			<?php Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=10')->to($posts); ?>
			<?php if($posts->have()): ?>
			<?php while($posts->next()): ?>
			  <tr>
				<td><span class="text-warning"><?php $posts->date('m.d'); ?></span></td>
				<td><a href="<?php $posts->permalink(); ?>" class="title"><?php $posts->title(); ?></a></td>
			  </tr>
			  <?php endwhile; ?>
			  <?php else: ?>
				<td><em><?php _e('暂时没有文章'); ?></em></td>
			  <?php endif; ?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title"><?php _e('最近收到的回复'); ?></h4>
		<div class="table-responsive">
		  <table class="table">
			<thead>
			  <tr>
				<th> 日期 </th>
				<th> 昵称及评论内容 </th>
			  </tr>
			</thead>
			<tbody>
			<?php Typecho_Widget::widget('Widget_Comments_Recent', 'pageSize=10')->to($comments); ?>
			<?php if($comments->have()): ?>
			<?php while($comments->next()): ?>
			  <tr>
				<td><span class="text-warning"><?php $comments->date('m.d'); ?></span></td>
				<td> <div class="d-flex w-100 align-items-center">
                                                   <img src="
                                                    <?php 
                                                    $email =$comments->mail; 
                                                    if($email){
                                                        if(strpos($email,'@qq.com') !==false){$email=str_replace('@qq.com','',$email);
                                                        echo '//q1.qlogo.cn/g?b=qq&nk='.$email.'&s=100';
                                                        }else{
                                                            $email= md5($email);
                                                            echo Typecho_Common::gravatarUrl($comments->mail, 220, 'X', 'mm', $request->isSecure());}
                                                    }else{
                                                                echo '//cdn.v2ex.com/gravatar/null?';} ?>
                                                    " alt="Image placeholder" class="avatar rounded-circle" style="width:35px;height:35px;margin-right:5px;">
                                                    
                                                   <?php $comments->author(true); ?>
                                                </div><a href="<?php $comments->permalink(); ?>" class="title"></a><br />
                            <?php $comments->excerpt(35, '...'); ?></td>
			  </tr>
			  <?php endwhile; ?>
			  <?php else: ?>
				<td><em><?php _e('暂时没有回复'); ?></em></td>
			  <?php endif; ?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>