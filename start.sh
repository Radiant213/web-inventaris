#!/bin/bash

# Jalankan auto-migrate untuk bikin tabel ke Supabase setiap kali deploy
php artisan migrate --force

# Start Apache
apache2-foreground
