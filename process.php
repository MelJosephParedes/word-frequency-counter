<?php
// the text and sortOrder taking the input of the user using POST method
$text = $_POST["text"];
$sortOrder = $_POST["sort"];
// create function with parameter text and sortOrder set to "asc"
// implement a sort whether ascending or descending
function wordFrequency($text, $sortOrder = "asc"){
    // declaring common stop words and declaring array for obtaining the word and their count
    $stoppingWords = ["its", "an", "the", "for", "that", "is", "of", "and", "a", "it" , "or"];
    $words = str_word_count($text, 1);
    $wordCalcFrequency = [];
    foreach ($words as $word){
        $word = strtolower($word);
        if(!in_array($word, $stoppingWords)){
            if(isset($wordCalcFrequency[$word])){
                $wordCalcFrequency[$word]++;
            } else {
                $wordCalcFrequency[$word] = 1;
            }
        }
    }
    // implement a sort whether ascending or descending
    if ($sortOrder === "asc"){
        asort($wordCalcFrequency);
    } else {
        arsort($wordCalcFrequency);
    }

    return $wordCalcFrequency;
}

$wordFrequency = wordFrequency($text, $sortOrder);

?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        //Creating a table for output
        echo "<table class='big-table' align='center' border='1' style='font-size:24px'>
        <tr>
        <th>Word</th>
        <th>Count</th>
        </tr>";
        //Creating a counter for the number of words to display which is depends on the user input
        $counter = 0;
        $limit = $_POST["limit"];
        foreach ($wordFrequency as $word => $frequency){
            echo "<tr>";
            echo "<td>" .$word."</td>";
            echo "<td>".$frequency."</td>";
            echo "</tr>";
            $counter++;
            if ($counter >= $limit){
                break;
            }
        }
        echo "</table>";
    ?>

</body>
</html>