<?php
/**
 * Material Typecho Theme
 * 主题功能设置文件
 * functions.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    $slogan = new Typecho_Widget_Helper_Form_Element_Text('slogan', NULL, NULL, _t('首页图片标语文字'), _t('在这里填入一段文字，作为首页图片中的主要文字，留空则不显示'));
    $form->addInput($slogan);
    $leanSlogan = new Typecho_Widget_Helper_Form_Element_Text('leanSlogan', NULL, NULL, _t('首页图片副标语'), _t('在这里填入一段文字，作为首页图片中的附加文字，留空则显示一言'));
    $form->addInput($leanSlogan);
    $billboardImage = new Typecho_Widget_Helper_Form_Element_Text(
        'billboardImage',
        NULL,
        NULL,
        _t('首页背景图片'),
        _t('填写图片 URL 后覆盖首页顶部背景图片，留空则使用主题内置的 img/billboard.jpg')
    );
    $form->addInput($billboardImage->addRule('materialValidateImageUrl', _t('请填写合法的 HTTP/HTTPS 图片地址')));
    $siteIcon = new Typecho_Widget_Helper_Form_Element_Text('siteIcon', NULL, NULL, _t('标题栏和书签栏Icon'), _t('在这里填入一个图片URL地址, 作为标题栏和书签栏Icon, 默认不显示'));
    $form->addInput($siteIcon->addRule('materialValidateImageUrl', _t('请填写合法的 HTTP/HTTPS 图片地址')));

    $cdnBase = new Typecho_Widget_Helper_Form_Element_Text(
        'materialCdnBase',
        NULL,
        NULL,
        _t('CDN 根地址'),
        _t('填写后使用 CDN，留空则使用本地资源；例如：https://cdn.example.com/typecho-material')
    );
    $form->addInput($cdnBase->addRule('materialValidateCdnUrl', _t('请填写合法的 HTTP/HTTPS CDN 根地址，且不能包含查询字符串或片段')));

    $miibeian = new Typecho_Widget_Helper_Form_Element_Text('miibeian', NULL, NULL, _t('备案号'), _t('在这里填入备案号，不显示则留空'));
    $form->addInput($miibeian);
    $policeBeian = new Typecho_Widget_Helper_Form_Element_Text('policebeian', NULL, NULL, _t('公安备案号'), _t('在这里填入公安备案展示内容，不显示则留空，例如：豫公网安备41019702******号'));
    $form->addInput($policeBeian);
    $qqAvatarKey = new Typecho_Widget_Helper_Form_Element_Text(
        'qqAvatarKey',
        NULL,
        NULL,
        _t('QQ 头像密钥'),
        _t('填写经授权获取的 QQ 头像密钥后启用；QQ 邮箱通过 AES 加密传输到服务器，解密后返回对应 QQ 头像，不会泄露邮箱信息。密钥暂不对外开放，留空则关闭。')
    );
    $form->addInput($qqAvatarKey);

    $microHome = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'microHome',
        array('enable' => _t('显示微主页')),
        array(),
        _t('微主页'),
        _t('默认关闭。开启后，可通过下方入口配置显示微主页中的链接图标。')
    );
    $form->addInput($microHome->multiMode());

    $microProfile = array(
        'microAvatar' => array('微主页-头像Url', '留空使用主题默认头像 img/author.png，可自行替换'),
        'microName' => array('微主页-昵称', '留空则不显示昵称'),
        'microIntro' => array('微主页-简介', '留空则不显示简介')
    );
    foreach ($microProfile as $name => $config) {
        $input = new Typecho_Widget_Helper_Form_Element_Text($name, NULL, NULL, _t($config[0]), _t($config[1]));
        if ($name === 'microAvatar') {
            $input->addRule('materialValidateImageUrl', _t('请填写合法的 HTTP/HTTPS 图片地址'));
        }
        $form->addInput($input);
    }

    $microLinks = array(
        'microProfileUrl' => array('微主页-头像链接', '头像和纪念图标共用此链接，留空则不显示链接和纪念图标'),
        'microHomeUrl' => array('微主页-个人主页链接', '简介和底部主页图标的跳转地址，留空则不显示对应入口'),
        'microWeiboUrl' => array('微主页-微博链接', '底部微博图标的跳转地址，留空则不显示图标'),
        'microEmailUrl' => array('微主页-邮箱链接', '底部邮箱图标的跳转地址，留空则不显示图标'),
        'microGithubUrl' => array('微主页-GitHub链接', '底部GitHub图标的跳转地址，留空则不显示图标')
    );
    foreach ($microLinks as $name => $config) {
        $input = new Typecho_Widget_Helper_Form_Element_Text($name, NULL, NULL, _t($config[0]), _t($config[1]));
        $rule = $name === 'microEmailUrl'
            ? 'materialValidateContactUrl'
            : 'materialValidateUrl';
        $message = $name === 'microEmailUrl'
            ? _t('请填写合法的 HTTP/HTTPS、mailto: 或 tel: 链接，例如：https://ffis.me 或 mailto:name@example.com')
            : _t('请填写合法的 HTTP/HTTPS 链接，例如：https://ffis.me');
        $form->addInput($input->addRule($rule, $message));
    }
	$statiStics = new Typecho_Widget_Helper_Form_Element_Textarea('statiStics', NULL, NULL, _t('站点统计'), _t('请填写可信统计代码，代码将原样输出'));
    $form->addInput($statiStics);
    $misc = new Typecho_Widget_Helper_Form_Element_Checkbox('misc', array(
        'ShowLogin' => _t('侧栏显示登录入口'),
        'ShowLoadTime' => _t('页脚显示加载耗时'),
		'Showyiyan' => _t('关闭一言')
        ),
    array('ShowLogin'), _t('杂项'));
    $form->addInput($misc->multiMode());
}

/**
 * 为单个图片标签补充原生懒加载属性。
 */
