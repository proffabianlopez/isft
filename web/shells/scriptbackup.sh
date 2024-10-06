#!/bin/bash

export PATH=/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/usr/local/sbin

# Navegar a la ubicación del script
cd "$(dirname "${BASH_SOURCE[0]}")"
source ../../.env

# Generar el archivo de respaldo con timestamp
TIMESTAMP=$(date +"%Y-%m-%d_%H:%M:%S")
BACKUP_FILE="$BACKUP_DIR/isft_$DB_NAME_isft177_$TIMESTAMP.sql"

/usr/bin/docker exec $CONTAINER_NAME mysqldump --no-tablespaces -u $MYSQL_USER -p"$MYSQL_PASSWORD" $DB_NAME_isft177 | sed 's/\t/-/g' > "$BACKUP_FILE"

# Comprimir el archivo
gzip "$BACKUP_FILE"

# Enviar el archivo comprimido a los servidores remotos
IFS=',' read -ra REMOTE_SERVERS_ARRAY <<< "$REMOTE_SERVERS"

for SERVER in "${REMOTE_SERVERS_ARRAY[@]}"
do
    IFS=':' read -r USER_SERVER REMOTE_PATH <<< "$SERVER"
    USER=$(echo "$USER_SERVER" | cut -d@ -f1)
    SERVER=$(echo "$USER_SERVER" | cut -d@ -f2)

    # Transferir el archivo .gz al servidor remoto
    /usr/bin/scp -o StrictHostKeyChecking=no -i "$SSH_PRIVATE_KEY" "$BACKUP_FILE.gz" "$USER@$SERVER:$REMOTE_PATH"

    if [ $? -eq 0 ]; then
        echo "$(date +"%Y-%m-%d %H:%M:%S"): Archivo transferido con éxito a $SERVER"

        # Eliminar backups más antiguos de 28 días en el servidor remoto, usando basename
        /usr/bin/ssh -o StrictHostKeyChecking=no -i "$SSH_PRIVATE_KEY" "$USER@$SERVER" "
        for file in \$(ls $REMOTE_PATH/isft_*.gz); do
            FILE_DATE=\$(echo \"\$file\" | grep -oP '\d{4}-\d{2}-\d{2}' | head -1)
            FILE_TIMESTAMP=\$(date -d \"\$FILE_DATE\" +%s)
            CURRENT_TIMESTAMP=\$(date +%s)
            AGE=\$(( (CURRENT_TIMESTAMP - FILE_TIMESTAMP) / (60*60*24) ))
            if [ \$AGE -gt 28 ]; then
                BASENAME_FILE=\$(basename \"\$file\")
                rm -f \"\$file\"
                echo \"$(date +"%Y-%m-%d %H:%M:%S"): \$BASENAME_FILE eliminado en el servidor $SERVER.\"
            fi
        done"
    else
        echo "$(date +"%Y-%m-%d %H:%M:%S"): Error al transferir archivo a $SERVER. Código de salida: $?"
    fi
done

# Eliminar backups más antiguos de 28 días localmente, mostrando solo el nombre del archivo
if compgen -G "$BACKUP_DIR/isft_*.gz" > /dev/null; then
    for file in "$BACKUP_DIR"/isft_*.gz; do
        FILE_DATE=$(echo "$file" | grep -oP "\d{4}-\d{2}-\d{2}" | head -1)
        FILE_TIMESTAMP=$(date -d "$FILE_DATE" +%s)
        CURRENT_TIMESTAMP=$(date +%s)
        AGE=$(( (CURRENT_TIMESTAMP - FILE_TIMESTAMP) / (60*60*24) ))
        if [ $AGE -gt 28 ]; then
            rm -f "$file"
            echo "$(date +"%Y-%m-%d %H:%M:%S"): $(basename "$file") eliminado localmente"
        fi
    done
else
    echo "No se encontraron archivos para eliminar localmente."
fi
