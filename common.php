<?php
if (!defined('__DIR__')) {
    define('__DIR__', dirname(__FILE__));
}

define('__TYPECHO_ADMIN__', true);

// 只需改动 $admin_path 的 /krait/nabo/admin/为你的后台路径，即可，其他的不要改动。
//$admin_path_before 为config.inc.php中的路径，一般是默认。
$admin_path = "/Fresh/";
$admin_path_before = "/admin/";

//路径实现来源 https://krait.cn/major/2021.html
$config_path = 'config.inc.php';
$array_path = array_filter(explode("/", $admin_path));
foreach ($array_path as $value) {
    $config_path = str_replace("config", "../config", $config_path);
}
if (file_exists($config_path)) {
    $str = file_get_contents($config_path);
    $str = str_replace($admin_path_before, $admin_path, $str);
    foreach ($array_path as $value) {
        $str = str_replace("__FILE__", "dirname(__FILE__)", $str);
    }
    eval("?>" . $str);
}

/** 初始化组件 */
Typecho_Widget::widget('Widget_Init');

/** 注册一个初始化插件 */
Typecho_Plugin::factory('admin/common.php')->begin();

Typecho_Widget::widget('Widget_Options')->to($options);
Typecho_Widget::widget('Widget_User')->to($user);
Typecho_Widget::widget('Widget_Security')->to($security);
Typecho_Widget::widget('Widget_Menu')->to($menu);

/** 初始化上下文 */
$request = $options->request;
$response = $options->response;

/** 检测是否是第一次登录 */
$currentMenu = $menu->getCurrentMenu();
list($prefixVersion, $suffixVersion) = explode('/', $options->version);
$params = parse_url($currentMenu[2]);
$adminFile = basename($params['path']);

if (!$user->logged && !Typecho_Cookie::get('__typecho_first_run') && !empty($currentMenu)) {
    
    if ('welcome.php' != $adminFile) {
        $response->redirect(Typecho_Common::url('welcome.php', $options->adminUrl));
    } else {
        Typecho_Cookie::set('__typecho_first_run', 1);
    }
    
} else {

    /** 检测版本是否升级 */
    if ($user->pass('administrator', true) && !empty($currentMenu)) {
        $mustUpgrade = (!defined('Typecho_Common::VERSION') || version_compare(str_replace('/', '.', Typecho_Common::VERSION),
        str_replace('/', '.', $options->version), '>'));

        if ($mustUpgrade && 'upgrade.php' != $adminFile && 'backup.php' != $adminFile) {
            $response->redirect(Typecho_Common::url('upgrade.php', $options->adminUrl));
        } else if (!$mustUpgrade && 'upgrade.php' == $adminFile) {
            $response->redirect($options->adminUrl);
        } else if (!$mustUpgrade && 'welcome.php' == $adminFile && $user->logged) {
            $response->redirect($options->adminUrl);
        }
    }

}
