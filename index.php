<?php
echo "<link rel='stylesheet' href='style.css'>";
$countries = [
    [
        "name" => "France",
        "capital" => "Paris",
        "area" => 640679,
        "population" => [
            "2000" => 59278000,
            "2010" => 59278000,
        ],
    ],
    [
        "name" => "England",
        "capital" => "London",
        "area" => 130395,
        "population" => [
            "2000" => 58800000,
            "2010" => 63200000,
        ],
    ],
    [
        "name" => "Deutschland",
        "capital" => "Berlin",
        "area" => 357021,
        "population" => [
            "2000" => 82260000,
            "2010" => 81752000,
        ],
    ],
];
for ($i = 0; $i < count($countries); $i++) {
    $countries[$i]['population']["average"] = ($countries[$i]["population"]["2000"] + $countries[$i]["population"]["2010"]) / 2;
}

//echo "{$countries[0]['name']} : {$countries[0]['population']['2010']}\n";

function cmp_capital($a, $b)
{
    return ($a["name"] <=> $b["capital"]);
}

function cmp_area($a, $b)
{
    return ($a["area"] <=> $b["area"]);
}

function cmp_name($a, $b)
{
    return ($a["name"] <=> $b["name"]);
}

function cmp2($a, $b)
{
    return ($a['population']["average"] <=> $b['population']["average"]);
}

function try_walk($country, $key_country, $data)
{
    static $i = 1; // Статична глобальна змінна-лічильник
    echo "<tr><td>$data  $i </td>";
    foreach ($country as $key => $value) {
        if (!is_array($value)) {
            echo "<td>$value</td>";
        } else {
            echo "<td>";
            foreach ($value as $k => $v) {
                if ($k != "average") {
                    echo "[{$k} рік. - $v млн]";
                } else {
                    echo " Середнє арифметичне кількості населення з 2000 по 2010 роки: $v млн] </td></tr>";
                }
            }
        }
    }
    echo "\n";
    $i++;
}

echo "<table>";

function setTable($countries)
{
    echo "<tr><th>№</th><th>Назва</th><th>Столиця</th><th>Площа</th><th>Населення</th></tr>";
    array_walk($countries, "try_walk", "№");
}

uasort($countries, "cmp_capital");
setTable($countries);

uasort($countries, "cmp_name");
setTable($countries);

uasort($countries, "cmp_area");
setTable($countries);

uasort($countries, "cmp2");
setTable($countries);

echo "</table>";
