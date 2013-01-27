#!/bin/sh

# This script applies watermarks to images and generates thumbnails.

for image in src/*.jpg;
do
  cp $image tmp1.jpg

  convert tmp1.jpg -quality 85 -resize 288x162 tmp2.jpg
  jpegtran -optimize -progressive -copy none -outfile output/`md5sum -b $image | cut -d " " -f 1`-thumb.jpg tmp2.jpg

  convert tmp1.jpg stamp.png -gravity northeast -geometry +2+2 -composite -quality 95 tmp2.jpg
  jpegtran -optimize -progressive -copy none -outfile output/`md5sum -b $image | cut -d " " -f 1`.jpg tmp2.jpg

  echo "$image done."
done

rm -f tmp1.jpg tmp2.jpg
