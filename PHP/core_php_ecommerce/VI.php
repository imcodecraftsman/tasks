<?php
include 'includes/header.php';
echo "<div class='container mt-3'>";
        $a = '{
                "Currency":"INR",
                "BaseFare":"10800",
                "Tax":"1008",
                "YQTax":"0",
                "AdditionalTxnFee":"0",
                "AdditionalTxnFeeOfrd":"0",
                "AdditionalTxnFeePub":"0",
                "OtherCharges":"215.66",
                "Discount":"0",
                "PublishedFare":"12023.66",
                "CommissionEarned":"108",
                "IncentiveEarned":"0",
                "OfferedFare":"11915.66",
                "TdsOnCommission":"21.6",
                "TdsOnIncentive":"0",
                "ServiceFee":"0"
              }';

        $input = json_decode($a);
        $inputArray = json_decode(json_encode($input), true);


        echo "<h4>Q1. From the above string, display Fare Breakup including BaseFare, Tax and OtherCharges only</h4>";
        echo "<b>Base Fare</b> :- ".$inputArray["BaseFare"]."<br>";
        echo "<b>Tax</b> :- ".$inputArray["Tax"]."<br>";
        echo "<b>Discount</b> :- ".$inputArray["Discount"]."<br>";

        echo "-------------------------------------------------------------------------------------------------------------------------";


        echo "<h4>Q2. Add 10 % discount on BaseFare and display it in the Fare Breakup</h4>";
        $BaseFireNumber = intval($inputArray["BaseFare"]);
        $Discout = ($BaseFireNumber / 100 * 10); 
        echo "<b>Added Discount on Base Fire :- </b>".$inputArray["BaseFare"] = $inputArray["BaseFare"] - $Discout;


        echo "<br>-------------------------------------------------------------------------------------------------------------------------";


        echo "<h4>Q3. Display the total after the Fare Breakup</h4>";
        $AfterDiscount = intval($inputArray["BaseFare"]);
        $Tax = intval($inputArray["Tax"]);
        $Discount = intval($inputArray["Discount"]);

        echo "<b>Total Sum</b> :- ".$AfterDiscount + $Tax + $Discount;
echo "</div>";
include 'includes/footer.php';
?>
