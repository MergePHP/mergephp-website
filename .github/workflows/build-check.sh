#!/bin/bash
set -e

trap 'ret=$?; echo "$0 failed on line $LINENO"; exit $ret' ERR

if [[ -z "${RUNNER_DEBUG}" ]]; then
	composer build
else
	set -x
	composer build -vvv
fi

changes=$(
	git status --porcelain |
	# ignore files that change every time the build command runs
	grep -v "^ M docs/atom\.xml$" |
	grep -v "^ M docs/sitemap\.xml$" |
	# the following two are specific to GitHub Actions
	grep -v "^.. output\.log$" |
	grep -vi "^.. Docker"
)

if [[ -n "$changes" ]]; then
	echo "\e[31mYou forgot to commit changes to the docs dir!\e[0m"
	echo 'On your local run \e[33mcomposer build\e[0m then \e[33mgit add\e[0m your changes to the docs dir'
	echo 'Then \e[33mgit commit --amend\e[0m and \e[33mgit push --force\e[0m'
	echo '\n'
	echo 'Here is what is new:'
	echo "$changes"
	exit 1
else
	echo 'No changes detected 👍'
fi
