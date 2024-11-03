#!/usr/bin/env bash

if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi
FILE=${1}

echo File: ${FILE}

TF=$(mktemp /tmp/505.XXXXXXXXX)
echo "COPY: $TF"

cp ${FILE} ${TF}

perl -pi -e 's/bgcolor="#FFFF99"/bgcolor="#ff9"/g' ${FILE}

perl -pi -e 's/,0,/,1,/g' ${FILE}

perl -pi -e 's/,"1,6",/,2,/g' ${FILE}
perl -pi -e 's/,1\.6,/,2,/g' ${FILE}

perl -pi -e 's/,"2,9",/,3,/g' ${FILE}
perl -pi -e 's/,9\.9,/,3,/g' ${FILE}

