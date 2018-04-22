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
?>
<div class="request__content__result">
    <h2 class="request__content__result__title">Результаты рассмотрения заявки</h2>
	
	<div class="es-request__content-top">
		<div class="es-request__content-line">
			<div class="es-request__content-label">Статус заявки</div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text es-request__content-text-bg"><?=$arResult['DISPLAY_PROPERTIES']['STATUS']['DISPLAY_VALUE'] ?></span>
                <?if($arResult['DISPLAY_PROPERTIES']['STATUS']['IMAGE']):?>
                    <img class="request__table__img" src="<?=$arResult['DISPLAY_PROPERTIES']['STATUS']['IMAGE']?>" >
                <?endif;?>
			</div>
		</div>
		<div class="es-request__content-line">
			<div class="es-request__content-label">Дата ответа</div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text"><?=($arResult['DISPLAY_PROPERTIES']['DATE_OF_THE_ANSWER']['DISPLAY_VALUE'])?:'-' ?></span>
			</div>
		</div>
		<div class="es-request__content-line">
			<div class="es-request__content-label">Ответ на заявку</div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text"><?= ($arResult['DISPLAY_PROPERTIES']['UNIVERSITY_COMMENT']['DISPLAY_VALUE'])?:'-'?></span>
			</div>
		</div>
	</div>

<?/*?>
<table class="request__content__result__table request__table">
    <tr>
        <td class="request__table__th">Статус заявки</td>
        <td>
            <span ><?=$arResult['DISPLAY_PROPERTIES']['STATUS']['DISPLAY_VALUE'] ?></span>
            <?if($arResult['DISPLAY_PROPERTIES']['STATUS']['IMAGE']):?>
                <img class="request__table__img" src="<?=$arResult['DISPLAY_PROPERTIES']['STATUS']['IMAGE']?>" >
            <?endif;?>
        </td>
    </tr>
    <tr>
        <td class="request__table__th">Дата ответа</td>
        <td><?=($arResult['DISPLAY_PROPERTIES']['DATE_OF_THE_ANSWER']['DISPLAY_VALUE'])?:'-' ?></td>
    </tr>
    <tr>
        <td class="request__table__th">Ответ на заявку</td>
        <td><?= ($arResult['DISPLAY_PROPERTIES']['UNIVERSITY_COMMENT']['DISPLAY_VALUE'])?:'-'?></td>
    </tr>
</table>
<?*/?>
	
