#!/bin/bash

dir=$(pwd)
create="/create.sql"

echo -n "mysql username: "
read username
echo -n "mysql password: "
read -s password

mysql --user=$username --password=$password -e "source ${dir}${create}"
