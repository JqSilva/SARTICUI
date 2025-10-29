<?php
$hash = '$2y$10$GvYV4V1RH7MSc42V0zKqlepgZgCypHOhC3zrx8z0KTXDPI3O88E/O';

if (password_verify('1234', $hash)) {
    echo "✅ Coincide\n";
} else {
    echo "❌ No coincide\n";
}