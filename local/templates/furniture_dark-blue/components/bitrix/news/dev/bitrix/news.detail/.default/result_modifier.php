<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arParams["CANNONICAL"]!="")
{
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID"=>$arParams["CANNONICAL"],"PROPERTY_NEWS" => $arResult["ID"] ,"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNext())
    {
        $arResult['CANNONICAL']=$ob["NAME"];
    }
}
$APPLICATION->SetPageProperty("CANNONICAL", $arResult['CANNONICAL']);