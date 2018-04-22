<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


\Bitrix\Main\Loader::includeModule("sale");
\Bitrix\Main\Loader::includeModule('itsfera.integration');

foreach ($arResult['ORDERS'] as &$arOrder ){

    $iOrderId = $arOrder['ORDER']['ID'];

    $arOrder['CONTRACT_INFO'] = getContractInfo( $iOrderId );


}

unset($arOrder);



function getContractInfo( $iOrderId )
{
    // Выведем актуальную корзину для текущего пользователя

    $arBasketItems = array();

    $dbBasketItems = CSaleBasket::GetList(array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
        array(
            "LID" => SITE_ID,
            "ORDER_ID" => $iOrderId
        ),
        false,
        false,
        array("ID"));
    while ($arItems = $dbBasketItems->Fetch()) {

        // Выведем все свойства элемента корзины с кодом $basketID
        $db_res = CSaleBasket::GetPropsList(array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        ),
            array("BASKET_ID" => $arItems['ID'], "CODE" => "schedule"));
        if ($arProp = $db_res->Fetch()) {

            if (isset($arProp['VALUE']) && $arProp['VALUE'] > 0) {

                //AddMessage2Log('here1', "", 0);

                //отправляем уведомление в веб сервис об оплате

                                    //AddMessage2Log('here2', "", 0);

                $arFields['SCHEDULE_ID'] = $arProp['VALUE'];
                $arFields['ORDER_ID']    = $iOrderId;

                $arScheduleInfo = \Itsfera\Integration\ContractsWorkSchedule::getOne($arFields['SCHEDULE_ID'],true);

                $obContracts = new \Itsfera\Integration\Contracts();
                $arContractInfo = $obContracts->getContractInfo( $arScheduleInfo['CONTRACT'] );
                unset($obContracts);
                $arContractInfo['SCHEDULE'] = $arScheduleInfo;
                $arTransactions = \Itsfera\Integration\Transactions::getScheduleTransaction( $arScheduleInfo['ID'] );
                $arContractInfo['TRANSACTION'] = array();

                if (is_array($arTransactions)) {
                    $arContractInfo['TRANSACTION'] = array_reduce( $arTransactions,function($carry, $arItem){

                        $carry = $carry || ($arItem['UF_STATUS']===\Itsfera\Integration\Transactions::SUCCESS_STATUS);
                        return $carry;

                    }) ;

                }



                //AddMessage2Log('$arScheduleInfo: '.print_r($arScheduleInfo,true),'',0);
                return $arContractInfo;

            }
        }
    }

    return false;

}


?>