function materialLazyImageTag($matches) {
    $tag = $matches[0];
    $attributes = $tag;
    $append = '';

    if (!preg_match('/\sloading\s*=/i', $attributes)) {
        $append .= ' loading="lazy"';
    }

    if (!preg_match('/\sdecoding\s*=/i', $attributes)) {
        $append .= ' decoding="async"';
    }

    if ($append === '') {
        return $tag;
    }

    return preg_replace('/\s*\/?>$/', $append . '$0', $tag);
}

/**
 * 为文章、摘要和评论内容中的图片增加原生懒加载属性。
 */
function materialAddLazyLoading($content, $widget, $lastResult) {
    $content = $lastResult !== null ? $lastResult : $content;

    if (!is_string($content) || strpos($content, '<img') === false) {
        return $content;
    }

    if ($widget instanceof Widget_Abstract_Comments) {
        $options = Helper::options();
        $allowedTags = (string) $options->commentsHTMLTagAllowed;
        $updatedTags = preg_replace_callback(
            '/<img\b[^>]*>/i',
            'materialLazyImageTag',
            $allowedTags
        );

        if ($updatedTags !== null && $updatedTags !== $allowedTags) {
            $options->commentsHTMLTagAllowed = $updatedTags;
        }
    }

    return preg_replace_callback('/<img\b[^>]*>/i', 'materialLazyImageTag', $content);
}

/**
 * 注册 Typecho 内容过滤器，避免对整个页面进行 HTML 改写。
 */
function themeInit($archive) {
    static $registered = false;

    if ($registered) {
        return;
    }

    $registered = true;
    \Typecho\Plugin::factory('Widget_Abstract_Contents')->contentEx = 'materialAddLazyLoading';
    \Typecho\Plugin::factory('Widget_Abstract_Contents')->excerptEx = 'materialAddLazyLoading';
    \Typecho\Plugin::factory('Widget_Abstract_Comments')->contentEx = 'materialAddLazyLoading';
}

/**
 * Hitokoto 实际请求地址，DNS 预解析从该地址提取 origin。
 */
function materialHitokotoUrl() {
    return 'https://v1.hitokoto.cn/?encode=js&select=%23hitokoto';
}

/**
 * QQ 头像 API 实际请求地址，DNS 预解析从该地址提取 origin。
 */
function materialQqAvatarEndpoint() {
    return 'https://api.ffis.me/imgApi/avatar/qq';
}

/**
 * 从合法 HTTP/HTTPS URL 中提取 origin。
 */
function materialUrlOrigin($url) {
    $url = materialSafeUrl($url, array('http', 'https'), true, true);
    if ($url === '') {
        return '';
    }

    $parts = parse_url($url);
    $origin = strtolower($parts['scheme']) . '://' . $parts['host'];

    if (!empty($parts['port'])) {
        $origin .= ':' . $parts['port'];
    }

    return $origin;
}

/**
 * 根据当前页面和已启用功能收集 DNS 预解析 origin。
 */
function materialDnsPrefetchOrigins($archive) {
    $origins = array();
    $options = Helper::options();

    if (!is_object($options)) {
        return $origins;
    }

    $addOrigin = function ($url) use (&$origins) {
        $origin = materialUrlOrigin($url);
        if ($origin !== '') {
            $origins[$origin] = true;
        }
    };

    // 主题 CDN 用于当前页面的 CSS、JavaScript、字体或图片。
    $addOrigin(materialCdnBase());

    $isArchive = is_object($archive)
        && method_exists($archive, 'is');
    $misc = (array) $options->misc;
    $hitokotoEnabled = $isArchive
        && $archive->is('index')
        && empty($options->leanSlogan)
        && !in_array('Showyiyan', $misc, true);

    if ($hitokotoEnabled) {
        $addOrigin(materialHitokotoUrl());
    }

    $qqAvatarEnabled = rtrim(
        (string) $options->qqAvatarKey,
        "\r\n"
    ) !== '';

    if ($qqAvatarEnabled && $isArchive && $archive->is('single')
        && method_exists($archive, 'allow') && $archive->allow('comment')) {
        $addOrigin(materialQqAvatarEndpoint());
    }

    return array_keys($origins);
}

