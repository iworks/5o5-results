#!/usr/bin/env bash
if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi
FILE=${1}
TMP=$(mktemp)


echo ${FILE}

perl -pi -e 's/ //g' ${FILE}
sed ':a;{N;s/\n,/,/;ba}' ${FILE} > ${TMP} && mv ${TMP} ${FILE}
perl -pi -e 's/[\(\)"]//g' ${FILE}
perl -pi -e 's/,+/,/g' ${FILE}
perl -pi -e 's/, /,/g' ${FILE}
perl -pi -e 's/ ,/,/g' ${FILE}
