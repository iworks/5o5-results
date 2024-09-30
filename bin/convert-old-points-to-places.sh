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
perl -pi -e 's/,3,/,2,/g' ${FILE}
perl -pi -e 's/,5\.7,/,3,/g' ${FILE}
perl -pi -e 's/,8,/,4,/g' ${FILE}
perl -pi -e 's/,10,/,5,/g' ${FILE}
perl -pi -e 's/,11\.7,/,6,/g' ${FILE}
perl -pi -e 's/,13,/,7,/g' ${FILE}
perl -pi -e 's/,14,/,8,/g' ${FILE}
perl -pi -e 's/,15,/,9,/g' ${FILE}
perl -pi -e 's/,16,/,10,/g' ${FILE}
perl -pi -e 's/,17,/,11,/g' ${FILE}
perl -pi -e 's/,18,/,12,/g' ${FILE}
perl -pi -e 's/,19,/,13,/g' ${FILE}
perl -pi -e 's/,20,/,14,/g' ${FILE}
perl -pi -e 's/,21,/,15,/g' ${FILE}
perl -pi -e 's/,22,/,16,/g' ${FILE}
perl -pi -e 's/,23,/,17,/g' ${FILE}
perl -pi -e 's/,24,/,18,/g' ${FILE}
perl -pi -e 's/,25,/,19,/g' ${FILE}
perl -pi -e 's/,26,/,20,/g' ${FILE}
perl -pi -e 's/,27,/,21,/g' ${FILE}
perl -pi -e 's/,28,/,22,/g' ${FILE}
perl -pi -e 's/,29,/,23,/g' ${FILE}
perl -pi -e 's/,30,/,24,/g' ${FILE}
perl -pi -e 's/,31,/,25,/g' ${FILE}
perl -pi -e 's/,32,/,26,/g' ${FILE}
perl -pi -e 's/,33,/,27,/g' ${FILE}
perl -pi -e 's/,34,/,28,/g' ${FILE}
perl -pi -e 's/,35,/,29,/g' ${FILE}
perl -pi -e 's/,36,/,30,/g' ${FILE}
perl -pi -e 's/,37,/,31,/g' ${FILE}
perl -pi -e 's/,38,/,32,/g' ${FILE}
perl -pi -e 's/,39,/,33,/g' ${FILE}
perl -pi -e 's/,40,/,34,/g' ${FILE}
perl -pi -e 's/,41,/,35,/g' ${FILE}
perl -pi -e 's/,42,/,36,/g' ${FILE}
perl -pi -e 's/,43,/,37,/g' ${FILE}
perl -pi -e 's/,44,/,38,/g' ${FILE}
perl -pi -e 's/,45,/,39,/g' ${FILE}
perl -pi -e 's/,46,/,40,/g' ${FILE}
perl -pi -e 's/,47,/,41,/g' ${FILE}
perl -pi -e 's/,48,/,42,/g' ${FILE}
perl -pi -e 's/,49,/,43,/g' ${FILE}
perl -pi -e 's/,50,/,44,/g' ${FILE}
perl -pi -e 's/,51,/,45,/g' ${FILE}
perl -pi -e 's/,52,/,46,/g' ${FILE}
perl -pi -e 's/,53,/,47,/g' ${FILE}
perl -pi -e 's/,54,/,48,/g' ${FILE}
perl -pi -e 's/,55,/,49,/g' ${FILE}
perl -pi -e 's/,56,/,50,/g' ${FILE}
perl -pi -e 's/,57,/,51,/g' ${FILE}
perl -pi -e 's/,58,/,52,/g' ${FILE}
perl -pi -e 's/,59,/,53,/g' ${FILE}
perl -pi -e 's/,60,/,54,/g' ${FILE}
perl -pi -e 's/,61,/,55,/g' ${FILE}
perl -pi -e 's/,62,/,56,/g' ${FILE}
perl -pi -e 's/,63,/,57,/g' ${FILE}
perl -pi -e 's/,64,/,58,/g' ${FILE}
perl -pi -e 's/,65,/,59,/g' ${FILE}
perl -pi -e 's/,66,/,60,/g' ${FILE}
perl -pi -e 's/,67,/,61,/g' ${FILE}
perl -pi -e 's/,68,/,62,/g' ${FILE}
perl -pi -e 's/,69,/,63,/g' ${FILE}
perl -pi -e 's/,70,/,64,/g' ${FILE}
perl -pi -e 's/,71,/,65,/g' ${FILE}
perl -pi -e 's/,72,/,66,/g' ${FILE}
perl -pi -e 's/,73,/,67,/g' ${FILE}
perl -pi -e 's/,74,/,68,/g' ${FILE}
perl -pi -e 's/,75,/,69,/g' ${FILE}
perl -pi -e 's/,76,/,70,/g' ${FILE}
perl -pi -e 's/,77,/,71,/g' ${FILE}
perl -pi -e 's/,78,/,72,/g' ${FILE}
perl -pi -e 's/,79,/,73,/g' ${FILE}
perl -pi -e 's/,80,/,74,/g' ${FILE}
perl -pi -e 's/,81,/,75,/g' ${FILE}
perl -pi -e 's/,82,/,76,/g' ${FILE}
perl -pi -e 's/,83,/,77,/g' ${FILE}
perl -pi -e 's/,84,/,78,/g' ${FILE}
perl -pi -e 's/,85,/,79,/g' ${FILE}
perl -pi -e 's/,86,/,80,/g' ${FILE}
perl -pi -e 's/,87,/,81,/g' ${FILE}
perl -pi -e 's/,88,/,82,/g' ${FILE}
perl -pi -e 's/,89,/,83,/g' ${FILE}


