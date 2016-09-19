<?php

$JSON_STRING_ARRAY = array();

$signal_1 = array(
    'signal' => "BATCH_MC_MODE",
    'type' => "D",
    'I/O' => "I",
    'range' => "0..1",
    'description' => "Start batch in MC_MODE ",
);

array_push($JSON_STRING_ARRAY, json_encode($signal_1));
//========================================

$signal_2 = array(
    'signal' => "CONTROL_START",
    'type' => "D",
    'I/O' => "I",
    'range' => "0..1",
    'description' => "Control Start (Steuerung Start)",
);

array_push($JSON_STRING_ARRAY, json_encode($signal_2));
//========================================

$signal_3 = array(
    'signal' => "PLC_CONTROL",
    'type' => "D",
    'I/O' => "I",
    'range' => "0..1",
    'description' => "BCS CONTROL (PLC Steuerung)",
);

array_push($JSON_STRING_ARRAY, json_encode($signal_3));
//========================================

$signal_4 = array(
    'signal' => "MC_CONTROL",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "MixCont CONTROL (Mixcont Steuerung)",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_4));
//========================================

$signal_5 = array(
    'signal' => "BCS_POSITION",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..99",
    'description' => "BCS Anzeiger der Schritte",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_5));
//========================================

$signal_6 = array(
    'signal' => "MC_POSITION",
    'type' => "A",
    'I/O' => "O",
    'range' => "0..99",
    'description' => "MC Anzeiger der Schritte",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_6));
//========================================

$signal_7 = array(
    'signal' => "MC_READY",
    'type' => "A",
    'I/O' => "O",
    'range' => "0..2",
    'description' => "MC Bereitschaft Anzeiger",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_7));
//========================================

$signal_8 = array(
    'signal' => "BCS_WATCHDOG",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..1000",
    'description' => "BCS_WATCHDOG",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_8));
//========================================

$signal_9 = array(
    'signal' => "MC_WATCHDOG",
    'type' => "A",
    'I/O' => "O",
    'range' => "0..1000",
    'description' => "MC_WATCHDOG",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_9));
//========================================

$signal_10 = array(
    'signal' => "INTERRUPT",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "MixCont Interrupts MixCont Control, (MixCont Unterbricht MixCont Steuerung)",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_10));
//========================================

$signal_11 = array(
    'signal' => "TOTAL_ADDING",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Total loading phase schows material in progress. (Gesamte Ergänzung-Phase)",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_11));
//========================================
//========================================
//========================================
//========================================
//========================================
$signal_12 = array(
    'signal' => "DISCHARGE",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Discharging step (Auswurf Schritt)",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_12));
//========================================

$signal_13 = array(
    'signal' => "RAM_IS_UP",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "RAM is in UPPER position",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_13));
//========================================

$signal_14 = array(
    'signal' => "RAM_IS_DOWN",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Ram is in Bottom position",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_14));
//========================================

$signal_15 = array(
    'signal' => "POWER",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..650",
    'description' => "Power (Leistung) Signal for the current moment",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_15));
//========================================

$signal_16 = array(
    'signal' => "CURRENT",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..2000",
    'description' => "Current (Strom)",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_16));
//========================================
$signal_17 = array(
    'signal' => "TEMP_1",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..250",
    'description' => "Left chamber side temp",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_17));
//========================================

$signal_18 = array(
    'signal' => "TEMP_2",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..250",
    'description' => "Right chamber side temp",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_18));
//========================================

$signal_19 = array(
    'signal' => "TEMP_3",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..200",
    'description' => "Act. Discharge door temp",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_19));
//========================================

$signal_20 = array(
    'signal' => "SPEED",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..1200",
    'description' => "Rotor Speed",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_20));
//========================================

$signal_21 = array(
    'signal' => "RAM",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..1500",
    'description' => "Ram(Stempel) actual position",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_21));
//========================================

$signal_22 = array(
    'signal' => "PRESSURE",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..7",
    'description' => "Ram Pressure",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_22));
//========================================
//========================================
//========================================
//========================================

$signal_23 = array(
    'signal' => "SET_SPEED",
    'type' => "A",
    'I/O' => "O",
    'range' => "0..60",
    'description' => "MixCont Current  Speed Setting",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_23));
//========================================

$signal_24 = array(
    'signal' => "DOOR_OPEN",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "Set materials Door Open",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_24));
