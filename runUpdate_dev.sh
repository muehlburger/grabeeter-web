#!/bin/bash
if [ -e "lock" ]; then
  echo "waiting ..."
  exit;
fi

echo
date

touch lock;
cat data/usernames | while read line; do
  ./symfony updateTweets $line --env=dev
  if [ "$?" = "1" ]; then
    rm lock;
    exit;
  fi
  
  if [ "$?" = "2" ]; then
    echo "skipping user because of an error";
  fi
done

if [ -e "lock" ]; then
  rm lock;
fi