<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);



$arResult['CONTRACT_INFO'] = array();

$arContract = array();
if ( isset($arResult['BASKET_ITEMS'][0]['PRODUCT_ID'])
&& Bitrix\Main\Loader::includeModule("itsfera.integration")
) {

    //получаем айдишник графика оплаты из корзины
    $arBasketItem = $arResult['BASKET_ITEMS'][0];
    $iScheduleId = array_reduce($arBasketItem['PROPS'],function($carry,$arItem){

        if ($arItem['CODE']=="schedule") $carry = $arItem['VALUE'];
        return $carry;

    });


    if ($arSchedule = \Itsfera\Integration\ContractsWorkSchedule::getOne( $iScheduleId, $bGetUserId=true)){

        $iContractId = $arSchedule['CONTRACT'];
        $obContracts = new \Itsfera\Integration\Contracts();
        $arResult['CONTRACT_INFO'] = $obContracts->getContractInfo( $iContractId );
        unset($obContracts);

    }

}


$arPayments = array();
//получаем список возможных оплат с процентами
if ( Bitrix\Main\Loader::includeModule("iblock") ) {

    $arSelect = Array("ID", "NAME", "PROPERTY_PERCENT");
    $arFilter = Array("IBLOCK_ID" => getIBlockIdByCode("payments"),  "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $iPercent = intval($arFields['PROPERTY_PERCENT_VALUE']);

        $arPayments[] = array('NAME'=>$arFields['NAME'].' '.$iPercent.'%','PERCENT'=>$arFields['PROPERTY_PERCENT_VALUE']);
    }
}




    //dump($arResult['BASKET_ITEMS'], __FILE__, __LINE__);


use Bitrix\Main\Page\Asset;
Asset::getInstance()->addString("<script>var arPayments=JSON.parse('".\Bitrix\Main\Web\Json::encode($arPayments)."');var arContractInfo=JSON.parse('".\Bitrix\Main\Web\Json::encode($arResult['CONTRACT_INFO'])."');  </script>");