<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$itemSize = count($arResult);
//delayed function must return a string
if(empty($arResult) || $itemSize<2)
	return "";



$strReturn = '';

$strReturn .= '<ol class="breadcrumb">';
for($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1){
		$strReturn .= '
		<li><a href="'.$arResult[$index]["LINK"].'">'.$title.'</a></li>';
	}else{
		$strReturn .= '<li class="active">'.$title.'</li>';
	}
}
$strReturn .= '</ol>';
return $strReturn;