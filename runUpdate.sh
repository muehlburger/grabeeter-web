#!/bin/bash

cat usernames | while read line; do
  ./symfony updateTweets $line --env=prod
  if [ "$?" = "1" ]; then
    exit;
  fi
done