perl -pi -e 's/,0,/,1,/g' ${FILE}
perl -pi -e 's/,3,/,2,/g' ${FILE}
perl -pi -e 's/,5\.7,/,3,/g' ${FILE}
perl -pi -e 's/,8,/,4,/g' ${FILE}
perl -pi -e 's/,10,/,5,/g' ${FILE}
perl -pi -e 's/,11\.7,/,6,/g' ${FILE}
perl -pi -e 's/,13,/,7,/g' ${FILE}
perl -pi -e 's/,14,/,8,/g' ${FILE}
perl -pi -e 's/,15,/,9,/g' ${FILE}
perl -pi -e 's/,16,/,10,/g' ${FILE}
perl -pi -e 's/,17,/,11,/g' ${FILE}
perl -pi -e 's/,18,/,12,/g' ${FILE}
perl -pi -e 's/,19,/,13,/g' ${FILE}
perl -pi -e 's/,20,/,14,/g' ${FILE}
perl -pi -e 's/,21,/,15,/g' ${FILE}
perl -pi -e 's/,22,/,16,/g' ${FILE}
perl -pi -e 's/,23,/,17,/g' ${FILE}
perl -pi -e 's/,24,/,18,/g' ${FILE}
perl -pi -e 's/,25,/,19,/g' ${FILE}
perl -pi -e 's/,26,/,20,/g' ${FILE}
perl -pi -e 's/,27,/,21,/g' ${FILE}
perl -pi -e 's/,28,/,22,/g' ${FILE}
perl -pi -e 's/,29,/,23,/g' ${FILE}
perl -pi -e 's/,30,/,24,/g' ${FILE}
perl -pi -e 's/,31,/,25,/g' ${FILE}
perl -pi -e 's/,32,/,26,/g' ${FILE}
perl -pi -e 's/,33,/,27,/g' ${FILE}
perl -pi -e 's/,34,/,28,/g' ${FILE}
perl -pi -e 's/,35,/,29,/g' ${FILE}
perl -pi -e 's/,36,/,30,/g' ${FILE}
perl -pi -e 's/,37,/,31,/g' ${FILE}
perl -pi -e 's/,38,/,32,/g' ${FILE}
perl -pi -e 's/,39,/,33,/g' ${FILE}
perl -pi -e 's/,40,/,34,/g' ${FILE}
perl -pi -e 's/,41,/,35,/g' ${FILE}
perl -pi -e 's/,42,/,36,/g' ${FILE}
perl -pi -e 's/,43,/,37,/g' ${FILE}
perl -pi -e 's/,44,/,38,/g' ${FILE}
perl -pi -e 's/,45,/,39,/g' ${FILE}
perl -pi -e 's/,46,/,40,/g' ${FILE}
perl -pi -e 's/,47,/,41,/g' ${FILE}
perl -pi -e 's/,48,/,42,/g' ${FILE}
perl -pi -e 's/,49,/,43,/g' ${FILE}
perl -pi -e 's/,50,/,44,/g' ${FILE}
perl -pi -e 's/,51,/,45,/g' ${FILE}
perl -pi -e 's/,52,/,46,/g' ${FILE}
perl -pi -e 's/,53,/,47,/g' ${FILE}
perl -pi -e 's/,54,/,48,/g' ${FILE}
perl -pi -e 's/,55,/,49,/g' ${FILE}
perl -pi -e 's/,56,/,50,/g' ${FILE}
perl -pi -e 's/,57,/,51,/g' ${FILE}
perl -pi -e 's/,58,/,52,/g' ${FILE}
perl -pi -e 's/,59,/,53,/g' ${FILE}
perl -pi -e 's/,60,/,54,/g' ${FILE}
perl -pi -e 's/,61,/,55,/g' ${FILE}
perl -pi -e 's/,62,/,56,/g' ${FILE}
perl -pi -e 's/,63,/,57,/g' ${FILE}
perl -pi -e 's/,64,/,58,/g' ${FILE}
perl -pi -e 's/,65,/,59,/g' ${FILE}
perl -pi -e 's/,66,/,60,/g' ${FILE}
perl -pi -e 's/,67,/,61,/g' ${FILE}
perl -pi -e 's/,68,/,62,/g' ${FILE}
perl -pi -e 's/,69,/,63,/g' ${FILE}
perl -pi -e 's/,70,/,64,/g' ${FILE}
perl -pi -e 's/,71,/,65,/g' ${FILE}
perl -pi -e 's/,72,/,66,/g' ${FILE}
perl -pi -e 's/,73,/,67,/g' ${FILE}
perl -pi -e 's/,74,/,68,/g' ${FILE}
perl -pi -e 's/,75,/,69,/g' ${FILE}
perl -pi -e 's/,76,/,70,/g' ${FILE}
perl -pi -e 's/,77,/,71,/g' ${FILE}
perl -pi -e 's/,78,/,72,/g' ${FILE}
perl -pi -e 's/,79,/,73,/g' ${FILE}
perl -pi -e 's/,80,/,74,/g' ${FILE}
perl -pi -e 's/,81,/,75,/g' ${FILE}
perl -pi -e 's/,82,/,76,/g' ${FILE}
perl -pi -e 's/,83,/,77,/g' ${FILE}
perl -pi -e 's/,84,/,78,/g' ${FILE}
perl -pi -e 's/,85,/,79,/g' ${FILE}
perl -pi -e 's/,86,/,80,/g' ${FILE}
perl -pi -e 's/,87,/,81,/g' ${FILE}
perl -pi -e 's/,88,/,82,/g' ${FILE}
perl -pi -e 's/,89,/,83,/g' ${FILE}
