#!/usr/bin/env bash

if [ $# -gt 1 ] || ( [ $# -eq 1 ] && [ "$1" != "ssh" ] )
then
        echo
        echo "Usage: "
        echo
        echo "    $0 [ssh]"
        echo
        echo " [ssh] if present, will use SSH protocol to clone repos."
        echo
        exit
fi

SSH_PREFIX="git@github.com:"
HTTPS_PREFIX="https://github.com/"

if [ "$1" == "ssh" ]
then
	PREFIX=$SSH_PREFIX
else
	PREFIX=$HTTPS_PREFIX
fi

echo "Cloning repositories..."

echo "Cloning MarmolesTravertino wordpress site..."
if [ ! -d appserver ]; then
    git clone --depth 1 "$PREFIX"ngoldenberg/marmoles_travertino.git marmoles_travertino
else
    echo "MarmolesTravertino  was cloned already. Pulling latest updates..."
    cd marmoles_travertino
    git pull
    cd ..
fi
echo "MarmolesTravertino repository up to date."

echo "Cloning MarmolesTravertinoM wordpress mobile site..."
if [ ! -d upload_validation ]; then
    git clone -b master --depth 1 "$PREFIX"ngoldenberg/marmoles_travertino_m.git marmoles_travertino_m
else
    echo "MarmolesTravertinom was cloned already. Pulling latest updates..."
    cd marmoles_travertino_m
    git pull
    cd ..
fi
echo "MarmolesTravertinoM repository up to date."

echo "Cloning Faraday Blink site..."
if [ ! -d upload_validation ]; then
    git clone -b master --depth 1 "$PREFIX"ngoldenberg/faraday_blink.git faraday_blink
else
    echo "Faraday Blink was cloned already. Pulling latest updates..."
    cd faraday_blink
    git pull
    cd ..
fi
echo "Faraday Blink repository up to date."

echo "Cloning Chain Reaction site..."
if [ ! -d chain-reaction ]; then
    git clone -b master --depth 1 git@gitlab.com:ngoldenberg/chain-reaction.git chain-reaction
else
    echo "Chain Reaction was cloned already. Pulling latest updates..."
    cd chain-reaction
    git pull
    cd ..
fi
echo "Chain Reaction repository up to date."


