<?php
// 404 страница для случая, когда элемент не найден
AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error()
{
    if (defined('ERROR_404') && ERROR_404=='Y')
    {
        global $APPLICATION;
        CEventLog::Add(array(
            "SEVERITY" => "INFO",
            "AUDIT_TYPE_ID" => "ERROR_404",
            "MODULE_ID" => "main",
            "ITEM_ID" => 123,
            "DESCRIPTION" => $APPLICATION->GetCurPage(),
        ));
    }
}