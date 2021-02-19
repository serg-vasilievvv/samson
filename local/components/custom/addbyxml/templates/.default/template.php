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

if ($arResult['ERROR']) {
    echo $arResult['ERROR'];
}
?>

<form method="POST" class="addbyxml">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="action" value="addbyxml">
    <div class="inputs">
        <div class="form-group row multiple">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="XML_ID[]">
            </div>
            <label class="col-sm-6 col-form-label">Введите XML_ID для поиска</label>
        </div>
    </div>
    <br>
    <div class="form-group row row-cols-3">
        <input type="button" name="more" value="Еще" class="btn btn-secondary col btn-more">
        <div class="col"></div>
        <input type="submit" name="submit_add" value="Добавить в корзину" class="btn btn-primary col">
    </div>
</form>