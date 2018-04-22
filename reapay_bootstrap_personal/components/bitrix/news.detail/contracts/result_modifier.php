<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Itsfera\Integration\ContractsWorkSchedule, \Itsfera\Integration\ContractsWorkPayments,\Itsfera\Integration\Transactions;
\Bitrix\Main\Loader::includeModule('itsfera.integration');

$arResult['SCHEDULES'] = ContractsWorkSchedule::getList( $arResult['ID'] );

$arResult['TRANSACTIONS'] = Transactions::getContractTransactions(  $arResult['ID']  );

foreach ($arResult['SCHEDULES'] as &$arSchedule){
    $arSchedule['TRANSACTION'] = false;

    if ( array_key_exists($arSchedule['ID'], $arResult['TRANSACTIONS']) ){

        //проходим по массиву и вычисляем есть ли удачные транзакции
        $arSchedule['TRANSACTION'] = array_reduce( $arResult['TRANSACTIONS'][$arSchedule['ID']],function($carry, $arItem){

            $carry = $carry || ($arItem['UF_STATUS']===Transactions::SUCCESS_STATUS);
            return $carry;

        }) ;


        //проходим по массиву и вычисляем есть ли удачные транзакции
        $arSchedule['TRANSACTIONS_SUM'] = array_reduce( $arResult['TRANSACTIONS'][$arSchedule['ID']],function($carry, $arItem){

            $carry += $arItem['UF_SUMM'];
            return $carry;

        }) ;


    }
}
unset($arSchedule);

/*if ($GLOBALS['USER']->IsAdmin()){
    dump( $arResult['SCHEDULES'] , __FILE__, __LINE__ );
    dump( $arResult['TRANSACTIONS'] , __FILE__, __LINE__ );
}*/

//$arResult['PAYMENTS'] = ContractsWorkPayments::getList( $arResult['ID'] );




?>