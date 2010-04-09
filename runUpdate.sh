#!/bin/bash

cat usernames | while read line; do
  ./symfony updateTweets $line
done