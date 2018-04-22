<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

//Со страниц, где требуется авторизация NEED_AUTH - true редиректим на страницу авторизации

$bAuthorized = $GLOBALS['USER']->IsAuthorized();
$arGroups = $GLOBALS['USER']->GetUserGroupArray();
//$bActivatedUser = in_array(Itsfera\Integration\Students::ACTIVATED_DISCIPLINE_USERS_GROUP, $arGroups);

if (NEED_AUTH === true && ADMIN_SECTION !== true && !$bAuthorized && $APPLICATION->GetCurPage(false) !== AUTH_PAGE_PATH ){

    //var_dump($APPLICATION->GetCurPage());
    //var_dump(AUTH_PAGE_PATH);
    //echo 'redirect';
    LocalRedirect(AUTH_PAGE_PATH);
    die();
}
?><!DOCTYPE html>
<!-- saved from url=(0035)http://reapay.it-sfera.ru/index.php -->
<html lang="ru" class="bx-core bx-no-touch bx-no-retina bx-chrome"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1200px">
    <meta name="author" content="IT Sphere">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
    <link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon" />
    
    <? $APPLICATION->ShowHead();

	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/fonts/ptsans.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/styles.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/flaticon.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.qtip.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/fonts/flaticon.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/styles.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.min.3210.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/enjoyhint.css");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.qtip.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrapValidator.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/ru_RU.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/enjoyhint.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.3210.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/classes/helper.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/classes/form.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.easydropdown.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    ?>
</head>

<body role="document">
<? $APPLICATION->ShowPanel(); ?>
<div class="areaForLoader" id="areaForLoader">
    <div class="preloader">
        <img src="/images/preloader.gif" alt="preloader">
    </div>
</div>
<div class="top-black-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-2">
                <ul class="lang-selector">
                    <li class="active">Рус</li>
                    <li><a href="http://www.rea.ru/en/pages/default.aspx">Eng</a></li>
                    <li><a href="http://www.rea.ru/cn/default.aspx">中文</a></li>
                </ul>
            </div>
            <div class="col-xs-7">


                <? $APPLICATION->IncludeComponent("bitrix:menu",
                    "ul_menu",
                    array(
                            "UL_CLASS"=>"main-website-menu",
                        "ROOT_MENU_TYPE" => "top",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MENU_THEME" => "site",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                    ),
                    false); ?>

            </div>
            <div class="col-xs-3">
                <div class="top-search">

                    <input id="header-search" type="text" placeholder="Поиск по сайту" onkeydown="if (event.keyCode==13) return cabinetsearch(value);">

                    <button class="top-search-btn" onclick="">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="es-header-wrapper">
	<div class="es-header-left">
		<div class="es-headlogowrap">
			<a href="/"><img src="<?=SITE_TEMPLATE_PATH;?>/images/logo.jpg" class="img-responsive"></a>
		</div>

		<div class="es-logotextwrap">
			<h1>
				<span>Российский экономический</span> УНИВЕРСИТЕТ имени Г.В. Плеханова
			</h1>
		</div>
	</div>

    <?$APPLICATION->IncludeComponent(
        "sebekon:user.info",
        "",
        Array()
    );?>
</div>



<nav class="navbar navbar-default bluemenu">

    <?if ($GLOBALS['USER']->IsAuthorized() && false):?>
    <div class="container">
        <div class="blue-menu-wrapper">

            <? $APPLICATION->IncludeComponent("bitrix:menu",
                "ul_menu",
                array(
                    "UL_CLASS"=>"",
                    "ROOT_MENU_TYPE" => "main",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MENU_THEME" => "site",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                false); ?>
        </div>
    </div>
    <?endif?>

    <div class="container">
        <div class="breadcrumb-wrapper">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "",
                Array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            );?>


            <?$APPLICATION->IncludeComponent(
                "sebekon:fakultet.selector",
                "",
                Array(
                    "IBLOCK_ID" => getIBlockIdByCode("students"),	// Код информационного блока
                    "IBLOCK_TYPE" => 'students'
                )
            );?>
        </div>
    </div>

</nav>

<div class="es-theme-showcase">
	<div class="es-rightmenu">

		<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
				"AREA_FILE_SHOW" => "sect",
				"AREA_FILE_SUFFIX" => "inc",
				"AREA_FILE_RECURSIVE" => "Y",
			)
		);?>

		<? $APPLICATION->IncludeComponent("bitrix:menu",
			"ul_right_menu",
			array(
				"UL_CLASS"=>"",
				"ROOT_MENU_TYPE" => "right",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_TIME" => "36000000",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"CACHE_SELECTED_ITEMS" => "N",
				"MENU_THEME" => "site",
				"MENU_CACHE_GET_VARS" => array(),
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "N",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N"
			),
			false); ?>
	</div>
	
	<div class="es-right-column">
        <a href="#" class="instruction">Инструкция</a>
