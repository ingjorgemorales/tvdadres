<?php

function find_directives_in_text($text) {
    $directives = [];
    $len = strlen($text);
    $i = 0;
    while ($i < $len) {
        if ($text[$i] === '@') {
            $j = $i + 1;
            while ($j < $len && preg_match('/[A-Za-z0-9_]/', $text[$j])) {
                $j++;
            }
            if ($j > $i + 1 && $j < $len && $text[$j] === '(') {
                $name = substr($text, $i + 1, $j - $i - 1);
                $start = $j;
                $depth = 1;
                $k = $j + 1;
                $inQuote = false;
                $quoteChar = null;
                while ($k < $len && $depth > 0) {
                    $char = $text[$k];
                    if ($inQuote) {
                        if ($char === $quoteChar) {
                            $inQuote = false;
                        } elseif ($char === "\\") {
                            $k++;
                        }
                    } else {
                        if ($char === '"' || $char === "'") {
                            $inQuote = true;
                            $quoteChar = $char;
                        } elseif ($char === '(') {
                            $depth++;
                        } elseif ($char === ')') {
                            $depth--;
                        }
                    }
                    $k++;
                }
                $expr = substr($text, $start + 1, $k - $start - 2);
                $directives[] = [$name, $expr, $i];
                $i = $k;
                continue;
            }
        }
        $i++;
    }
    return $directives;
}

function line_number_at_offset($text, $offset) {
    return substr_count(substr($text, 0, $offset), "\n") + 1;
}

$root = getcwd();
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
foreach ($it as $file) {
    if (! $file->isFile()) {
        continue;
    }
    if (! preg_match('/\.blade\.php$/', $file->getFilename())) {
        continue;
    }
    $text = file_get_contents($file->getPathname());
    $directives = find_directives_in_text($text);
    foreach ($directives as [$name, $expression, $offset]) {
        try {
            token_get_all("<?php " . $expression, 0);
        } catch (ParseError $e) {
            $line = line_number_at_offset($text, $offset);
            echo $file->getPathname() . ':' . $line . ': @' . $name . '(' . substr($expression, 0, 80) . "...\n";
        }
    }
}
