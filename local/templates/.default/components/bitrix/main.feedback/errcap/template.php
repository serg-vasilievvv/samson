<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

if (!empty($arResult["ERROR_MESSAGE"]) || $arResult["OK_MESSAGE"] <> '') {
	$APPLICATION->RestartBuffer();
    header('Content-Type: application/json');

    echo json_encode([
        'errors' => $arResult["ERROR_MESSAGE"],
        'result' => $arResult["OK_MESSAGE"]
    ]);

    die($arResult["OK_MESSAGE"] <> '' ? 200 : 500);
}
?>

<form id="errcap" action="<?= POST_FORM_ACTION_URI ?>" method="POST" style="display: none">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
</form>