</div>
<div class="request__content__data">
    <h2 class="request__content__data__title">Данные заявки</h2>
	
	
	<div class="es-request__data-wrap">
		<div class="es-request__content-line">
			<div class="es-request__content-label"><span>Тип запрашиваемого документа</span></div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['TYPE_OF_DOCUMENT']['DISPLAY_VALUE'] ?></span>
			</div>
		</div>
		
		<div class="es-request__content-line">
			<div class="es-request__content-label"><span>Комментарий к заявке</span></div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['USER_COMMENT']['DISPLAY_VALUE'] ?></span>
			</div>
		</div>

        <?switch ($arResult['DISPLAY_PROPERTIES']['TYPE_OF_DOCUMENT']['VALUE']):
            case 'training_certificate':?>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Место назначения справки</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?= ($arResult['PROPERTIES']['DESTINATION']['VALUE'] == 'other')?$arResult['PROPERTIES']['YOUR_DESTINATION']['VALUE']:$arResult['DISPLAY_PROPERTIES']['DESTINATION']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Включить в справку основу обучения</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['INCLUDE_STUDY_BASE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Включить в справку дату начала обучения</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['INCLUDE_DATE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <?break;?>
            <? case 'invocation':?>
                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Место работы</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['JOB']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Цель предоставления справки</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['THE_PURPOSE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Дата начала отпуска</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['START_DATE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Дата окончания отпуска</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['END_DATE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>
                <?break;?>
            <? case 'extract_from_the_order':?>
                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Сведения о запрашиваемом приказе</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['ORDER']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>
                <?break;?>
            <? case 'certificate_of_scholarship':?>
                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Дата начала периода</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['START_DATE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Дата окончания периода</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['END_DATE']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>
                <?break;?>
            <? case 'copy_of_the_contract':?>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Сведения о запрашиваемом договоре</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['ORDER']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Сведения о запрашиваемом допсоглашении</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?=$arResult['DISPLAY_PROPERTIES']['ADDITIONAL_AGREEMENT']['DISPLAY_VALUE'] ?></span>
                    </div>
                </div>

                <?break;?>
            <? case 'characteristic':?>
                <div class="es-request__content-line">
                    <div class="es-request__content-label"><span>Место назначения характеристики</span></div>
                    <div class="es-request__content-desc">
                        <span class="es-request__content-text"><?= $arResult['PROPERTIES']['YOUR_DESTINATION']['VALUE'] ?></span>
                    </div>
                </div>
                <?break;?>
            <?endswitch;?>

		<div class="es-request__content-line">
			<div class="es-request__content-label"><span>Дата создания</span></div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text"><?=$arResult['DATE_CREATE'];?></span>
			</div>
		</div>
		
		<div class="es-request__content-line">
			<div class="es-request__content-label"><span>Код заявки</span></div>
			<div class="es-request__content-desc">
				<span class="es-request__content-text"><?=$arResult['ID'];?></span>
			</div>
		</div>
	</div>

<?/*?>
    <table class="request__content__data__table request__table">
        <tr>
            <td class="request__table__th">Тип запрашиваемого документа</td>
            <td><?=$arResult['DISPLAY_PROPERTIES']['TYPE_OF_DOCUMENT']['DISPLAY_VALUE'] ?></td>
            <td class="request__table__th second">Дата создания</td>
            <td><?=$arResult['DATE_CREATE'];?></td>
        </tr>
        <tr>
            <td class="request__table__th">Комментарий к заявке</td>
            <td><?=$arResult['DISPLAY_PROPERTIES']['USER_COMMENT']['DISPLAY_VALUE'] ?></td>
            <td class="request__table__th second">Код заявки</td>
            <td><?=$arResult['ID'];?></td>
        </tr>
        <tr>
            <td class="request__table__th">Требуется экземпляров документа</td>
            <td><?=$arResult['DISPLAY_PROPERTIES']['NUMBER_OF_COPIES']['DISPLAY_VALUE'] ?></td>
            <td class="request__table__th second">Код заявки</td>
            <td><?=$arResult['ID'];?></td>
        </tr>
        <tr>
            <td class="request__table__th">Комментарий к заявке</td>
            <td><?=$arResult['DISPLAY_PROPERTIES']['USER_COMMENT']['DISPLAY_VALUE'] ?></td>
        </tr>

        <?switch ($arResult['DISPLAY_PROPERTIES']['TYPE_OF_DOCUMENT']['VALUE']):
            case 'training_certificate':?>
                   <!-- <tr>
                        <td class="request__table__th">Требуется экземпляров документа</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['NUMBER_OF_COPIES']['DISPLAY_VALUE']?></td>
                    <tr>-->
                        <td class="request__table__th">Место назначения</td>
                        <td><?= ($arResult['PROPERTIES']['DESTINATION']['VALUE'] == 'other')?$arResult['PROPERTIES']['YOUR_DESTINATION']['VALUE']:$arResult['DISPLAY_PROPERTIES']['DESTINATION']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Указать основание обучения</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['INCLUDE_STUDY_BASE']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Указать период обучения</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['INCLUDE_DATE']['DISPLAY_VALUE'] ?></td>
                    </tr>
            <?break;?>
            <? case 'invocation':?>
                    <tr>
                        <td class="request__table__th">Место работы</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['JOB']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Цель предоставления справки</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['THE_PURPOSE']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Дата начала отпуска</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['START_DATE']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Дата окончания отпуска</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['END_DATE']['DISPLAY_VALUE'] ?></td>
                    </tr>
            <?break;?>
            <? case 'extract_from_the_order':?>
                    <tr>
                        <td class="request__table__th">Сведения о запрашиваемом приказе</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['ORDER']['DISPLAY_VALUE'] ?></td>
                    </tr>
            <?break;?>
            <? case 'certificate_of_scholarship':?>
                    <tr>
                        <td class="request__table__th">Дата начала периода</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['START_DATE']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Дата окончания периода</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['END_DATE']['DISPLAY_VALUE'] ?></td>
                    </tr>
            <?break;?>
            <? case 'copy_of_the_contract':?>
                    <tr>
                        <td class="request__table__th">Сведения о запрашиваемом приказе</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['ORDER']['DISPLAY_VALUE'] ?></td>
                    </tr>
                    <tr>
                        <td class="request__table__th">Сведения о запрашиваемом допсоглашении</td>
                        <td><?=$arResult['DISPLAY_PROPERTIES']['ADDITIONAL_AGREEMENT']['DISPLAY_VALUE'] ?></td>
                    </tr>
            <?break;?>
            <? case 'characteristic':?>
                    <tr>
                        <td class="request__table__th">Место назначения</td>
                        <td><?= $arResult['PROPERTIES']['YOUR_DESTINATION']['VALUE'];?></td>
                    </tr>
            <?break;?>
        <?endswitch;?>
    </table>
<?*/?>
</div>

<?if(empty($arResult['PROPERTIES']['VIEWED']['VALUE'])):?>
    <script>
        (function ($) {
            $(function () {
                $.ajax({
                    type: 'POST',
                    url: '<?=$templateFolder?>/ajax.php',
                    data: {requestId: '<?=$arResult['ID']?>', 'sessid': '<?=bitrix_sessid();?>' },
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                       if (data.status == 'ok' )
                           console.log('Просмотрено');
                    },
                    error: function () {
                        console.log('Неуспешно');
                    }
                });
            });
        })($);
    </script>
<?endif;?>
