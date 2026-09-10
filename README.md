# Material Typecho Theme

一个基于 Bootstrap 3 和 Material Design 风格的 Typecho 主题，原作者 [Hanson](https://github.com/Hanson/typecho_material_theme)，并针对本地静态资源、CDN 镜像、响应式布局和常用插件进行了优化。

![主题预览](./screenshot.png)

## 主要功能

- Material Design 风格界面；
- Bootstrap 3 响应式设计；
- 移动端导航折叠和分类下拉菜单；
- 侧栏搜索、微主页和常用面板；
- 文章目录自动生成；
- 代码高亮；
- 全站使用原生的图片懒加载；
- 返回顶部；
- 首页标语和 Hitokoto 一言；
- 备案号和统计代码等配置；
- RSS、登录入口和文章分类导航。

## 安装与启用

将主题目录复制到：

```text
usr/themes/Material/
```

然后在 Typecho 后台进入“控制台 → 外观”，启用 **Material** 主题。

## 主题配置

启用主题后，可以在主题设置中配置以下项目：

| 配置项 | 作用 |
| --- | --- |
| 首页图片标语文字 | 首页顶部主标题，留空时不显示主标题文字 |
| 首页图片副标语 | 首页顶部副标题；填写后优先显示自定义内容，不填写则展示一言 |
| 首页背景图片 | 填写图片 URL 后覆盖首页顶部背景图片；留空使用主题内置图片 |
| 标题栏和书签栏 Icon | 设置站点图标 |
| CDN 根地址 | 为主题静态资源启用 CDN，留空使用本地资源 |
| 备案号 | 显示页脚 ICP 备案信息 |
| 公安备案号 | 显示页脚公安备案信息，留空则不显示 |
| QQ 头像密钥 | 填写经授权获取的密钥后启用 QQ 头像；QQ 邮箱通过 AES 加密传输到服务器，解密后返回对应 QQ 头像，不会泄露邮箱信息。密钥暂不对外开放，留空则关闭 |
| 微主页 | 默认关闭；开启后可配置头像/纪念图标及底部入口 |
| 微主页头像地址、昵称、简介 | 头像留空使用默认头像；昵称或简介留空则不显示对应内容 |
| 微主页头像/纪念图标链接 | 头像和纪念图标共用此链接，留空不显示纪念图标 |
| 微主页个人主页、微博、邮箱、GitHub 链接 | 配置后显示对应入口，留空不显示 |
| 站点统计 | 输出自定义统计代码 |
| 显示登录入口 | 在侧栏“其他”面板显示登录、后台和注销入口 |
| 页脚显示加载耗时 | 在页脚显示页面加载耗时 |
| 关闭一言 | 关闭首页的 Hitokoto 一言显示 |

图片和链接类配置会在保存设置时进行协议校验：普通地址仅允许 HTTP/HTTPS，邮箱链接另外允许 `mailto:` 和 `tel:`；格式无效时保存会提示错误。前台仍保留安全兜底，历史无效配置会被忽略或回退到默认资源。

### 首页标语与一言

首页顶部的显示优先级如下：

1. 配置了副标语时，显示副标语；
2. 未配置副标语且没有关闭一言时，加载 `v1.hitokoto.cn`；
3. 关闭一言后，首页不再加载一言内容。

首页背景图默认使用：

```text
img/billboard.jpg
```

也可以在主题设置中填写“首页背景图片”，主题会直接使用该图片 URL 覆盖首页顶部背景；留空时继续使用上述本地图片。

## 推荐搭配插件

以下插件提供了针对 Material 主题的专属适配版本，建议与本主题搭配使用：

| 插件 | 仓库 | 适配内容 |
| --- | --- | --- |
| Smilies | [noisky/typecho-smilies](https://github.com/noisky/typecho-smilies) | 评论表情面板、表情图片和 Material 风格样式 |
| Links | [noisky/Links_for_Material_Theme](https://github.com/noisky/Links_for_Material_Theme) | Material 风格友情链接卡片和 `MATERIAL_SHOW` 输出模式 |
| Geetest | [noisky/typecho-plugin-geetest](https://github.com/noisky/typecho-plugin-geetest) | 评论表单极验验证码和主题评论模板适配 |

这些插件不是主题内置组件，需要单独安装和启用。插件资源、配置项和升级方式以各自仓库说明为准。

## 插件集成

### Smilies 表情插件

评论模板会在 Smilies 插件启用且类存在时输出表情面板：

```php
<?php if (\Typecho\Plugin::exists('Smilies') && class_exists('Smilies_Plugin')): ?>
    <?php Smilies_Plugin::output(); ?>
<?php endif; ?>
```

建议配合 Material 主题的专属适配版本使用；

表情图片的 CDN 配置由 Smilies 插件自身负责，主题 CDN 不会改写插件资源。

### Geetest 验证码插件

评论模板仅在 Geetest 插件已启用且类存在时调用验证码渲染方法：

```php
<?php if (\Typecho\Plugin::exists('Geetest') && class_exists('Geetest_Plugin')): ?>
    <?php Geetest_Plugin::commentCaptchaRender(); ?>
<?php endif; ?>
```

如果站点使用 Geetest，请安装并启用对应插件，并完成验证码 ID、私钥和页面选项配置。未安装或未启用 Geetest 时，主题会跳过验证码调用，不会因该插件缺失导致评论页报错。

## 静态资源与 CDN

### 运行时入口

页面直接加载以下资源：

```text
css/bootstrap.min.css
css/material.min.css
css/customs.min.css
css/customs-blue.min.css

js/jquery-2.2.4.min.js
js/bootstrap.min.js
js/merge.min.js
js/MyCustom.min.js
```

本主题面向现代浏览器设计，当前版本不再包含 IE8 及更早版本的专用兼容脚本。

### 合并资源

`merge.min.js` 已包含部分原本独立的功能模块，包括：

- Material 交互脚本；
- Ripples 水波纹；
- HeadIndex 文章目录；
- Highlight.js 代码高亮；
- 文本自动间距、打字特效和其他主题交互模块。

`MyCustom.min.js` 包含返回顶部、文章目录初始化和其他主题交互代码。图片使用浏览器原生的 `loading="lazy"` 懒加载，不再依赖 LazySizes；图片加载完成或失败后，脚本会追加 `material-lazy-loaded` 状态类，配合 CSS 移除占位背景。

Geetest 客户端脚本由 Geetest 插件按配置按需加载，Material 主题不重复打包或加载 Geetest SDK。

不要在模板中重复加载已经合并进上述文件的 `material.min.js`、`ripples.min.js`、`jquery.headindex.js` 或 `jquery.scrollUp.min.js`。

### 图片懒加载

主题模板中的图片直接使用 `loading="lazy"` 和 `decoding="async"`。文章正文、摘要和评论内容中的图片通过 Typecho 的 `contentEx`、`excerptEx` 过滤器补充这些属性；文章详情和独立页面模板在最终输出正文时还会再次调用 `materialAddLazyLoading()`，兼容 Typecho 提前缓存 `$this->content` 的情况。图片会保留真实的 `src`，不会在页脚进行整页缓冲或正则替换。

`customs.css` 会在图片尚未完成加载时为 `img[loading="lazy"]` 设置 `loading.svg` 背景。`MyCustom.js` 会监听图片的 `load` 和 `error` 事件，并处理脚本执行前已经从缓存加载完成的图片；完成后追加 `material-lazy-loaded`，由对应 CSS 规则清除背景色和背景图。因此透明 PNG（例如 Smilies 表情）加载完成后也不会继续透出 loading 图标。

首屏关键图片不建议使用懒加载。CSS `background-image` 背景图不支持 `loading` 属性，仍按 CSS 规则加载。

### CDN 配置

在主题设置中填写 **CDN 根地址** 后，主题会将自身的静态资源切换到该地址；留空时使用本地主题目录。

例如：

```text
https://cdn.example.com/typecho-material
```

CDN 必须保持以下目录结构：

```text
typecho-material/
├─ css/
├─ js/
├─ img/
└─ fonts/
```

例如：

```text
https://cdn.example.com/typecho-material/css/customs.min.css
https://cdn.example.com/typecho-material/js/MyCustom.min.js
https://cdn.example.com/typecho-material/fonts/fontawesome-webfont.woff2
```

生产环境建议使用 HTTPS。主题只对 CDN 根地址进行格式校验：必须是带域名的 HTTP/HTTPS 地址，不能携带查询字符串或片段；空地址或无效地址会回退到本地资源。主题会自动去除末尾斜杠并拼接资源路径，但不会检测 CDN 是否可访问或文件是否存在。

主题 CDN 只负责 `usr/themes/Material` 下的资源，不会自动改写插件资源。修改 CSS、JavaScript、字体或图片后，应同步更新 CDN 文件；对于需要主题自动追加缓存版本的资源，应在 `functions.php` 的 `materialAssetVersionMap()` 版本清单中新增或更新对应路径的版本号，避免浏览器或 CDN 继续使用旧缓存。

### DNS 预解析

主题只根据当前页面实际可能使用的资源动态输出 DNS 预解析：有效 CDN 根地址、首页实际启用的一言接口，以及启用 QQ 头像且当前页面允许评论时的头像 API。统计服务和 Geetest 的域名不由主题写死或猜测，分别由统计代码和 Geetest 插件自行管理。

## 主题架构

### PHP 模板

| 文件 | 职责 |
| --- | --- |
| `header.php` | 页面头部、导航和 CSS 资源入口 |
| `footer.php` | 页脚、统计代码和 JavaScript 入口 |
| `index.php` | 首页、顶部标语、一言和文章列表 |
| `archive.php` | 分类、标签、搜索等归档页面 |
| `page.php` | 独立页面 |
| `post.php` | 文章详情和文章目录 |
| `copyright.php` | 文章版权声明公共模板 |
| `sidebar.php` | 搜索、微主页和侧栏面板 |
| `comments.php` | 评论列表、评论表单和插件接口 |
| `functions.php` | 主题配置、资源 URL 和 CDN 逻辑 |

### 前端资源关系

- Bootstrap 负责导航折叠和分类下拉菜单；
- Material 脚本负责 Material Design 表单、按钮和水波纹交互；
- `merge.min.js` 负责合并的第三方功能模块；
- `MyCustom.min.js` 负责主题自定义行为；
- 运行时使用 `.min.css` 和 `.min.js` 文件，未压缩文件主要用于维护和重新构建。

## 维护与二次开发

主题运行时优先使用压缩文件：

```text
*.min.css
*.min.js
```

修改源 CSS/JavaScript 后，需要重新生成对应的压缩文件；只修改未压缩源文件而不更新 `.min` 文件，不会改变线上页面。

资源 URL 的缓存版本由 `functions.php` 中的 `materialAssetVersionMap()` 统一维护。

修改需要自动追加缓存版本的资源后，请在版本清单中新增或更新对应路径的版本号； 主题会通过 `materialAssetUrl()` 自动将版本号附加到资源 URL，无需再逐个修改模板中的查询参数。

## 版本发布记录

当前主题没有独立的版本 Tag，以下记录按照仓库实际维护日期整理。正式发布时可以据此创建版本 Tag。

### 2026-09-11 v3.0.2

- 修复文章详情和独立页面正文图片因 Typecho 提前缓存内容而未添加懒加载属性的问题；
- 在详情模板最终输出正文时补充 `loading="lazy"` 和 `decoding="async"` 属性处理，确保正文图片与首页行为一致。

### 2026-09-10 v3.0.1

- 修复懒加载图片完成后仍显示 `loading.svg` 背景的问题；
- 新增 `material-lazy-loaded` 完成状态类，兼容缓存命中、加载成功和加载失败场景；
- 新增 `tools/minify-js.js` 和 `minify-js` npm 脚本，用于安全压缩单个 JavaScript 文件；
- 同步更新主题自定义 JavaScript 和 CSS 的压缩资源。

### 2026-09-08 v3.0.0

- 移除页脚对整页 HTML 的输出缓冲和图片正则替换；
- 改用浏览器原生 `loading="lazy"` 和 `decoding="async"` 图片懒加载；
- 通过 Typecho `contentEx` 和 `excerptEx` 过滤器处理文章、摘要和评论内容中的图片；
- 移除主题对 LazySizes 和 `data-src` 的依赖。
- 根据实际功能 URL 动态生成 DNS 预解析，移除无实际依赖的固定第三方域名。
- 移除 IE8 及更早版本专用的 `html5shiv.js`、`respond.js` 和 `X-UA-Compatible` 配置。
- 新增 `materialAssetUrl()` 资源 URL 生成机制，默认使用本地资源，也支持通过主题配置切换到 CDN；
- 将头部、页脚、侧栏中的主题静态资源统一接入本地/CDN 资源路由；
- 将 CDN 的 DNS 预解析扩展到所有页面，并保留首页专属外部服务的预解析；
- 整理并删除未使用的 CSS、JavaScript、图片和字体资源；
- 统一 Bootstrap 3.3.7 的 CSS、JavaScript 和 Glyphicons 字体资源；
- 将 Bootstrap 样式文件统一为 `bootstrap.min.css`；
- 补齐 Bootstrap 字体文件和主题合并资源所需的 Source Map；
- 更新主题静态资源路径、缓存版本和本地图片/字体引用，减少对旧外部 CDN 的依赖；
- 修复 Material 主题评论表情插件的输出兼容性；
- 更新评论模板中的插件调用命名空间；
- 移除页脚中的旧又拍云资源引用并整理页脚显示；
- 更新主题 README、资源说明和推荐插件说明。

### 2026-07-26

- 更新主题静态资源链接和资源版本号；
- 清理模板中的旧 CDN 引用和注释代码；
- 优化导航栏样式；
- 更新 `customs.min.css`。

### 2025-12-31

- 合并前端功能脚本，统一 Material、Ripples、文章目录、代码高亮、图片懒加载等运行时资源。

## 已知限制

- Hitokoto 一言依赖外部 `v1.hitokoto.cn`；
- 评论头像依赖外部头像接口；
- 使用 Geetest 验证码时，需要正确安装、启用并配置对应插件；
- CDN 不可用时不会逐资源自动回退到本地；
- 插件资源不由主题 CDN 逻辑统一管理；
- 插件自行生成的图片不由主题的原生懒加载过滤器统一处理；
- 主题中的部分旧版源文件仅用于维护或构建，不会在运行时直接加载。

## 目录说明

```text
Material/
├─ css/          Bootstrap、Material 和主题样式
├─ fonts/        Glyphicons、FontAwesome 和 Roboto 字体
├─ img/          首页背景、头像和图标
├─ js/           jQuery、Bootstrap、合并脚本和主题自定义脚本
├─ header.php    页面头部、导航和资源入口
├─ footer.php    页脚、统计代码和脚本入口
├─ sidebar.php   侧栏、搜索、微主页和辅助面板
├─ post.php      文章详情和文章目录
├─ copyright.php 文章版权声明公共模板
├─ comments.php  评论列表、评论表单和插件接口
└─ functions.php 主题配置和静态资源 URL 生成
```

## 致谢

本主题的上游项目是 Hanson 的 [typecho_material_theme](https://github.com/Hanson/typecho_material_theme)。

相关资源和原作者信息请以各自仓库的许可与说明为准。
