#!/bin/bash
set -e

# Pindah ke directory project
cd /var/www/html

echo "======================================================"
echo "⏳ Waiting for MySQL database connection..."
echo "======================================================"

# Menunggu koneksi database berhasil terhubung melalui CLI Spark CodeIgniter
# Perintah php spark migrate akan gagal konek jika DB belum siap.
# Kami mencobanya setiap 3 detik sampai berhasil.
until php spark migrate --no-header &> /dev/null; do
    echo "⚠️ Database/MySQL is not ready yet. Waiting 3 seconds..."
    sleep 3
done

echo "======================================================"
echo "✅ Database is connected! Running migrations..."
echo "======================================================"
php spark migrate

echo "======================================================"
echo "🌱 Seeding initial database data (MainSeeder)..."
echo "======================================================"
php spark db:seed MainSeeder

echo "======================================================"
echo "🚀 Application is fully ready and configured!"
echo "======================================================"

# Jalankan perintah utama kontainer (apache2-foreground)
exec "$@"
