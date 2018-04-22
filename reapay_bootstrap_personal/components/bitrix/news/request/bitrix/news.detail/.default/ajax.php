<?
define("PULL_AJAX_INIT", true);
define("PUBLIC_AJAX_MODE", true);
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC", "Y");
define("NO_AGENT_CHECK", true);
define("NOT_CHECK_PERMISSIONS", true);
define("DisableEventsCheck", true);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application,
    Bitrix\Main\Config\Option;

function process()
{
    $request = Application::getInstance()->getContext()->getRequest();
    if ($request->getPost('requestId') && check_bitrix_sessid() && CModule::IncludeModule('iblock'))
    {
        $ELEMENT_ID = $request->getPost('requestId');
        $IBLOCK_ID = COption::GetOptionString(SEBEKON_CONSTANTS["SETTINGS_MODULE_ID"], "iblock_request");
        CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, $IBLOCK_ID,  array(
            'VIEWED' => array(
                'VALUE'=> Option::get(SEBEKON_CONSTANTS['SETTINGS_MODULE_ID'], 'request_form_viewed_yes_id')
            )
        ));
        echo json_encode(array(
            'status' => 'ok',
            'id'=> $ELEMENT_ID
        ));

    }
}

process();

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>