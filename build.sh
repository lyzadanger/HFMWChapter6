#!/bin/sh

mkdir -p chapter6
cd chapter6
cp -LR ../01_basic_page/01_basic_page/index.html . # Basic index.html file
cp -LR ../shared/tartanator-pages/aboutus.html .
cp -LR ../shared/tartanator-pages/findevent.html .
mkdir -p tartans
cp -LR ../shared/tartanator-pages/tartans/ tartans
mkdir -p extras
cp ../shared/tartanator-pages/color-list.txt extras
cd ..
zip -qr chapter6.zip chapter6