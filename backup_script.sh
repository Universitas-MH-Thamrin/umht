#!/bin/bash
# ========================================
# Script Harian Backup MySQL & Lampiran
# ========================================

# ===== Variabel Utama =====
DATE=$(date +"%Y-%m-%d_%H-%M")
BACKUP_DIR="$(pwd)/backup"                        # Lokasi backup
DB_USER="webuser"                                 # User database
DB_PASS="webpassword2024#"                        # Password database
DB_NAME="thamrin1_web2025"                        # Nama database
FILES_DIR="$(pwd)/storage"                        # Folder lampiran Laravel
ENV_FILE="$(pwd)/.env"                            # File konfigurasi Laravel

# ===== Persiapan Folder =====
mkdir -p $BACKUP_DIR

# ===== Backup Database =====
echo "[INFO] Backup database $DB_NAME..."
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > "$BACKUP_DIR/db_$DATE.sql"
if [ $? -eq 0 ]; then
    echo "[OK] Database berhasil di-backup"
else
    echo "[ERROR] Gagal backup database!"
    exit 1
fi

# ===== Backup File Upload & ENV =====
echo "[INFO] Backup lampiran & .env..."
tar -czf "$BACKUP_DIR/files_$DATE.tar.gz" $FILES_DIR $ENV_FILE
if [ $? -eq 0 ]; then
    echo "[OK] Lampiran berhasil di-backup"
else
    echo "[ERROR] Gagal backup lampiran!"
    exit 1
fi

# ===== Satukan Semua Backup dalam Satu Arsip =====
echo "[INFO] Membuat tarball akhir..."
tar -czf "$BACKUP_DIR/backup_$DATE.tar.gz" -C $BACKUP_DIR db_$DATE.sql files_$DATE.tar.gz

# Hapus file sementara
rm -f "$BACKUP_DIR/db_$DATE.sql" "$BACKUP_DIR/files_$DATE.tar.gz"

# ===== Bersihkan Backup Lama (>7 Hari) =====
find $BACKUP_DIR -type f -mtime +7 -name "backup_*.tar.gz" -exec rm {} \;

echo "[DONE] Backup selesai pada $DATE"
echo "File tersimpan di: $BACKUP_DIR/backup_$DATE.tar.gz"
