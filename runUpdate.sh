#!/bin/bash
echo
date

if [ -e "lock" ]; then
  echo "waiting ..."
  exit;
fi

touch lock;
cat usernames | while read line; do
  ./symfony updateTweets $line --env=prod
  if [ "$?" = "1" ]; then
    rm lock;
    exit;
  fi
done
rm lock;