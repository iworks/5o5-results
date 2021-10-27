#!/usr/bin/env bash

if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi
FILE=${1}

echo ${FILE}

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
