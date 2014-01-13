#!/bin/sh

# This script applies watermarks to images and generates thumbnails.

for image in src/*.jpg;
do
  HASH=`md5sum -b "${image}" | cut -d " " -f 1`
  if [ -e "output/${HASH}.jpg" ] && [ -e "output/${HASH}-thumb.jpg" ]
  then
    echo "Files for wallpaper ${HASH} (${image}) already exist, skipping (delete them to force update)."
  else
    cp "$image" tmp1.jpg

    convert tmp1.jpg -resize 288x162 -quality 85 tmp2.jpg
    jpegtran -optimize -progressive -copy none -outfile "output/${HASH}-thumb.jpg" tmp2.jpg

    convert tmp1.jpg stamp.png -gravity northeast -geometry +2+2 -composite -quality 95 tmp2.jpg
    jpegtran -optimize -progressive -copy none -outfile "output/${HASH}.jpg" tmp2.jpg

    echo "${HASH} (${image}) done."
  fi
done

rm -f tmp1.jpg tmp2.jpg
