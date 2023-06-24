<?php
function formatPercentValues($inputString) {
    // Regular expression pattern to match percent values
    $pattern = '/([+-]\d+\.\d+%)/';

    // Replace the percent values with formatted HTML
    $formattedString = preg_replace_callback($pattern, function($matches) {
        $value = $matches[1];

        // Check if the value has a plus or minus sign
        if (strpos($value, '+') !== false) {
            // Value has a plus sign, color it green
            return '<span class="positive">' . $value . '</span>';
        } elseif (strpos($value, '-') !== false) {
            // Value has a minus sign, color it red
            return '<span class="negative">' . $value . '</span>';
        } else {
            // No sign found, return the original value
            return $value;
        }
    }, $inputString);

    return $formattedString;
}
function getStockData($html) {
    $table_start = strpos($html, '<table class="report-table"');
    $pruned_header = substr($html, $table_start, null);
    $table_end = strpos($pruned_header, '</table>');
    $pruned_footer = substr($pruned_header, 0, $table_end);
    $pruned_links = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $pruned_footer);
    $pruned_tables = str_replace('<td></td>',"",$pruned_links);
    $pruned_tables = str_replace('<td class="ch"></td>',"",$pruned_tables);

    # Prune empty header
    $empty_header_class = strpos($pruned_tables, '<th class="thchart">');
    $pruned_header = substr($pruned_tables, 0, $empty_header_class) . substr($pruned_tables, $empty_header_class + 50);
    
    # Format percent values
    $formatted_values = formatPercentValues($pruned_header);
    
    return $formatted_values;}
?>
