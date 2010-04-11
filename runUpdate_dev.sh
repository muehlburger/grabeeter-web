#!/bin/bash

cat usernames | while read line; do
  ./symfony updateTweets $line --env=dev
  if [ "$?" = "1" ]; then
    exit;
  fi
done