<?

class AddByXmlId extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => intval($arParams["IBLOCK_ID"]),
        );

        return $result;
    }

    public function executeComponent()
    {
        if (!\CModule::IncludeModule("sale") || !\CModule::IncludeModule("catalog")) {
            $this->arResult = ['ERROR' => 'Для работы компонента необходимы модули catalog и sale'];
            return false;
        }

        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        if ($request->isPost() && 'title' == $request->get('action')) {
            $result = $this->get($request->get('XML_ID'));

            $GLOBALS['APPLICATION']->RestartBuffer();
            header('Content-Type: application/json');
            die(json_encode($result));
        }

        if ($request->isPost() && 'addbyxml' == $request->get('action') && check_bitrix_sessid()) {
            $this->add($request->get('XML_ID'));
            LocalRedirect($_SERVER['REQUEST_URI']);
        }

        $this->includeComponentTemplate();
    }

    protected function get(array $xml_ids)
    {
        if (!count($xml_ids)) return [];

        $query = \CIBlockElement::GetList(
            [],
            [
                '=IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                '=IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                '=XML_ID' => $xml_ids
            ],
            false,
            false,
            ['XML_ID', 'ID', 'NAME']
        );

        $result = [];
        while ($ob = $query->GetNextElement()) {
            $fields = $ob->GetFields();
            $result[$fields['XML_ID']] = [
                'ID' => $fields['ID'],
                'NAME' => $fields['NAME']
            ];
        }

        return $result;
    }

    protected function add(array $xml_ids)
    {
        $products = $this->get($xml_ids);

        foreach ($products as $prod) {
            Add2BasketByProductID($prod['ID']);
        }
    }
}