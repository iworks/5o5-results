#!/bin/sh
if [ $# -ne 1 ]; then
	echo "Usage: $0 file"
	exit 1
fi
FILE=${1}

echo ${FILE}

perl -pi -e 's/&nbsp;/ /g' ${FILE}
perl -pi -e 's/></>\n</g' ${FILE}
perl -pi -e 's/\.0+//g' ${FILE}
perl -pi -e 's/<\/?(font|span)[^>]*>//gi' ${FILE}
perl -pi -e 's/<\/?(i|b|p)>//gi' ${FILE}
perl -pi -e 's/ (bgcolor|style|border|cellpadding|cellspacing|v?align)="[^"]+"/ /gi' ${FILE}
perl -pi -e 's/ (bgcolor|style|border|cellpadding|cellspacing|v?align)=[^ ^>]+/ /gi' ${FILE}


perl -pi -e 's/[\t\r\n]//g' ${FILE}

perl -pi -e 's/\<tr[^>]*\>/\n/gi' ${FILE}
perl -pi -e 's/\<a[^>]*\>//gi' ${FILE}

# perl -pi -e 's/,(DNC|DNS|DNF|DSQ|OCS|DPI|RDG)/ \1/g' ${FILE}

#perl -pi -e 's///g' ${FILE}
perl -pi -e 's/\<t(d|h)[ \t]*\>/,/g' ${FILE}
perl -pi -e 's/\<\/t(d|h|r)[ \t]*\>//g' ${FILE}
perl -pi -e 's/\<\/a[ \t]*\>//g' ${FILE}
perl -pi -e 's/[ \t]*\<\/strike[ \t]*\>/)/g' ${FILE}
perl -pi -e 's/\<strike[ \t]*\>/(/g' ${FILE}
perl -pi -e 's/\<img src=http:\/\/www.ffvoile.net\/Freg\/FLAGS\///g' ${FILE}
perl -pi -e 's/\<img src="[^"]+FLAGS\///g' ${FILE}
perl -pi -e 's/\.GIF width=19 height=11  >[ \t]*/,/g' ${FILE}
perl -pi -e 's/\.GIF" width="\d+" height="\d+" +>[ \t]*/,/g' ${FILE}

perl -pi -e 's/[\t ]+$//g' ${FILE}
perl -pi -e 's/>[\t ]+/>/g' ${FILE}
perl -pi -e 's/[\t ]+</</g' ${FILE}
perl -pi -e 's/,[\t ]+/,/g' ${FILE}
perl -pi -e 's/[\t ]+,/,/g' ${FILE}
perl -pi -e 's/<br>[0-9]+//gi' ${FILE}
perl -pi -e 's/<br>/,/gi' ${FILE}
perl -pi -e 's/,([A-Z\- \.]+) ([A-Z][a-z \-é]+),/,$2 $1,/' ${FILE}
perl -pi -e 's/,([A-Z\- \.]+) ([A-Z][a-z \-é]+),/,$2 $1,/' ${FILE}
