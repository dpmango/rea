<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);



if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}
	?>
	<div class="row col-md-12 col-sm-12">
		<?
		$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
		$clearFromLink = array("filter_history","filter_status","show_all", "show_canceled");

		if ($nothing || $_REQUEST["filter_history"] == 'N')
		{
			?>
			<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>">
				<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
			</a>
			<?
		}
		if ($_REQUEST["filter_history"] == 'Y')
		{
			?>
			<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("", $clearFromLink, false)?>">
				<?echo Loc::getMessage("SPOL_TPL_CUR_ORDERS")?>
			</a>
			<?
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>">
					<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
				</a>
				<?
			}
			else
			{
				?>
				<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y&show_canceled=Y", $clearFromLink, false)?>">
					<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_CANCELED")?>
				</a>
				<?
			}
		}
		?>
	</div>
	<?
	/*if (!count($arResult['ORDERS']))
	{
		?>
		<div class="row col-md-12 col-sm-12">
			<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="sale-order-history-link">
				<?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
			</a>
		</div>
		<?
	}*/

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$paymentChangeData = array();
		$orderHeaderStatus = null;

		?>
        <table class="table hcentered centered">
        <tr>
            <th><a href="#" class="sort">№ Заказа<i>▲</i><i>▼</i></a></th>
            <th><a href="#" class="sort">Дата оплаты<i>▲</i><i>▼</i></a></th>
            <th><a href="#" class="sort">Наименование услуги<i>▲</i><i>▼</i></a></th>
            <th><a href="#" class="sort">Сумма к оплате<i>▲</i><i>▼</i></a></th>
            <th><a href="#" class="sort">Статус заказа<i>▲</i><i>▼</i></a></th>
            <th><a href="#" class="sort">Документы<i>▲</i><i>▼</i></a></th>
        </tr>
        <?

		foreach ($arResult['ORDERS'] as $key => $order)
		{
		    $arItem = current($order['BASKET_ITEMS']);
			if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $arResult['SORT_TYPE'] == 'STATUS')
			{
				$orderHeaderStatus = $order['ORDER']['STATUS_ID'];

				?>
				<h1 class="sale-order-title">
					<?= Loc::getMessage('SPOL_TPL_ORDER_IN_STATUSES') ?> &laquo;<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?>&raquo;
				</h1>
				<?
			}
			?>
            <tr>
                <td><?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?></td>
                <td><?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?></td>
                <td><p>
                        <?=$arItem['NAME']?>
                        <?/*
                        $count = count($order['BASKET_ITEMS']) % 10;
                        if ($count == '1')
                        {
                            echo Loc::getMessage('SPOL_TPL_GOOD');
                        }
                        elseif ($count >= '2' && $count <= '4')
                        {
                            echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                        }
                        else
                        {
                            echo Loc::getMessage('SPOL_TPL_GOODS');
                        }
                        ?>
                        <?=Loc::getMessage('SPOL_TPL_SUMOF')?> <?=$order['ORDER']['FORMATED_PRICE']*/?>

                    </p>
                    <a href="javascript:void(0)" class="seefullinfo">Подробнее</a>
                    <div class="fullinfo">


                        <?if (isset($order['CONTRACT_INFO']['PROPS']['NUMBER'])):?>
                            <p><b>№ договора</b><span><?=$order['CONTRACT_INFO']['PROPS']['NUMBER']?></span></p>
                        <?endif?>
                        <?if (isset($order['CONTRACT_INFO']['SCHEDULE']['DATE'])):?>
                            <p><b>Даты задолженности</b><span><?=$order['CONTRACT_INFO']['SCHEDULE']['DATE']?></span></p>
                        <?endif?>

                        <?if (isset($order['CONTRACT_INFO']['SCHEDULE']['SEMESTER'])):?>
                            <p><b>Семестр</b><span><?=$order['CONTRACT_INFO']['SCHEDULE']['SEMESTER']?></span></p>
                        <?endif?>


                        <?if (isset($order['CONTRACT_INFO']['PROPS']['STUDENT_FIO'])):?>
                        <p><b>ФИО</b><span><?=$order['CONTRACT_INFO']['PROPS']['STUDENT_FIO']?></span></p>
                        <?endif?>

                        <?if (isset($order['CONTRACT_INFO']['PROPS']['FACULTY'])):?>
                            <p><b>Факультет</b><span><?=$order['CONTRACT_INFO']['PROPS']['FACULTY']?></span></p>
                        <?endif?>
                        <?if (isset($order['CONTRACT_INFO']['PROPS']['DIRECTION'])):?>
                            <p><b>Направление</b><span><?=$order['CONTRACT_INFO']['PROPS']['DIRECTION']?></span></p>
                        <?endif?>

                        <?if (isset($order['CONTRACT_INFO']['PROPS']['LEVEL'])):?>
                            <p><b>Уровень подготовки</b><span><?=$order['CONTRACT_INFO']['PROPS']['LEVEL']?></span></p>
                        <?endif?>

                        <?if (isset($order['CONTRACT_INFO']['PROPS']['FORM'])):?>
                            <p><b>Форма обучения</b><span><?=$order['CONTRACT_INFO']['PROPS']['FORM']?></span></p>
                        <?endif?>
                    </div>
                </td>
                <td><?= $order['ORDER']['FORMATED_PRICE'] ?></td>
                <td><span class="tooltipedinfo round_green"><i>Оплачен</i></span></td>
                <td>
                    <a href="#" class="printbutton printbutton tooltipedinfo flaticon-file"><i>Выгрузить в Excel</i></a>
                    <a href="#" class="printbutton printbutton tooltipedinfo flaticon-print"><i>Печать</i></a>
                </td>
            </tr>
            <?/*


			<div class="col-md-12 col-sm-12 sale-order-list-container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 sale-order-list-title-container">
						<h2 class="sale-order-list-title">
							<?=Loc::getMessage('SPOL_TPL_ORDER')?>
							<?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?>
							<?=Loc::getMessage('SPOL_TPL_FROM_DATE')?>
							<?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?>,
							<?=count($order['BASKET_ITEMS']);?>
							<?
							$count = count($order['BASKET_ITEMS']) % 10;
							if ($count == '1')
							{
								echo Loc::getMessage('SPOL_TPL_GOOD');
							}
							elseif ($count >= '2' && $count <= '4')
							{
								echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
							}
							else
							{
								echo Loc::getMessage('SPOL_TPL_GOODS');
							}
							?>
							<?=Loc::getMessage('SPOL_TPL_SUMOF')?>
							<?=$order['ORDER']['FORMATED_PRICE']?>
						</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 sale-order-list-inner-container">
						<span class="sale-order-list-inner-title-line">
							<span class="sale-order-list-inner-title-line-item"><?=Loc::getMessage('SPOL_TPL_PAYMENT')?></span>
							<span class="sale-order-list-inner-title-line-border"></span>
						</span>*/?>
						<?
						/*$showDelimeter = false;
						foreach ($order['PAYMENT'] as $payment)
						{

							?>






							<div class="row sale-order-list-inner-row">
								<?
								if ($showDelimeter)
								{
									?>
									<div class="sale-order-list-top-border"></div>
									<?
								}
								else
								{
									$showDelimeter = true;
								}
								?>

								<div class="sale-order-list-inner-row-body">
									<div class="col-md-9 col-sm-8 col-xs-12 sale-order-list-payment">
										<div class="sale-order-list-payment-title">
											<?
											$paymentSubTitle = Loc::getMessage('SPOL_TPL_BILL')." ".Loc::getMessage('SPOL_TPL_NUMBER_SIGN').htmlspecialcharsbx($payment['ACCOUNT_NUMBER']);
											if(isset($payment['DATE_BILL']))
											{
												$paymentSubTitle .= " ".Loc::getMessage('SPOL_TPL_FROM_DATE')." ".$payment['DATE_BILL']->format($arParams['ACTIVE_DATE_FORMAT']);
											}
											$paymentSubTitle .=",";
											echo $paymentSubTitle;
											?>
											<span class="sale-order-list-payment-title-element"><?=$payment['PAY_SYSTEM_NAME']?></span>
											<?
											if ($payment['PAID'] === 'Y')
											{
												?>
												<span class="sale-order-list-status-success"><?=Loc::getMessage('SPOL_TPL_PAID')?></span>
												<?
											}
											elseif ($order['ORDER']['IS_ALLOW_PAY'] == 'N')
											{
												?>
												<span class="sale-order-list-status-restricted"><?=Loc::getMessage('SPOL_TPL_RESTRICTED_PAID')?></span>
												<?
											}
											else
											{
												?>
												<span class="sale-order-list-status-alert"><?=Loc::getMessage('SPOL_TPL_NOTPAID')?></span>
												<?
											}
											?>
										</div>
										<div class="sale-order-list-payment-price">
											<span class="sale-order-list-payment-element"><?=Loc::getMessage('SPOL_TPL_SUM_TO_PAID')?>:</span>

											<span class="sale-order-list-payment-number"><?=$payment['FORMATED_SUM']?></span>
										</div>
										<?
										if (!empty($payment['CHECK_DATA']))
										{
											$listCheckLinks = "";
											foreach ($payment['CHECK_DATA'] as $checkInfo)
											{
												$title = Loc::getMessage('SPOL_CHECK_NUM', array('#CHECK_NUMBER#' => $checkInfo['ID']))." - ". htmlspecialcharsbx($checkInfo['TYPE_NAME']);
												if (strlen($checkInfo['LINK']))
												{
													$link = $checkInfo['LINK'];
													$listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
												}
											}
											if (strlen($listCheckLinks) > 0)
											{
												?>
												<div class="sale-order-list-payment-check">
													<div class="sale-order-list-payment-check-left"><?= Loc::getMessage('SPOL_CHECK_TITLE')?>:</div>
													<div class="sale-order-list-payment-check-left">
														<?=$listCheckLinks?>
													</div>
												</div>
												<?
											}
										}
										if ($payment['PAID'] !== 'Y' && $order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y')
										{
											?>
											<a href="#" class="sale-order-list-change-payment" id="<?= htmlspecialcharsbx($payment['ACCOUNT_NUMBER']) ?>">
												<?= Loc::getMessage('SPOL_TPL_CHANGE_PAY_TYPE') ?>
											</a>
											<?
										}
										if ($order['ORDER']['IS_ALLOW_PAY'] == 'N' && $payment['PAID'] !== 'Y')
										{
											?>
											<div class="sale-order-list-status-restricted-message-block">
												<span class="sale-order-list-status-restricted-message"><?=Loc::getMessage('SOPL_TPL_RESTRICTED_PAID_MESSAGE')?></span>
											</div>
											<?
										}
										?>

									</div>
									<?
									if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y')
									{
										if ($order['ORDER']['IS_ALLOW_PAY'] == 'N')
										{
											?>
											<div class="col-md-3 col-sm-4 col-xs-12 sale-order-list-button-container">
												<a class="sale-order-list-button inactive-button">
													<?=Loc::getMessage('SPOL_TPL_PAY')?>
												</a>
											</div>
											<?
										}
										elseif ($payment['NEW_WINDOW'] === 'Y')
										{
											?>
											<div class="col-md-3 col-sm-4 col-xs-12 sale-order-list-button-container">
												<a class="sale-order-list-button" target="_blank" href="<?=htmlspecialcharsbx($payment['PSA_ACTION_FILE'])?>">
													<?=Loc::getMessage('SPOL_TPL_PAY')?>
												</a>
											</div>
											<?
										}
										else
										{
											?>
											<div class="col-md-3 col-sm-4 col-xs-12 sale-order-list-button-container">
												<a class="sale-order-list-button ajax_reload" href="<?=htmlspecialcharsbx($payment['PSA_ACTION_FILE'])?>">
													<?=Loc::getMessage('SPOL_TPL_PAY')?>
												</a>
											</div>
											<?
										}
									}
									?>

								</div>
								<div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 sale-order-list-inner-row-template">
									<a class="sale-order-list-cancel-payment">
										<i class="fa fa-long-arrow-left"></i> <?=Loc::getMessage('SPOL_CANCEL_PAYMENT')?>
									</a>
								</div>
							</div>?>
							<?
						}
                        */
						?>



            <?/*
            <div class="row sale-order-list-inner-row">
                <div class="sale-order-list-top-border"></div>
                <div class="col-md-2 col-sm-12 sale-order-list-repeat-container">
                    <a class="sale-order-list-repeat-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>"><?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?></a>
                </div>
                <div class="col-md-2 col-sm-12 sale-order-list-cancel-container">
                    <a class="sale-order-list-cancel-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"])?>"><?=Loc::getMessage('SPOL_TPL_CANCEL_ORDER')?></a>
                </div>
            </div>*/?>
			<?
		}
		?></table><?
	}
	else
	{
		$orderHeaderStatus = null;

		if ($_REQUEST["show_canceled"] === 'Y' && count($arResult['ORDERS']))
		{
			?>
			<h1 class="sale-order-title">
				<?= Loc::getMessage('SPOL_TPL_ORDERS_CANCELED_HEADER') ?>
			</h1>
			<?
		}
		?>
        <table class="table hcentered centered">
            <tr>
                <th><a href="#" class="sort">№ Заказа<i>▲</i><i>▼</i></a></th>
                <th><a href="#" class="sort">Дата оплаты<i>▲</i><i>▼</i></a></th>
                <th><a href="#" class="sort">Наименование услуги<i>▲</i><i>▼</i></a></th>
                <th><a href="#" class="sort">Сумма к оплате<i>▲</i><i>▼</i></a></th>
                <th><a href="#" class="sort">Статус заказа<i>▲</i><i>▼</i></a></th>
                <th><a href="#" class="sort">Документы<i>▲</i><i>▼</i></a></th>
            </tr>

        <?

		foreach ($arResult['ORDERS'] as $key => $order)
		{
			/*if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $_REQUEST["show_canceled"] !== 'Y')
			{
				$orderHeaderStatus = $order['ORDER']['STATUS_ID'];
				?>
				<h1 class="sale-order-title">
					<?= Loc::getMessage('SPOL_TPL_ORDER_IN_STATUSES') ?> &laquo;<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?>&raquo;
				</h1>
				<?
			}*/
			?>

            <tr>
                <td><?= htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER'])?></td>
                <td><?= $order['ORDER']['DATE_INSERT'] ?></td>
                <td><p>
                        <?
                        $count = substr(count($order['BASKET_ITEMS']), -1);
                        if ($count == '1')
                        {
                            echo Loc::getMessage('SPOL_TPL_GOOD');
                        }
                        elseif ($count >= '2' || $count <= '4')
                        {
                            echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                        }
                        else
                        {
                            echo Loc::getMessage('SPOL_TPL_GOODS');
                        }
                        ?>
                        <?= Loc::getMessage('SPOL_TPL_SUMOF') ?>

                    </p>
                    <a href="javascript:void(0)" class="seefullinfo">Подробнее</a>
                    <div class="fullinfo">
                        <p><b>№ договора</b><span>ММ10000</span></p>
                        <p><b>ФИО</b><span>Сергеев Евгений Семенович</span></p>
                        <p><b>Номер карты</b><span>428295*******7448</span></p>
                    </div>
                </td>
                <td><?= $order['ORDER']['FORMATED_PRICE'] ?></td>
                <td><span class="tooltipedinfo round_orange"><i>Ожидается подтверждение платежа</i></span></td>
                <td>
                    <a href="#" class="printbutton printbutton tooltipedinfo flaticon-file"><i>Выгрузить в Excel</i></a>
                    <a href="#" class="printbutton printbutton tooltipedinfo flaticon-print"><i>Печать</i></a>
                </td>
            </tr>

            <?/*

			<div class="col-md-12 col-sm-12 sale-order-list-container">
				<div class="row">
					<div class="col-md-12 col-sm-12 sale-order-list-accomplished-title-container">
						<div class="row">
							<div class="col-md-8 col-sm-12 sale-order-list-accomplished-title-container">
								<h2 class="sale-order-list-accomplished-title">
									<?= Loc::getMessage('SPOL_TPL_ORDER') ?>
									<?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') ?>
									<?= htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER'])?>
									<?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
									<?= $order['ORDER']['DATE_INSERT'] ?>,
									<?= count($order['BASKET_ITEMS']); ?>
									<?
									$count = substr(count($order['BASKET_ITEMS']), -1);
									if ($count == '1')
									{
										echo Loc::getMessage('SPOL_TPL_GOOD');
									}
									elseif ($count >= '2' || $count <= '4')
									{
										echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
									}
									else
									{
										echo Loc::getMessage('SPOL_TPL_GOODS');
									}
									?>
									<?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
									<?= $order['ORDER']['FORMATED_PRICE'] ?>
								</h2>
							</div>
							<div class="col-md-4 col-sm-12 sale-order-list-accomplished-date-container">
								<?
								if ($_REQUEST["show_canceled"] !== 'Y')
								{
									?>
									<span class="sale-order-list-accomplished-date">
										<?= Loc::getMessage('SPOL_TPL_ORDER_FINISHED')?>
									</span>
									<?
								}
								else
								{
									?>
									<span class="sale-order-list-accomplished-date canceled-order">
										<?= Loc::getMessage('SPOL_TPL_ORDER_CANCELED')?>
									</span>
									<?
								}
								?>
								<span class="sale-order-list-accomplished-date-number"><?= $order['ORDER']['DATE_STATUS_FORMATED'] ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 sale-order-list-inner-accomplished">
						<div class="row sale-order-list-inner-row">
							<div class="col-md-3 col-sm-12 sale-order-list-about-accomplished">
								<a class="sale-order-list-about-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"])?>">
									<?=Loc::getMessage('SPOL_TPL_MORE_ON_ORDER')?>
								</a>
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-12 sale-order-list-repeat-accomplished">
								<a class="sale-order-list-repeat-link sale-order-link-accomplished" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>">
									<?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?*/
		}?> </table>
        <?



        }
	?>


	<div class="clearfix"></div>
	<?
	echo $arResult["NAV_STRING"];

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"paymentList" => $paymentChangeData
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}
?>
