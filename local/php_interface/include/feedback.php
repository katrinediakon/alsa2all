<?php
AddEventHandler("main", "OnBeforeEventAdd", array("MyClass", "OnBeforeEventAddHandler"));

class MyClass
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;
            $informUser = "Пользователь не авторизован.";
            if ($USER->GetID()) {
                $informUser = "Пользователь авторизован: " . $USER->GetID() . "(" . $USER->GetLogin() . ") " . $USER->GetFullName();
                CEventLog::Add(array(
                    "SEVERITY" => "SECURITY",
                    "AUDIT_TYPE_ID" => "feedback",
                    "MODULE_ID" => "main",
                    "ITEM_ID" => feedback,
                    "DESCRIPTION" => "Замена данных в отсылаемом письме – " . $arFields["AUTHOR"],
                ));
            }
            $arEventFields = array(
                "AUTHOR" => $informUser . "данные из формы: " . $arFields["AUTHOR"],
                "EMAIL" => $arFields["AUTHOR_EMAIL"],
                "TEXT" => $arFields["TEXT"],
            );
            CEvent::Send("FEEDBACK_FORM", "s1", $arEventFields);
        }
    }
}

?>