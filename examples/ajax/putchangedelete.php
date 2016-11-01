<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$request = getParametrs();

if($_SERVER['REQUEST_METHOD'] == "PUT") {
	$el = new CIBlockElement;

$PROP = array();
$PROP['AGE'] = $request['age'];

$arLoadProductArray = Array(
  "MODIFIED_BY"    => 1,
  "IBLOCK_SECTION_ID" => false,
  "IBLOCK_ID"      => 2,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $request['name'],
  "ACTIVE"         => "Y",      
  "PREVIEW_TEXT"   => $request['text']
  );

	if($PRODUCT_ID = $el->Add($arLoadProductArray))
	  echo "Ќовый элемент с ID: ".$PRODUCT_ID;
	else
	  echo "Error: ".$el->LAST_ERROR;

} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
	$el = new CIBlockElement;

	$PROP = array();
	$PROP['AGE'] = $request['age']; 

	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => 1,
	  "IBLOCK_SECTION" => false,         
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => $request['name'],
	  "ACTIVE"         => "Y",           
	  "PREVIEW_TEXT"   => $request['text'],
	  );

	$PRODUCT_ID = $request['id'];
	$res = $el->Update($PRODUCT_ID, $arLoadProductArray);

	if($res == 1) {
		echo "Ёлемент с ID " . $PRODUCT_ID . " был изменен";
	} else {
		echo "Ёлемент с ID " . $PRODUCT_ID . " не найден";
	}
} elseif($_SERVER['REQUEST_METHOD'] == "DELETE") {
	if(CIBlock::GetPermission(2)>='W')
	{
	    $DB->StartTransaction();
	    if(!CIBlockElement::Delete($request['id']))
	    {
	        $strWarning .= 'Error!';
	        $DB->Rollback();
	        echo $strWarning;
	    }
	    else {
	        $DB->Commit();
	        echo "Ёлемент с ID " . $request['id'] . " удален";
	    }
	}
}



function getParametrs() {
	if($_SERVER['REQUEST_METHOD'] != "POST") {
		$data = file_get_contents('php://input');
		$array = array();
		parse_str($data, $array);

		foreach ($array as &$value) {
			$value = iconv("UTF-8", "windows-1251", $value);
		}

		return $array;
	} else {
		foreach ($_POST as &$value) {
			$value = iconv("UTF-8", "windows-1251", $value);
		}
		return $_POST;
	}
}