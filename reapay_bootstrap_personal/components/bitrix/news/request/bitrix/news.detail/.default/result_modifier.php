<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$hlBlockStatusId = COption::GetOptionString(SEBEKON_CONSTANTS["SETTINGS_MODULE_ID"], 'hlblock_status_of_the_application');
$rsData = getHighloadBlockDataClassById($hlBlockStatusId)::getList(array(
    "select" => array("UF_FILE"),
    "filter" => array('UF_XML_ID' => $arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE']),
));

if($arItem = $rsData->Fetch())
{
    $arResult['DISPLAY_PROPERTIES']['STATUS']['IMAGE'] = CFile::GetPath($arItem['UF_FILE']);
}