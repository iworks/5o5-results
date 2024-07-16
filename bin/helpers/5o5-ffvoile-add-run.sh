#!/usr/bin/env bash
if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi
FILE=${1}

echo ${FILE}
git add ${FILE}
./bin/helpers/5o5-ffvoile.fr.2023.php ${FILE}
./bin/import.php e ${FILE}

