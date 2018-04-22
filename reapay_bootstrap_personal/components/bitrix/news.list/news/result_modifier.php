<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$templateFolder = $this->__component->__template->__folder;

foreach ($arResult['ITEMS'] as $k=>&$arItem){
    if (is_array($arItem['PREVIEW_PICTURE'])) {
        $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>82, 'height'=>82), BX_RESIZE_IMAGE_EXACT, true); 
        $arItem['PREVIEW_PICTURE']['SRC'] = $file['src'];
        $arItem['PREVIEW_PICTURE']['WIDTH'] = $file['width'];
        $arItem['PREVIEW_PICTURE']['HEIGHT'] = $file['height'];
    }else {

        $arItem['PREVIEW_PICTURE']['SRC'] = $templateFolder.'/images/emblema.png';
        $arItem['PREVIEW_PICTURE']['WIDTH'] = 82;
        $arItem['PREVIEW_PICTURE']['HEIGHT'] = 82;

    }

}