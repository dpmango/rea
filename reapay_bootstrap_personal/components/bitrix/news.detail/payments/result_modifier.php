<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Itsfera\Integration\ContractsWorkSchedule, \Itsfera\Integration\ContractsWorkPayments;
\Bitrix\Main\Loader::includeModule('itsfera.integration');

$arResult['SCHEDULES'] = ContractsWorkSchedule::getList( $arResult['ID'] );
$arResult['PAYMENTS'] = ContractsWorkPayments::getList( $arResult['ID'] );




?>