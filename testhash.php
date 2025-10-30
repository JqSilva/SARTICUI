<?php
$hash = '$2y$10$zt8T.PbBXRrYMFBG9gMTpeAYIzVAjHME3OOgIeB3MH3VtZze0A78S';

if (password_verify('1234', $hash)) {
    echo "✅ Coincide\n";
} else {
    echo "❌ No coincide\n";
}