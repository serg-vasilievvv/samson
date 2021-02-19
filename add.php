<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавление в коризну по XML_ID");
?>

<? $APPLICATION->IncludeComponent(
    "custom:addbyxml",
    ".default",
    array(
        "IBLOCK_TYPE" => "offers",
        "IBLOCK_ID" => 3,
    ),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>