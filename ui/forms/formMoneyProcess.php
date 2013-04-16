<?php
	include("functions/xml.php");

	$existingMoneymoney = getMoney($name);
	$nrOfMoney = count($existingMoneymoney);
	$idNewMoney = $nrOfMoney + 1;
	$existingMoneymoney[$idNewMoney]['id'] = $idNewMoney;
	$existingMoneymoney[$idNewMoney]['who'] = $_POST["who"];
	$existingMoneymoney[$idNewMoney]['what'] = $_POST["what"];
	$amount = $_POST["amount"];
	$amounts = explode(",",$amount);
	$before = $amounts[0];
	$after = $amounts[1];

	if (strlen($after == 0))
	{
		$after = "00";
	}
	else if (strlen($after) ==1)
	{
		$after = $after."0";
	}

	$amount = $before.",".$after;
	$existingMoneymoney[$idNewMoney]['amount'] = $amount;
	$existingMoneymoney[$idNewMoney]['date'] = $_POST["date"];
	$existingMoneymoney[$idNewMoney]['event_id'] = $_POST["event_id"];

	writeMoney($existingMoneymoney, $name, "");

?>