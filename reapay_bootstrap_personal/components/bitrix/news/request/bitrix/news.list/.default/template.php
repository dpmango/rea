<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Bitrix\Main\Application;
$request = Application::getInstance()->getContext()->getRequest();
$isSubmitted = $request->get('success') === 'Y';
?>
<?if($isSubmitted):?>
<div class="request__content__success">
    Заявка отправлена!
</div>
<?endif;?>

<div class="request__list">
	<div class="request__list-header">
		<div class="request__list-type">Тип запрашиваемого документа</div>
		<div class="request__list-datafirst">Дата запроса</div>
		<div class="request__list-status">Статус</div>
		<div class="request__list-datalast">Дата ответа</div>
		<div class="request__list-answer">Ответ ВУЗа</div>
	</div>
	<div class="request__list-body">
		<? foreach ($arResult['ITEMS'] as $arItem): ?>
			<div class="request__list-line <?= empty($arItem['PROPERTIES']['VIEWED']['VALUE'])?'not-viewed':''?>">
				<div class="request__list-type">
					<a href="<?= $arItem['DETAIL_PAGE_URL']?>">
						<?=$arItem['DISPLAY_PROPERTIES']['TYPE_OF_DOCUMENT']['DISPLAY_VALUE'] ?>
					</a>
				</div>
				<div class="request__list-datafirst">
					<?=$arItem['DATE_CREATE'] ?>
				</div>
				<div class="request__list-status">
					<?=$arItem['DISPLAY_PROPERTIES']['STATUS']['DISPLAY_VALUE'] ?>
				</div>
				<div class="request__list-datalast">
					<?=str_replace('&nbsp;', ' ', $arItem['DISPLAY_PROPERTIES']['DATE_OF_THE_ANSWER']['DISPLAY_VALUE'])?:'-'; ?>
				</div>
				<div class="request__list-answer">
					<?if ($arItem['DISPLAY_PROPERTIES']['UNIVERSITY_COMMENT']['DISPLAY_VALUE']): ?>
						<a href="<?= $arItem['DETAIL_PAGE_URL']?>"> <img src="<?= SITE_TEMPLATE_PATH?>/images/university_comment.png" alt=""></a>
					<?else:?>
						-
					<?endif;?>
				</div>
			</div>
		<? endforeach; ?>
	</div>
</div>
<br>
<?if($arParams['~DISPLAY_BOTTOM_PAGER'] === 'Y'):?>
    <?=$arResult['NAV_STRING']?>
<?endif;?>
