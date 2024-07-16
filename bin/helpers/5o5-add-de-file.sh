#!/usr/bin/env bash

if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi

file=${1}
#
# add
#
echo git add ${file}
git add ${file}
echo
#
# convert
#
echo 5o5-3wadmin-de.php ${file}
5o5-3wadmin-de.php ${file}
echo
#
# import
#
echo ./bin/import.php e ${file}
./bin/import.php e ${file}
echo

