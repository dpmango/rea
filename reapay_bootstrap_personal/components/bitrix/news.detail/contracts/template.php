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
?><h2>Информация о договоре</h2>
<table class="table table-striped">
    <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):

        ${$pid} = $arProperty["DISPLAY_VALUE"];
        ?>

    <tr>
        <td><?=$arProperty["NAME"]?></td>
        <td> <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
            <?else:?>
                <?=$arProperty["DISPLAY_VALUE"];?>
            <?endif?>  </td>
    </tr>


    <?endforeach;?>


</table>


<?if (isset($arResult['SCHEDULES'][0])):?>
    <h2>График оплат</h2>
    <p>№ Договора - <?=$NUMBER?></p>
<table class="table striped centered">
    <tbody>

    <tr>
        <th><a href="#" class="sort">Учебный год</th> <?//<i>▲</i><i>▼</i>?>
        <th><a href="#" class="sort">Семестр</a></th>
        <th><a href="#" class="sort">Оплачено</a></th>
        <th><a href="#" class="sort">Срок погашения оплаты</a></th>
        <th><a href="#" class="sort">К оплате</a></th>
        <th><a href="#" class="sort">Результат</a></th>
    </tr>

    <?

    $bNeedPayBefore = false; //оплачивать нужно по порядку
    foreach ($arResult['SCHEDULES'] as $step) {
        //TODO проверить разницу сумм
        ?>

        <tr>
            <td><?=$step["YEAR"]?></td>
            <td><?=$step["SEMESTER"]>0?'Семестр '.$step["SEMESTER"]:'Без семестров'?></td>
            <td><?if (intval($step["SUM_FACT"])==0 && $step["TRANSACTION"]):?><?=number_format($step['TRANSACTIONS_SUM'],0,',',' ')?><?else:?><?=number_format($step["SUM_FACT"],0,',',' ')?><?endif?>
            </td>
            <td><?=$step["DATE"]?></td>
            <td><?=number_format($step["SUM_LEFT"],0,',',' ')?></td>
            <td>

                <?if ($step["SUM_LEFT"]!=0 && !$step["TRANSACTION"]) {?>
                    <?/*if ():?>

                        <span class="yellow tooltipedinfo">
                            Ожидается подтверждение
                        </span>

                    <?else:*/
                        ?>

                        <span class="yellow tooltipedinfo">
                            <?if (!$bNeedPayBefore):?>
                                <a class="btn btn-primary" href="javascript:void(0)"  onclick="Add2Basket('edu_payment','<?=$NUMBER?>','<?=$step["SUM_LEFT"]?>','<?=$step["ID"]?>');" >Оплатить</a>
                            <?else:?><br>
                                -<?//Оплатите предыдущий период?>
                            <?endif?>

                        </span>
                    <?
                        $bNeedPayBefore =true;
                        /*
                    <button class="btn btn-primary">Оплатить</button>
                    */?>
                     <?//endif?>
                <?} else {?>
                    <span class="green">Погашено</span>
                <?}?>

            </td>
        </tr>
    <?}?>
    </tbody>
</table>
<?endif?>