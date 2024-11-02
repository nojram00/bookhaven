#!/bin/bash -i

alias green='\e[32m'
alias yellow='\e[33m'
alias red='\e[31m'

if ! npm run build; then
    echo -e "${red}ASSETS BUILD FAILED!"
    exit
fi

echo -e "${green}ASSETS BUILD!"

if ! docker build -t nojram/bookhaven .; then
    echo "${red}DOCKER BUILD FAILED!"
    exit
fi

echo -e "${green}DOCKER IMAGE CREATED!"

echo -e "${yellow}RUNNING DOCKER IMAGE..."

docker run -p 8000:8000 -d nojram/bookhaven

echo -e "${green}DOCKER IMAGE RUNNING!"
