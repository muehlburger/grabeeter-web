#!/bin/bash
echo
date

cat usernames | while read line; do
  time ./symfony updateTweets $line --env=dev
  if [ "$?" = "1" ]; then
    exit;
  fi
done