/**
 * 返回经过校验的用户配置 URL。
 *
 * 仅允许指定协议，HTTP/HTTPS 地址必须包含主机名；默认允许查询字符串
 * 和片段，以兼容普通链接。返回空字符串表示配置无效。
 */
function materialSafeUrl($value, $schemes = array('http', 'https'), $allowQuery = true, $allowFragment = true) {
    $url = trim((string) $value);

    if ($url === '' || preg_match('/[\x00-\x20\x7F"\'<>`(){}\\;]/', $url)) {
        return '';
    }

    $parts = parse_url($url);
    if (!$parts || empty($parts['scheme'])) {
        return '';
    }

    $scheme = strtolower($parts['scheme']);
    if (!in_array($scheme, $schemes, true)) {
        return '';
    }

    if (in_array($scheme, array('http', 'https'), true) && empty($parts['host'])) {
        return '';
    }

    if (isset($parts['user']) || isset($parts['pass'])) {
        return '';
    }

    if (!$allowQuery && array_key_exists('query', $parts)) {
        return '';
    }

    if (!$allowFragment && array_key_exists('fragment', $parts)) {
        return '';
    }

    return $url;
}

/**
 * 主题设置保存时使用的普通 URL 校验规则。
 */
function materialValidateUrl($value) {
    return materialSafeUrl($value, array('http', 'https'), true, true) !== '';
}

/**
 * 校验图片或图标地址。
 */
function materialValidateImageUrl($value) {
    return materialSafeUrl($value, array('http', 'https'), true, false) !== '';
}

/**
 * 校验邮箱或电话链接。
 */
function materialValidateContactUrl($value) {
    return materialSafeUrl($value, array('http', 'https', 'mailto', 'tel'), true, true) !== '';
}

/**
 * 校验 CDN 根地址。
 */
function materialValidateCdnUrl($value) {
    return materialSafeUrl($value, array('http', 'https'), false, false) !== '';
}

/**
 * 返回经过校验的 CDN 根地址。
 */
function materialCdnBase() {
    $base = materialSafeUrl(
        Helper::options()->materialCdnBase,
        array('http', 'https'),
        false,
        false
    );

    return $base ? rtrim($base, '/') : '';
}

/**
 * 判断当前是否启用 CDN 静态资源。
 */
function materialAssetUsesCdn() {
    return materialCdnBase() !== '';
}

/**
 * 获取静态资源 CDN 的 origin，用于 dns-prefetch。
 */
function materialAssetCdnOrigin() {
    $base = materialCdnBase();
    if (!$base) {
        return '';
    }

    $parts = parse_url($base);
    $origin = strtolower($parts['scheme']) . '://' . $parts['host'];
    if (!empty($parts['port'])) {
        $origin .= ':' . $parts['port'];
    }
    return $origin;
}

/**
 * 获取指定静态资源的版本号。
 */
function materialAssetVersion($path) {
    $path = ltrim($path, '/');
    $versions = materialAssetVersionMap();

    return isset($versions[$path]) ? $versions[$path] : NULL;
}

/**
 * 根据当前资源模式生成静态资源 URL。
 * CDN 镜像必须保持主题目录结构，例如 css/foo.css 对应 CDN 根地址下的 css/foo.css。
 * 第二个参数保留用于兼容旧调用；省略时自动从版本清单读取。
 */
function materialAssetUrl($path, $version = NULL) {
    $path = ltrim($path, '/');

    if ($version === NULL) {
        $version = materialAssetVersion($path);
    }

    if (materialAssetUsesCdn()) {
        $url = materialCdnBase() . '/' . $path;
    } else {
        // themeUrl() 是输出型方法，这里捕获其输出以便统一返回 URL。
        ob_start();
        Helper::options()->themeUrl($path);
        $url = ob_get_clean();
    }

    if ($version !== NULL && $version !== '') {
        $url .= (strpos($url, '?') === false ? '?' : '&')
            . 'v=' . rawurlencode($version);
    }

    return $url;
}

function timer_start() {
    global $timestart;
    $mtime = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
 
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime = explode( ' ', microtime() );
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display )
    echo $r;
    return $r;
}

/**
 * Material 静态资源版本清单。
 *
 * 版本号属于主题代码和部署信息，不作为主题后台配置保存。
 * 资源实际变更时，只需更新这里对应资源的版本号。
 */
function materialAssetVersionMap() {
    static $versions = array(
        // 第三方资源：保留现有缓存标识。
        'css/bootstrap.min.css' => '20200413',
        'css/material.min.css' => '2019123001',
        'js/jquery-2.2.4.min.js' => '2026090901',
        'js/bootstrap.min.js' => '2026090901',

        // 主题维护资源：文件变更时更新对应版本号。
        'css/customs.min.css' => '2026091222',
        'css/customs-blue.min.css' => '2026091215',
        'js/merge.min.js' => '2026091102',
        'js/custom.min.js' => '2026091219'
    );

    return $versions;
}