//========================================

$signal_25 = array(
    'signal' => "DOOR_CLOSE",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "Set material Door Close",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_25));
//========================================

$signal_26 = array(
    'signal' => "RAM_UP",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "MixCont sets Ram Up",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_26));
//========================================

$signal_27 = array(
    'signal' => "RAM_DOWN",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "MixCont sets Ram down",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_27));
//========================================

$signal_28 = array(
    'signal' => "SET_PRESSURE",
    'type' => "A",
    'I/O' => "O",
    'range' => "",
    'description' => "MixCont sets Pressure value",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_28));
//========================================

$signal_29 = array(
    'signal' => "TIME_BATCH_END",
    'type' => "D",
    'I/O' => "O",
    'range' => "",
    'description' => "MixCont sets Pressure value",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_29));
//========================================
//========================================
//========================================
//========================================

$signal_30 = array(
    'signal' => "RECIPE_ID",
    'type' => "S",
    'I/O' => "I",
    'range' => "",
    'description' => "Recipe identifier",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_30));
//========================================

$signal_31 = array(
    'signal' => "STEP",
    'type' => "S",
    'I/O' => "I",
    'range' => "",
    'description' => "",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_31));
//========================================

$signal_32 = array(
    'signal' => "ALTERNATIVE",
    'type' => "S",
    'I/O' => "I",
    'range' => "",
    'description' => "",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_32));
//========================================

$signal_33 = array(
    'signal' => "ORDER_ID",
    'type' => "S",
    'I/O' => "I",
    'range' => "",
    'description' => "",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_33));
//========================================

$signal_34 = array(
    'signal' => "BATCH_NR",
    'type' => "A",
    'I/O' => "I",
    'range' => "0..999",
    'description' => "Batch number",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_34));
//========================================
//========================================
//========================================
//========================================

$signal_35 = array(
    'signal' => "ALARM",
    'type' => "D",
    'I/O' => "O",
    'range' => "0..999",
    'description' => "Alarm from MixCont",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_35));
//========================================

$signal_36 = array(
    'signal' => "ALARM_ID_MC",
    'type' => "A",
    'I/O' => "O",
    'range' => "0..20",
    'description' => "Alarm Idetifier Mixcont",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_36));
//========================================

$signal_37 = array(
    'signal' => "ALARM_TEXT_MC",
    'type' => "S",
    'I/O' => "O",
    'range' => "",
    'description' => "Alarm Text from MixCont",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_37));
//========================================

$signal_38 = array(
    'signal' => "ALARM_ID_BCS",
    'type' => "A",
    'I/O' => "I",
    'range' => "",
    'description' => "Alarm identifier  from BCS",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_38));
//========================================
//========================================
//========================================
//========================================

$signal_39 = array(
    'signal' => "OIL",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Adding oil",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_39));
//========================================

$signal_40 = array(
    'signal' => "RCL",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Ram cleaning",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_40));
//========================================

$signal_41 = array(
    'signal' => "CARBON",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Adding carbon",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_41));
//========================================

$signal_42 = array(
    'signal' => "FILLERS",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Adding fillers",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_42));
//========================================

$signal_43 = array(
    'signal' => "SMALL_CHEM",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Adding small chemicals",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_43));
//========================================

$signal_44 = array(
    'signal' => "RUBBER",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Addin Rubber and other stff from conveyer",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_44));
//========================================

$signal_45 = array(
    'signal' => "MATERIAL_DOOR",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_45));
//========================================

$signal_46 = array(
    'signal' => "MOTOR",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_46));
//========================================

$signal_47 = array(
    'signal' => "SMALL_CHEM_AUTO",
    'type' => "D",
    'I/O' => "I",
    'range' => "",
    'description' => "Small chemicals automatic",
);
array_push($JSON_STRING_ARRAY, json_encode($signal_47));
//========================================


json_write_array_with_json_encoded_strings_to_file($JSON_STRING_ARRAY, "json_text.txt");

//
//
//
//
//
//
function json_write_array_with_json_encoded_strings_to_file($array, $file_path) {
    $to_record = "";
    //
    foreach ($array as $encoded_json_string) {
        //
        //Building the string to be recorded to file
        $to_record .= $encoded_json_string . "\n";
    }
    //Write to file
    file_put_contents($file_path, $to_record);
}

?>
