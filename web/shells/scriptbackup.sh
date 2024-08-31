#!/bin/bash

export PATH=/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/usr/local/sbin

cd "$(dirname "${BASH_SOURCE[0]}")"
source ../../.env

TIMESTAMP=$(date +"%Y-%m-%d_%H:%M:%S")
BACKUP_FILE="$BACKUP_DIR/$DB_NAME_isft177$TIMESTAMP.sql"

/usr/bin/docker exec $CONTAINER_NAME mysqldump -u $MYSQL_USER -p"$MYSQL_ROOT_PASSWORD" $DB_NAME_isft177 | sed 's/\t/-/g' > $BACKUP_FILE

gzip $BACKUP_FILE

IFS=',' read -ra REMOTE_SERVERS_ARRAY <<< "$REMOTE_SERVERS"

for SERVER in "${REMOTE_SERVERS_ARRAY[@]}"
do
    IFS=':' read -r USER_SERVER REMOTE_PATH <<< "$SERVER"
    USER=$(echo "$USER_SERVER" | cut -d@ -f1)
    SERVER=$(echo "$USER_SERVER" | cut -d@ -f2)

   /usr/bin/scp -o StrictHostKeyChecking=no -i "$SSH_PRIVATE_KEY" "$BACKUP_FILE.gz" "$USER@$SERVER:$REMOTE_PATH"

    if [ $? -eq 0 ]; then
        echo "$(date +"%Y-%m-%d %H:%M:%S"): Archivo transferido con éxito a $SERVER"
    else
        echo "$(date +"%Y-%m-%d %H:%M:%S"): Error al transferir archivo a $SERVER. Código de salida: $?"
    fi
done
