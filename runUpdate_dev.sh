#!/bin/bash
if [ -e "lock" ]; then
  echo "waiting ..."
  exit;
fi

touch lock;
cat usernames | while read line; do
  ./symfony updateTweets $line --env=dev
  if [ "$?" = "1" ]; then
    rm lock;
    exit;
  fi
done