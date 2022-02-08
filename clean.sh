#! /bin/bash
# A simple script to either run the trash command line (macos, added via Macports or Brew)
# or just rely on rm -rf


DIR="./public"
CMD=""
if [ -d ${DIR} ]; then
    eval "which -s trash"
    if [ $? -eq 0 ]; then
        CMD="trash ${DIR}/*"
    else
        CMD="rm -rf ${DIR}/*"
    fi
    eval ${CMD}
else
    echo "No $DIR"
fi
exit $?
