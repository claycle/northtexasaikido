#! /bin/bash
# A simple script to either run the trash command line (macos, added via Macports or Brew)
# or just rely on rm -rf


DIR="./public"
CMD=""
if [ -d ${DIR} ]; then
    eval "which -s trash"
    if [ $? -eq 0 ]; then
        CMD="trash"
    else
        CMD="rm -rf"
    fi
    echo ${CMD} "${DIR}/*"
    eval ${CMD} "${DIR}/*"
else
    echo "No $DIR"
fi
exit $?
