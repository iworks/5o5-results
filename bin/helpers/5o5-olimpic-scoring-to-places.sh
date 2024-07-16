#!/usr/bin/env bash

if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi
FILE=${1}

echo ${FILE}

sed -i "s/,0.00/,1/g" ${FILE}
sed -i "s/,3.00/,2/g" ${FILE}
sed -i "s/,5.70/,3/g" ${FILE}
sed -i "s/,8.00/,4/g" ${FILE}
sed -i "s/,10.00/,5/g" ${FILE}
sed -i "s/,11.70/,6/g" ${FILE}

for i in $(seq 12 200)
do
    sed -i "s/,$i.00/,`expr $i - 6`/g" ${FILE}
done
